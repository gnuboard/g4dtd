<?php
die("2010년 4월 30일 금요일 이후로 더 이상 사용하지 않습니다.");

$sub_menu = "100200";
include_once("./_common.php");

if ($is_admin != "super")
    alert("최고관리자만 접근 가능합니다.");

$token = get_token();

$sql_common = " from $g4[auth_table] a left join $g4[member_table] b on (a.mb_id=b.mb_id) ";

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
    $sst  = "a.mb_id, au_menu";
    $sod = "";
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

$g4[title] = "관리권한설정";
include_once("./admin.head.php");

$colspan = 5;
?>

<script type='text/javascript' src="<?php echo $g4[path]?>/js/sideview.js"></script>
<script type='text/javascript'>
var list_update_php = "";
var list_delete_php = "auth_list_delete.php";
</script>

<form id='fsearch' method='get' action='#'>
<table width='100%'>
<tr>
    <td align='left'>
        <?php echo $listall?> (건수 : <?php echo number_format($total_count)?>)
    </td>
    <td align='right'>
        <select name='sfl'>
            <option value='a.mb_id'>회원아이디</option>
        </select>
        <input type='text' name='stx' class='text required' title='검색어' value='<?php echo $stx?>' />
        <input type='image' src='<?php echo $g4[admin_path]?>/img/btn_search.gif' alt='' class='btn_search' /></td>
</tr>
</table>
</form>

<form id='fauthlist' method='post' action='#'>

<table width='100%' cellpadding='0' cellspacing='0'>
<col width='30' />
<col width='120' />
<col width='150' />
<col width='*' />
<col width='100' />
<tr><td colspan='<?php echo $colspan?>' class='line1'></td></tr>
<tr class='bgcol1 bold col1 ht center'>
    <td>
        <input type='hidden' name='sst'   value='<?php echo $sst?>' />
        <input type='hidden' name='sod'   value='<?php echo $sod?>' />
        <input type='hidden' name='sfl'   value='<?php echo $sfl?>' />
        <input type='hidden' name='stx'   value='<?php echo $stx?>' />
        <input type='hidden' name='page'  value='<?php echo $page?>' />
        <input type='hidden' name='token' value='<?php echo $token?>' />
        <input type='checkbox' name='chkall' value='1' onclick='check_all(this.form)' />
    </td>
    <td><?php echo subject_sort_link('a.mb_id')?>회원아이디</a></td>
    <td><?php echo subject_sort_link('mb_nick')?>별명</a></td>
	<td>메뉴</td>
	<td>권한</td>
</tr>
<tr><td colspan='<?php echo $colspan?>' class='line2'></td></tr>
<?php
for ($i=0; $row=sql_fetch_array($result); $i++)
{
    $mb_nick = get_sideview($row[mb_id], $row[mb_nick], $row[mb_email], $row[mb_homepage]);

    // 메뉴번호가 바뀌는 경우에 현재 없는 저장된 메뉴는 삭제함
    if (!isset($auth_menu[$row[au_menu]]))
    {
        sql_query(" delete from $g4[auth_table] where au_menu = '$row[au_menu]' ");
        continue;
    }

    $list = $i%2;
    echo "
    <tr class='list$list col1 ht center'>
        <td>
            <input type='hidden' name='mb_id[$i]' value='$row[mb_id]' />
            <input type='hidden' name='au_menu[$i]' value='$row[au_menu]' />
            <input type='checkbox' name='chk[]' value='$i' />
        </td>
        <td><a href='?sfl=a.mb_id&amp;stx=$row[mb_id]'>$row[mb_id]</a></td>
        <td>$mb_nick</td>
        <td align='left'>&nbsp; [$row[au_menu]] {$auth_menu[$row[au_menu]]}</td>
        <td>$row[au_auth]</td>
    </tr>";
}

if ($i==0)
    echo "<tr><td colspan='$colspan' class='nodata'>자료가 없습니다.</td></tr>";

echo "<tr><td colspan='$colspan' class='line2'></td></tr>";
echo "</table>";

$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "$_SERVER[PHP_SELF]?$qstr&page=");
echo "<table width='100%' cellpadding='3' cellspacing='1'>";
echo "<tr><td>";
echo "<input type='button' class='btn1' value='선택삭제' onclick=\"btn_check(this.form, 'delete')\" />";
echo "</td>";
echo "<td align='right'>$pagelist</td></tr></table>\n";

if ($stx)
    echo "<script type='text/javascript'>document.getElementById('fsearch').sfl.value = '$sfl';</script>\n";

if (strstr($sfl, "mb_id"))
    $mb_id = $stx;
else
    $mb_id = "";
?>
</form>

<script type='text/javascript'> document.getElementById('fsearch').stx.focus(); </script>

<?$colspan=4?>

<br />
<form id='fauthlist2' method='post' action='#' onsubmit='return fauthlist2_submit(this);'>
<table cellpadding='0' cellspacing='0'>
<col width='150' />
<col width='*' />
<col width='150' />
<col width='100' />
<tr><td colspan='<?php echo $colspan?>' class='line1'></td></tr>
<tr class='bgcol1 bold col1 ht center'>
    <td>회원아이디</td>
    <td>접근가능메뉴</td>
    <td>권한</td>
    <td>입력</td>
</tr>
<tr><td colspan='<?php echo $colspan?>' class='line2'></td></tr>
<tr class='ht center'>
    <td>
        <input type='hidden' name='sfl'   value='<?php echo $sfl?>' />
        <input type='hidden' name='stx'   value='<?php echo $stx?>' />
        <input type='hidden' name='sst'   value='<?php echo $sst?>' />
        <input type='hidden' name='sod'   value='<?php echo $sod?>' />
        <input type='hidden' name='page'  value='<?php echo $page?>' />
        <input type='hidden' name='token' value='<?php echo $token?>' />
        <input type='text' name='mb_id' class='text required' title='회원아이디' value='<?php echo $mb_id?>' />
    </td>
    <td>
        <select name='au_menu' class='required' title='접근가능메뉴'>
        <option value=''>-- 선택하세요</option>
        <?php
        foreach($auth_menu as $key=>$value)
        {
            if (!(substr($key, -3) == "000" || $key == "-" || !$key))
                echo "<option value='$key'>[$key] $value</option>";
        }
        ?>
        </select>
    </td>
    <td>
        <table width='210'>
        <tr align='center'>
        	<td><input type='checkbox' name='r' value='r' checked='checked' /></td>
        	<td><input type='checkbox' name='w' value='w' /></td>
        	<td><input type='checkbox' name='d' value='d' /></td>
        </tr>
        <tr align='center'>
        	<td>r<br />(읽기)</td>
        	<td>w<br />(입력,수정)</td>
        	<td>d<br></br>(삭제)</td>
        </tr>
        </table></td>
    <td><input type='submit' class='btn1' value='  확  인  ' /></td>
</tr>
<tr><td colspan='<?php echo $colspan?>' class='line2'></td></tr>
</table>

</form>

<script type='text/javascript'>
function fauthlist2_submit(f)
{
    f.action = "./auth_update.php";
    return true;
}
</script>

<?php
include_once ("./admin.tail.php");
?>
