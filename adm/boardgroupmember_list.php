<?php
$sub_menu = "300200";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$gr = get_group($gr_id);
if (!$gr[gr_id]) {
    alert("존재하지 않는 그룹입니다.");
}

$sql_common = " from $g4[group_member_table] a
                left outer join $g4[member_table] b on (a.mb_id = b.mb_id) ";

$sql_search = " where gr_id = '$gr_id' ";
// 회원아이디로 검색되지 않던 오류를 수정
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        default :
            $sql_search .= " ($sfl like '%$stx%') ";
            break;
    }
    $sql_search .= " ) ";
}

if (!$sst) {
    $sst  = "gm_datetime";
    $sod = "desc";
}
$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = $config[cf_page_rows];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page == "") $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);

$g4[title] = "접근가능회원";
include_once("./admin.head.php");

$colspan = 7;
?>

<form id='fsearch' method='get' action='#'>
<div class='list_status'>
    <div class='fl'>
        * <? echo "'<b>[$gr[gr_id]] $gr[gr_subject]</b>' 그룹의 접근가능한 회원 목록"; ?>
    </div>
    <div class='fr'>
        <input type='hidden' name='gr_id' value='<?php echo $gr_id?>' />
        <select name='sfl'>
            <option value='a.mb_id'>회원아이디</option>
        </select>
        <input type='text' name='stx' class='text required' title='검색어' value='<? echo $stx ?>' />
        <input type='image' src='<?php echo $g4[admin_path]?>/img/btn_search.gif' class='btn_search' alt='' />
        <?php
        if ($stx)
            echo "<script type='text/javascript'>document.getElementById('fsearch').sfl.value = '$sfl';</script>\n";
        ?>
    </div>
</div>
</form>

<table cellpadding='0' cellspacing='0' class='list_table'>
<col width='120' />
<col width='120' />
<col width='120' />
<col width='120' />
<col width='*' />
<col width='100' />
<col width='40' />
<tr><td colspan='<?php echo $colspan?>' class='line1'></td></tr>
<tr class='bgcol1 bold col1 ht center'>
    <td><?php echo subject_sort_link('b.mb_id', "gr_id=$gr_id")?>회원아이디</a></td>
    <td><?php echo subject_sort_link('b.mb_name', "gr_id=$gr_id")?>이름</a></td>
    <td><?php echo subject_sort_link('b.mb_nick', "gr_id=$gr_id")?>별명</a></td>
    <td><?php echo subject_sort_link('b.mb_today_login', "gr_id=$gr_id")?>최종접속</a></td>
    <td><?php echo subject_sort_link('a.gm_datetime', "gr_id=$gr_id")?>처리일시</a></td>
    <td title='접근가능한 그룹수'>그룹</td>
    <td>삭제</td>
</tr>
<tr><td colspan='<?php echo $colspan?>' class='line2'></td></tr>

<?php
for ($i=0; $row=sql_fetch_array($result); $i++)
{
    // 접근가능한 그룹수
    $sql2 = " select count(*) as cnt from $g4[group_member_table] where mb_id = '$row[mb_id]' ";
    $row2 = sql_fetch($sql2);
    $group = "";
    if ($row2[cnt])
        $group = "<a href='./boardgroupmember_form.php?mb_id=$row[mb_id]'>$row2[cnt]</a>";

    $s_del = "<a href=\"javascript:post_delete('boardgroupmember_update.php', '$row[gm_id]');\"><img src='img/icon_delete.gif' class='icon_btn' alt='' title='삭제' /></a>";

    $mb_nick = get_sideview($row[mb_id], $row[mb_nick], $row[mb_email], $row[mb_homepage]);

    $list = $i%2;
    echo "
    <tr class='list$list col1 ht center'>
        <td>$row[mb_id]</td>
        <td>$row[mb_name]</td>
        <td>$mb_nick</td>
        <td>".substr($row[mb_today_login],2,8)."</td>
        <td>$row[gm_datetime]</td>
        <td>$group</td>
        <td>$s_del</td>
    </tr> ";
}

if ($i == 0)
    echo "<tr><td colspan='$colspan' class='nodata'>자료가 없습니다.</td></tr>";

echo "<tr><td colspan='$colspan' class='line2'></td></tr>";
echo "</table>";

$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&amp;gr_id=$gr_id&amp;page=");
if ($pagelist)
    echo "<div class='page_area'><div class='fr'>$pagelist</div></div>\n";
?>

<script type='text/javascript'>
// POST 방식으로 삭제
function post_delete(action_url, val)
{
	var f = document.getElementById('fpost');

	if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
        f.gm_id.value = val;
		f.action      = action_url;
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
<input type='hidden' name='w'     value='listdelete' />
<input type='hidden' name='gm_id' />
</div>
</form>

<?php
include_once("./admin.tail.php");
?>
