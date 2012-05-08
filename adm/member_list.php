<?php
$sub_menu = "200100";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$token = get_token();

$sql_common = " from {$g4['member_table']} ";

$sql_search = " where (1) ";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case "mb_point" :
            $sql_search .= " ($sfl >= '$stx') ";
            break;
        case "mb_level" :
            $sql_search .= " ($sfl = '$stx') ";
            break;
        case "mb_tel" :
        case "mb_hp" :
            $sql_search .= " ($sfl like '%$stx') ";
            break;
        default :
            $sql_search .= " ($sfl like '$stx%') ";
            break;
    }
    $sql_search .= " ) ";
}

//if ($is_admin == 'group') $sql_search .= " and mb_level = '{$member['mb_level']}' ";
if ($is_admin != 'super')
    $sql_search .= " and mb_level <= '{$member['mb_level']}' ";

if (!$sst) {
    $sst = "mb_datetime";
    $sod = "desc";
}

$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 탈퇴회원수
$sql = " select count(*) as cnt
         $sql_common
         $sql_search
            and mb_leave_date <> ''
         $sql_order ";
$row = sql_fetch($sql);
$leave_count = $row['cnt'];

// 차단회원수
$sql = " select count(*) as cnt
         $sql_common
         $sql_search
            and mb_intercept_date <> ''
         $sql_order ";
$row = sql_fetch($sql);
$intercept_count = $row['cnt'];

$listall = "<a href='{$_SERVER['PHP_SELF']}'>처음</a>";

$g4['title'] = "회원관리";
include_once("./admin.head.php");

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);

$colspan = 15;
?>
<div id="adm_member">
<?php echo subtitle("회원관리")?>
<script type='text/javascript' src="<?php echo $g4['path']?>/js/sideview.js"></script>
<script type='text/javascript'>
var list_update_php = "member_list_update.php";
var list_delete_php = "member_list_delete.php";
</script>
<div class='list_status'>
    <p class='fl'><?php echo $listall?>
        (총회원수 : <?php echo number_format($total_count)?>,
        <a href='?sst=mb_intercept_date&amp;sod=desc&amp;sfl=<?php echo $sfl?>&amp;stx=<?php echo $stx?>' title='차단된 회원부터 출력'><span style='color:orange;'>차단 : <?php echo number_format($intercept_count)?></span></a>,
        <a href='?sst=mb_leave_date&amp;sod=desc&amp;sfl=<?php echo $sfl?>&amp;stx=<?php echo $stx?>' title='탈퇴한 회원부터 출력'><span style='color:crimson;'>탈퇴 : <?php echo number_format($leave_count)?></span></a>)
    </p>
	
    <div class='fr'>
		<form id='fsearch' method='get' action='#'>
        <select name='sfl' id='sfl'>
            <option value='mb_id'>회원아이디</option>
            <option value='mb_name'>이름</option>
            <option value='mb_nick'>별명</option>
            <option value='mb_level'>권한</option>
            <option value='mb_email'>E-MAIL</option>
            <option value='mb_tel'>전화번호</option>
            <option value='mb_hp'>핸드폰번호</option>
            <option value='mb_point'>포인트</option>
            <option value='mb_datetime'>가입일시</option>
            <option value='mb_ip'>IP</option>
            <option value='mb_recommend'>추천인</option>
        </select>
        <input type='text' name='stx' class='text required' title='검색어' value='<? echo $stx ?>' />
        <input type='image' src='<?php echo $g4['admin_path']?>/img/btn_search.gif' class='btn_search' />
        <?php
        if ($stx)
            echo "<script type='text/javascript'>document.getElementById('sfl').value = '$sfl';</script>\n";
        ?>
		</form>
    </div>	
</div>

