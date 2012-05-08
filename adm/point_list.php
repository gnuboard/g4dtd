<?php
$sub_menu = "200200";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$token = get_token();

$sql_common = " from $g4[point_table] ";

$sql_search = " where (1) ";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case "mb_id" :
            $sql_search .= " ($sfl = '$stx') ";
            break;
        default :
            $sql_search .= " ($sfl like '%$stx%') ";
            break;
    }
    $sql_search .= " ) ";
}

if (!$sst) {
    $sst  = "po_id";
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

$listall = "<a href='$_SERVER[PHP_SELF]'>처음</a>";

if ($sfl == "mb_id" && $stx)
    $mb = get_member($stx);

$g4[title] = "포인트관리";
include_once ("./admin.head.php");

$colspan = 8;
?>
<div id="adm_point">
<?php echo subtitle("포인트관리")?>
<script type='text/javascript' src="<?php echo $g4[path]?>/js/sideview.js"></script>
<script type='text/javascript'>
var list_update_php = "";
var list_delete_php = "point_list_delete.php";
</script>

<script type='text/javascript'>
function point_clear()
{
    if (confirm("포인트 정리를 하시면 최근 50건 이전의 포인트 부여 내역을 삭제하므로\n\n포인트 부여 내역을 필요로 할때 찾지 못할 수도 있습니다.\n\n\n그래도 진행하시겠습니까?"))
    {
        document.location.href = "./point_clear.php?ok=1";
    }
}
</script>

<div class='list_status'>
    <p class='fl'>
        <?php echo $listall?> (건수 : <?php echo number_format($total_count)?>)
        <?php
        if ($mb[mb_id])
            echo "&nbsp;(" . $mb[mb_id] ." 님 포인트 합계 : " . number_format($mb[mb_point]) . "점)";
        else {
            $row2 = sql_fetch(" select sum(po_point) as sum_point from $g4[point_table] ");
            echo "&nbsp;(전체 포인트 합계 : " . number_format($row2[sum_point]) . "점)";
        }
        ?>
        <?php if ($is_admin == "super") { ?><!-- <a href="javascript:point_clear();">포인트정리</a> --><?php } ?>
    </p>
    <div class='fr'>
		<form id='fsearch' method='get' action='#'>
        <select name='sfl'>
            <option value='mb_id'>회원아이디</option>
            <option value='po_content'>내용</option>
        </select>
        <input type='text' name='stx' class='text required' title='검색어' value='<?php echo $stx?>' />
        <input type='image' src='<?php echo $g4[admin_path]?>/img/btn_search.gif' class='btn_search' alt='' />
        <?php
        if ($stx)
            echo "<script type='text/javascript'>document.getElementById('fsearch').sfl.value = '$sfl';</script>\n";
        ?>
        <script type='text/javascript'> document.getElementById('fsearch').stx.focus(); </script>
		</form>
    </div>
</div>

<form id='fpointlist' method='post' action='#'>
<table class='list_table'>
<col width='30' />
<col width='100' />
<col width='80' />
<col width='80' />
<col width='140' />
<col width='*' />
<col width='50' />
<col width='80' />
<thead>
	<tr>
		<th>
			<input type='hidden' name='sst'   value='<?php echo $sst?>' />
			<input type='hidden' name='sod'   value='<?php echo $sod?>' />
			<input type='hidden' name='sfl'   value='<?php echo $sfl?>' />
			<input type='hidden' name='stx'   value='<?php echo $stx?>' />
			<input type='hidden' name='page'  value='<?php echo $page?>' />
			<input type='hidden' name='token' value='<?php echo $token?>' />
			<input type='checkbox' name='chkall' value='1' onclick='check_all(this.form)' /></th>
		<th><?php echo subject_sort_link('mb_id')?>회원아이디</a></th>
		<th>이름</th>
		<th>별명</th>
		<th><?php echo subject_sort_link('po_datetime')?>일시</a></th>
		<th><?php echo subject_sort_link('po_content')?>포인트 내용</a></th>
		<th><?php echo subject_sort_link('po_point')?>포인트</a></th>
		<th>포인트합</th>
	</tr>
</thead>
<tbody>
<?php
for ($i=0; $row=sql_fetch_array($result); $i++)
{
    if ($row2[mb_id] != $row[mb_id])
    {
        $sql2 = " select mb_id, mb_name, mb_nick, mb_email, mb_homepage, mb_point from $g4[member_table] where mb_id = '$row[mb_id]' ";
        $row2 = sql_fetch($sql2);
    }

    $mb_nick = get_sideview($row[mb_id], $row2[mb_nick], $row2[mb_email], $row2[mb_homepage]);

    $link1 = $link2 = "";
    if (!preg_match("/^\@/", $row[po_rel_table]) && $row[po_rel_table])
    {
        $link1 = "<a href='$g4[bbs_path]/board.php?bo_table={$row[po_rel_table]}&amp;wr_id={$row[po_rel_id]}'>";
        $link2 = "</a>";
    }

    $list = $i%2;
    echo "
    <tr class='list$list'>
        <td>
            <input type='hidden' name='po_id[$i]' value='$row[po_id]' />
            <input type='hidden' name='mb_id[$i]' value='$row[mb_id]' />
            <input type='checkbox' name='chk[]' value='$i' /></td>
        <td><a href='?sfl=mb_id&amp;stx=$row[mb_id]'>$row[mb_id]</a></td>
        <td>$row2[mb_name]</td>
        <td>$mb_nick</td>
        <td>$row[po_datetime]</td>
        <td align='left'>&nbsp;{$link1}$row[po_content]{$link2}</td>
        <td align='right'>".number_format($row[po_point])."&nbsp;</td>
        <td align='right'>".number_format($row2[mb_point])."&nbsp;</td>
    </tr> ";
}

if ($i == 0)
    echo "<tr><td colspan='$colspan' class='nodata'>자료가 없습니다.</td></tr>";
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&amp;page=");
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

<?php
if (strstr($sfl, "mb_id"))
    $mb_id = $stx;
else
    $mb_id = "";
?>

<form id='fpointlist2' method='post' action='#' onsubmit="return fpointlist2_submit(this);">
<table class='list_table'>
<col width='150' />
<col width='' />
<col width='100' />
<col width='100' />
<thead>
	<tr>
		<th>회원아이디</th>
		<th>포인트 내용</th>
		<th>포인트</th>
		<th>입력</th>
	</tr>
</thead>
<tbody>
	<tr>
		<td>
			<input type='hidden' name='sfl' value='<?php echo $sfl?>' />
			<input type='hidden' name='stx' value='<?php echo $stx?>' />
			<input type='hidden' name='sst' value='<?php echo $sst?>' />
			<input type='hidden' name='sod' value='<?php echo $sod?>' />
			<input type='hidden' name='page' value='<?php echo $page?>' />
			<input type='hidden' name='token' value='<?php echo $token?>' />
			<input type='text' name='mb_id' class='text required' title='회원아이디' value='<?php echo $mb_id?>' /></td>
		<td><input type='text' name='po_content' class='text w99 required' title='내용' /></td>
		<td><input type='text' name='po_point' class='text required' title='포인트' size='10' /></td>
		<td><input type='submit' value='  확  인  ' /></td>
	</tr>
</tbody>
</table>
</form>

<script type='text/javascript'>
function fpointlist2_submit(f)
{
    f.action = "./point_update.php";
    return true;
}
</script>
</div>
<?php
include_once ("./admin.tail.php");
?>
