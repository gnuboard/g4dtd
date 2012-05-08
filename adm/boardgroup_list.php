<?php
$sub_menu = "300200";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$token = get_token();

$sql_common = " from $g4[group_table] ";

$sql_search = " where (1) ";
if ($is_admin != "super")
    $sql_search .= " and (gr_admin = '$member[mb_id]') ";

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case "gr_id" :
        case "gr_admin" :
            $sql_search .= " ($sfl = '$stx') ";
            break;
        default :
            $sql_search .= " ($sfl like '%$stx%') ";
            break;
    }
    $sql_search .= " ) ";
}

if ($sst)
    $sql_order = " order by $sst $sod ";
else
    $sql_order = " order by gr_id asc ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = $config[cf_page_rows];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);

$listall = "<a href='$_SERVER[PHP_SELF]'>처음</a>";

$g4[title] = "게시판그룹설정";
include_once("./admin.head.php");

$colspan = 8;
?>

<?php echo subtitle("게시판그룹설정"); ?>
<script type='text/javascript'>
var list_update_php = "./boardgroup_list_update.php";
var list_delete_php = "./boardgroup_list_delete.php";
</script>

<form id='fsearch' method='get' action='#'>
<div class='list_status'>
    <div class='fl'>
        <?php echo $listall?> (그룹수 : <?php echo number_format($total_count)?>개)
    </div>
    <div class='fr'>
        <select name='sfl'>
            <option value='gr_subject'>제목</option>
            <option value='gr_id'>ID</option>
            <option value='gr_admin'>그룹관리자</option>
        </select>
        <input type='text' name='stx' class='text required' title='검색어' value='<?php echo $stx?>' />
        <input type='image' src='<?php echo $g4[admin_path]?>/img/btn_search.gif' class='btn_search' alt='' />
        <?php
        if ($stx)
            echo "<script type='text/javascript'>document.getElementById('sfl').value = '$sfl';</script>";
        ?>
    </div>
</div>
</form>

<form id='fboardgrouplist' method='post' action='#'>
<table class='list_table'>
<col width='30' />
<col width='120' />
<col width='180' />
<col width='*' />
<col width='80' />
<col width='80' />
<col width='80' />
<col width='60' />
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
    <th><?php echo subject_sort_link("gr_id")?>그룹아이디</a></th>
    <th><?php echo subject_sort_link("gr_subject")?>제목</a></th>
    <th><?php echo subject_sort_link("gr_admin")?>그룹관리자</a></th>
    <th>게시판</th>
    <th>접근사용</th>
    <th>접근회원수</th>
    <th><?php if ($is_admin == "super") { echo "<a href='./boardgroup_form.php'><img src='$g4[admin_path]/img/icon_insert.gif' alt='' title='생성' /></a>"; } ?></th>
</tr>
</thead>
<tbody>
<?php
for ($i=0; $row=sql_fetch_array($result); $i++)
{
    // 접근회원수
    $sql1 = " select count(*) as cnt from $g4[group_member_table] where gr_id = '$row[gr_id]' ";
    $row1 = sql_fetch($sql1);

    // 게시판수
    $sql2 = " select count(*) as cnt from $g4[board_table] where gr_id = '$row[gr_id]' ";
    $row2 = sql_fetch($sql2);

    $s_upd = "<a href='./boardgroup_form.php?$qstr&amp;w=u&amp;gr_id=$row[gr_id]'><img src='img/icon_modify.gif' class='icon_btn' alt='' title='수정' /></a>";
    $s_del = "";
    if ($is_admin == "super") {
        $s_del = "<a href=\"javascript:post_delete('boardgroup_delete.php', '$row[gr_id]');\"><img src='img/icon_delete.gif' class='icon_btn' alt='' title='삭제' /></a>";
    }

    $list = $i%2;
    echo "<tr class='list$list'>";
    echo "<td>";
    echo "<input type='hidden' name='gr_id[$i]' value='$row[gr_id]' />";
    echo "<input type='checkbox' name='chk[]' value='$i' /></td>";
    echo "<td><a href='$g4[bbs_path]/group.php?gr_id=$row[gr_id]'><strong>$row[gr_id]</strong></a></td>";
    echo "<td><input type='text' name='gr_subject[$i]' size='30' class='text' value='".get_text($row[gr_subject])."' /></td>";

    if ($is_admin == "super")
        echo "<td><input type='text' name='gr_admin[$i]' maxlength='20' class='text' value='$row[gr_admin]' /></td>";
    else
        echo "<input type='hidden' name='gr_admin[$i]' value='$row[gr_admin]' /><td>$row[gr_admin]</td>";

    echo "<td><a href='./board_list.php?sfl=a.gr_id&amp;stx=$row[gr_id]'>$row2[cnt]</a></td>";
    echo "<td><input type='checkbox' name='gr_use_access[$i]' ".($row[gr_use_access]?"checked='checked'":"")." value='1' /></td>";
    echo "<td><a href='./boardgroupmember_list.php?gr_id=$row[gr_id]'>$row1[cnt]</a></td>";
    echo "<td>$s_upd $s_del</td>";
    echo "</tr>\n";
}

if ($i == 0)
    echo "<tr><td colspan='$colspan' class='nodata'>자료가 없습니다.</td></tr>";

echo "</tbody>";
echo "</table>";

$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&amp;page=");
echo "<div class='btn_area'>";
echo "<div class='fl'>";
echo "<input type='button' class='btn1' value='선택수정' onclick=\"btn_check(this.form, 'update')\" /> ";

if ($is_admin == "super")
    echo "<input type='button' class='btn1' value='선택삭제' onclick=\"btn_check(this.form, 'delete')\" />";

echo "</div>";
echo "<div class='fr'>$pagelist</div>";
echo "</div>\n";
?>
</form>

<script type="text/javascript">
// POST 방식으로 삭제
function post_delete(action_url, val)
{
	var f = document.getElementById('fpost');

	if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?"))
	{
		f.gr_id.value = val;
		f.action      = action_url;
		f.submit();
	}
}
</script>

<form id="fpost" method="post" action="#">
<div>
<input type="hidden" name="sst"   value="<?php echo $sst?>" />
<input type="hidden" name="sod"   value="<?php echo $sod?>" />
<input type="hidden" name="sfl"   value="<?php echo $sfl?>" />
<input type="hidden" name="stx"   value="<?php echo $stx?>" />
<input type="hidden" name="page"  value="<?php echo $page?>" />
<input type="hidden" name="token" value="<?php echo $token?>" />
<input type="hidden" name="gr_id" />
</div>
</form>

<?php
include_once("./admin.tail.php");
?>
