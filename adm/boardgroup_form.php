<?php
$sub_menu = "300200";
include_once("./_common.php");

auth_check($auth[$sub_menu], "w");

$token = get_token();

if ($is_admin != "super" && $w == "") alert("최고관리자만 접근 가능합니다.");

$html_title = "게시판그룹";
if ($w == "")
{
    $required_gr_id = "required alnum_";
    $update_gr_id = "";
    $gr[gr_use_access] = 0;
    $html_title .= " 생성";
}
else if ($w == "u")
{
    $required_gr_id = "";
    $update_gr_id = "readonly='readonly' style='background-color:#dddddd'";
    $gr = sql_fetch(" select * from $g4[group_table] where gr_id = '$gr_id' ");
    $html_title .= " 수정";
}
else
    alert("제대로 된 값이 넘어오지 않았습니다.");

$g4[title] = $html_title;
include_once("./admin.head.php");
?>

<?php echo subtitle("게시판그룹생성"); ?>
<form id='fboardgroup' method='post' action='#' onsubmit='return fboardgroup_check(this);'>
<table class='normal3'>
<col width="15%" />
<col class='col2' />
<col class='col3' />
<col class='col4' />
    <td>그룹 ID</td>
    <td colspan='3'>
        <input type='hidden' name='w'     value='<?php echo $w?>' />
        <input type='hidden' name='sfl'   value='<?php echo $sfl?>' />
        <input type='hidden' name='stx'   value='<?php echo $stx?>' />
        <input type='hidden' name='sst'   value='<?php echo $sst?>' />
        <input type='hidden' name='sod'  value='<?php echo $sod?>' />
        <input type='hidden' name='page'  value='<?php echo $page?>' />
        <input type='hidden' name='token' value='<?php echo $token?>' />

        <input type='text' name='gr_id' size='11' maxlength='10' class='text <?php echo $required_gr_id?>' <?php echo $update_gr_id?> title='그룹 아이디' value='<?php echo $group[gr_id]?>' /> 영문자, 숫자, _ 만 가능 (공백없이)</td>
</tr>
<tr>
    <td>그룹 제목</td>
    <td colspan='3'>
        <input type='text' name='gr_subject' size='40' class='text required' title='그룹 제목' value='<?php echo get_text($group[gr_subject])?>' />
        <?php
        if ($w == 'u')
            echo "<input type='button' class='btn1' value='게시판생성' onclick=\"location.href='./board_form.php?gr_id=$gr_id';\" />";
        ?>
    </td>
</tr>
<tr>
    <td>그룹 관리자</td>
    <td colspan='3'>
        <?php
        if ($is_admin == "super")
            echo "<input type='text' name='gr_admin' class='text' maxlength='20' value='$gr[gr_admin]' />";
        else
            echo "<input type='hidden' name='gr_admin' value='$gr[gr_admin]' size='40' />$gr[gr_admin]";
        ?></td>
</tr>
<tr>
    <td>접근회원사용</td>
    <td colspan='3'>
        <input type='checkbox' name='gr_use_access' value='1' <?php echo $gr[gr_use_access]?"checked='checked'":"";?> />사용
        <?php echo help("사용에 체크하시면 이 그룹에 속한 게시판은 접근가능한 회원만 접근이 가능합니다.")?>
    </td>
</tr>
<tr>
    <td>접근회원수</td>
    <td colspan='3'>
        <?php
        // 접근회원수
        $sql1 = " select count(*) as cnt from $g4[group_member_table] where gr_id = '$gr_id' ";
        $row1 = sql_fetch($sql1);
        echo "<a href='./boardgroupmember_list.php?gr_id=$gr_id'>$row1[cnt]</a>";
        ?>
    </td>
</tr>

<?php for ($i=1; $i<=10; $i=$i+2) { $k=$i+1; ?>
<tr>
    <td><input type='text' name='gr_<?php echo $i?>_subj' class='text' value='<?php echo get_text($group["gr_{$i}_subj"])?>' size="15" title='여분필드 <?php echo $i?> 제목' style='text-align:right;font-weight:bold;' size='15' /></td>
    <td><input type='text' name='gr_<?php echo $i?>' class='text' value='<?php echo $gr["gr_$i"]?>' size="35" title='여분필드 <?php echo $i?> 설정값' /></td>
    <td><input type='text' name='gr_<?php echo $k?>_subj' class='text' value='<?php echo get_text($group["gr_{$k}_subj"])?>' title='여분필드 <?php echo $k?> 제목' style='text-align:right;font-weight:bold;' size='15' /></td>
    <td><input type='text' name='gr_<?php echo $k?>' class='text' value='<?php echo $gr["gr_$k"]?>' size="35" title='여분필드 <?php echo $k?> 설정값' /></td>
</tr>
<?php } ?>

<tr><td colspan='4' class='line2'></td></tr>
</table>

<p class='center'>
    <input type='submit' class='btn1' accesskey='s' value='  확  인  ' />&nbsp;
    <input type='button' class='btn1' value='  목  록  ' onclick="document.location.href='./boardgroup_list.php?<?php echo $qstr?>';" />
</p>
</form>

<script type='text/javascript'>
$(function() {
    $("#fboardgroup :input[type=text]:visible:enabled:first").focus();
});

function fboardgroup_check(f)
{
    f.action = "./boardgroup_form_update.php";
    return true;
}
</script>

<?php
include_once ("./admin.tail.php");
?>
