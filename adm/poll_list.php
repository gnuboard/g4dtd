<?php
$sub_menu = "200900";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$token = get_token();

$sql_common = " from $g4[poll_table] ";

$sql_search = " where (1) ";
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

$g4[title] = "투표관리";
include_once("./admin.head.php");

$colspan = 6;
?>

<?php echo subtitle("투표관리"); ?>
<form id='fsearch' method='get' action='#'>
<div class='list_status'>
    <div class='fl'>
        <?php echo $listall?> (투표수 : <?php echo number_format($total_count)?>개)
    </div>
    <div class='fr'>
        <select name='sfl' id='sfl'>
            <option value='po_subject'>제목</option>
        </select>
        <input type='text' name='stx' class='text required' title='검색어' value='<?php echo $stx?>' />
        <input type='image' src='<?php echo $g4[admin_path]?>/img/btn_search.gif' alt='' class='btn_search' />
        <?php
        if ($stx)
            echo "<script type='text/javascript'>document.getElementById('sfl').value = '$sfl';</script>\n";
        ?>
        <script type='text/javascript'> document.getElementById('fsearch').stx.focus(); </script>
    </div>
</div>
</form>

<table class='list_table'>
<col width='60' />
<col width='*' />
<col width='100' />
<col width='60' />
<col width='60' />
<col width='70' />
<thead>
<tr>
	<th>번호</th>
	<th>제목</th>
	<th>투표권한</th>
	<th>투표수</th>
	<th>기타의견</th>
	<th><a href="./poll_form.php"><img src='<?php echo $g4[admin_path]?>/img/icon_insert.gif' alt='' title='생성' /></a></th>
</tr>
</thead>
<tbody>
<?php
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $sql2 = " select sum(po_cnt1+po_cnt2+po_cnt3+po_cnt4+po_cnt5+po_cnt6+po_cnt7+po_cnt8+po_cnt9) as sum_po_cnt from $g4[poll_table] where po_id = '$row[po_id]' ";
    $row2 = sql_fetch($sql2);
    $po_etc = ($row[po_etc]) ? "사용" : "미사용";

    $s_mod = "<a href='./poll_form.php?$qstr&amp;w=u&amp;po_id=$row[po_id]'><img src='img/icon_modify.gif' alt='' title='수정' class='icon_btn' /></a>";
    $s_del = "<a href=\"javascript:post_delete('poll_form_update.php', '$row[po_id]');\"><img src='img/icon_delete.gif' alt='' title='삭제' class='icon_btn' /></a>";

    $list = $i%2;
    echo "
    <tr class='list$list'>
        <td>$row[po_id]</td>
        <td align='left'>&nbsp;".cut_str(get_text($row[po_subject]),70)."</td>
        <td>$row[po_level]</td>
        <td>$row2[sum_po_cnt]</td>
        <td>$po_etc</td>
        <td>$s_mod $s_del</td>
    </tr>";

}

if ($i==0)
    echo "<tr><td colspan='$colspan' class='nodata'>자료가 없습니다.</td></tr>";

echo "</tbody>";
echo "</table>";

$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&amp;page=");
if ($pagelist)
    echo "<div class='page_area'>$pagelist</div>\n";
?>

<script type='text/javascript'>
// POST 방식으로 삭제
function post_delete(action_url, val)
{
	var f = document.getElementById('fpost');

	if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
        f.po_id.value = val;
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
<input type='hidden' name='w'     value='d' />
<input type='hidden' name='po_id' />
</div>
</form>

<?php
include_once ("./admin.tail.php");
?>