<form id='fmemberlist' method='post' action='#'>
<table class='list_table'>
	<col width='30' />
	<col width='90' />
	<col width='90' />
	<col width='90' />
	<col width='*' />
	<col width='70' />
	<col width='80' />
	<col width='40' />
	<col width='40' />
	<col width='40' />
	<col width='40' />
	<col width='40' />
	<col width='80' />
	<thead>
		<tr>
			<th>
				<input type='hidden' name='sst' value='<?php echo $sst?>' />
				<input type='hidden' name='sod' value='<?php echo $sod?>' />
				<input type='hidden' name='sfl' value='<?php echo $sfl?>' />
				<input type='hidden' name='stx' value='<?php echo $stx?>' />
				<input type='hidden' name='page' value='<?php echo $page?>' />
				<input type='hidden' name='token' value='<?php echo $token?>' />
				<input type='checkbox' name='chkall' value='1' onclick='check_all(this.form)' /></th>
			<th><?php echo subject_sort_link('mb_id')?>회원아이디</a></th>
			<th><?php echo subject_sort_link('mb_name')?>이름</a></th>
			<th><?php echo subject_sort_link('mb_nick')?>별명</a></th>
			<th><?php echo subject_sort_link('mb_level', '', 'desc')?>권한</a></th>
			<th><?php echo subject_sort_link('mb_point', '', 'desc')?>포인트</a></th>
			<th><?php echo subject_sort_link('mb_today_login', '', 'desc')?>최종접속</a></th>
			<th title='메일수신허용여부'><?php echo subject_sort_link('mb_mailling', '', 'desc')?>수신</a></th>
			<th title='정보공개여부'><?php echo subject_sort_link('mb_open', '', 'desc')?>공개</a></th>
			<!-- <th><?php echo subject_sort_link('mb_leave_date', '', 'desc')?>탈퇴</a></th> -->
			<th><?php echo subject_sort_link('mb_email_certify', '', 'desc')?>인증</a></th>
			<th><?php echo subject_sort_link('mb_intercept_date', '', 'desc')?>차단</a></th>
			<th title='접근가능한 그룹수'>그룹</th>
			<th><a href="./member_form.php"><img src='<?php echo $g4['admin_path']?>/img/icon_insert.gif' alt='' title='추가' /></a></th>
		</tr>
	</thead>
	<tbody>
		<?php
		for ($i=0; $row=sql_fetch_array($result); $i++) {
			// 접근가능한 그룹수
			$sql2 = " select count(*) as cnt from {$g4['group_member_table']} where mb_id = '{$row['mb_id']}' ";
			$row2 = sql_fetch($sql2);
			$group = "";
			if ($row2['cnt'])
				$group = "<a href='./boardgroupmember_form.php?mb_id={$row['mb_id']}'>{$row2['cnt']}</a>";

			if ($is_admin == 'group')
			{
				$s_mod = "";
				$s_del = "";
			}
			else
			{
				$s_mod = "<a href=\"./member_form.php?$qstr&amp;w=u&amp;mb_id={$row['mb_id']}\"><img src='img/icon_modify.gif' alt='' title='수정' /></a>";
				$s_del = "<a href=\"javascript:post_delete('member_delete.php', '{$row['mb_id']}');\"><img src='img/icon_delete.gif' alt='' title='삭제' /></a>";
			}
			$s_grp = "<a href='./boardgroupmember_form.php?mb_id={$row['mb_id']}'><img src='img/icon_group.gif' alt='' title='그룹' /></a>";

			$leave_date = $row['mb_leave_date'] ? $row['mb_leave_date'] : date("Ymd", $g4['server_time']);
			$intercept_date = $row['mb_intercept_date'] ? $row['mb_intercept_date'] : date("Ymd", $g4['server_time']);

			$mb_nick = get_sideview($row['mb_id'], $row['mb_nick'], $row['mb_email'], $row['mb_homepage']);

			$mb_id = $row['mb_id'];
			if ($row['mb_leave_date'])
				$mb_id = "<font color=crimson>$mb_id</font>";
			else if ($row['mb_intercept_date'])
				$mb_id = "<font color=orange>$mb_id</font>";

			$list = $i%2;
			echo "
			<tr>
				<td>
					<input type='hidden' name='mb_id[$i]' value='{$row['mb_id']}' />
					<input type='checkbox' name='chk[]' value='$i' /></td>
				<td title='{$row['mb_id']}'>$mb_id</td>
				<td>{$row['mb_name']}</td>
				<td>$mb_nick</td>
				<td>".get_member_level_select("mb_level[$i]", 1, $member['mb_level'], $row['mb_level'])."</td>
				<td align='right'><a href='point_list.php?sfl=mb_id&amp;stx={$row['mb_id']}'>".number_format($row['mb_point'])."</a></td>
				<td>".substr($row['mb_today_login'],2,8)."</td>
				<td>".($row['mb_mailling']?'&radic;':'&nbsp;')."</td>
				<td>".($row['mb_open']?'&radic;':'&nbsp;')."</td>
				<!-- <td title='{$row['mb_leave_date']}'>".($row['mb_leave_date']?'&radic;':'&nbsp;')."</td> -->
				<td title='{$row['mb_email_certify']}'>".(preg_match('/[1-9]/', $row['mb_email_certify'])?'&radic;':'&nbsp;')."</td>
				<td title='{$row['mb_intercept_date']}'><input type='checkbox' name='mb_intercept_date[$i]' ".($row['mb_intercept_date']?"checked='checked'":"")." value='$intercept_date' /></td>
				<td>$group</td>
				<td>$s_mod $s_del $s_grp</td>
			</tr>";
		}

		if ($i == 0)
			echo "<tr><td colspan='$colspan' class='nodata'>자료가 없습니다.</td></tr>";

		$pagelist = get_paging($config['cf_write_pages'], $page, $total_page, "?$qstr&amp;page=");
		?>
	</tbody>
</table>

<div class='btn_area'>
    <div class='fl'>
        <input type='button' class='btn1' value='선택수정' onclick="btn_check(this.form, 'update')" />
        <input type='button' class='btn1' value='선택삭제' onclick="btn_check(this.form, 'delete')" />
    </div>
    <div class='fr'><?php echo $pagelist?></div>
</div>
</form>

<p class="caution">* 회원자료 삭제시 다른 회원이 기존 회원아이디를 사용하지 못하도록 회원아이디, 이름, 별명은 삭제하지 않고 영구 보관합니다.</p>

<script type='text/javascript'>
// POST 방식으로 삭제
function post_delete(action_url, val)
{
	var f = document.getElementById('fpost');

	if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
        f.mb_id.value = val;
		f.action = action_url;
		f.submit();
	}
}
</script>

<form id='fpost' method='post' action='#'>
<div>
<input type='hidden' name='sst'   value='<?php echo $sst?>' />
<input type='hidden' name='sod'   value='<?php echo $sod?>' />
<input type='hidden' name='sfl'   value='<?php echo $sfl?>' />
<input type='hidden' name='stx'   value='<?php echo $stx?>' />
<input type='hidden' name='page'  value='<?php echo $page?>' />
<input type='hidden' name='token' value='<?php echo $token?>' />
<input type='hidden' name='mb_id' />
</div>
</form>
</div>
<?php
include_once ("./admin.tail.php");
?>
