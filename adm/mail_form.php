<?php
$sub_menu = "200300";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$token = get_token();

$html_title = "회원메일";

if ($w == "u") {
    $html_title .= "수정";
    $readonly = " readonly";

    $sql = " select * from $g4[mail_table] where ma_id = '$ma_id' ";
    $ma = sql_fetch($sql);
    if (!$ma[ma_id])
        alert("등록된 자료가 없습니다.");
} else {
    $html_title .= "입력";
}

$g4[title] = $html_title;
include_once("./admin.head.php");
?>
<?php echo subtitle("회원메일입력")?>
<form id='fmailform' method='post' action="./mail_update.php" onsubmit="return fmailform_check(this);">
<table class="normal2">
<col width="15%" />
<col />
<tr>
    <th>메일 제목</th>
    <td>
        <input type='hidden' name='w' value='<?php echo $w?>' />
        <input type='hidden' name='ma_id' value='<?php echo $ma[ma_id]?>' />
        <input type='hidden' name='token' value='<?php echo $token?>' />
        <input type='text' name='ma_subject' value='<?php echo $ma[ma_subject]?>' class='text w99 required' title='메일 제목' />
    </td>
</tr>
<tr>
    <th>메일 내용</th>
    <td>
        <?php echo textarea_size("ma_content")?>
        <textarea id='ma_content' name='ma_content' rows='15' cols='106' class='w99 required' title='메일 내용'><?php echo $ma[ma_content]?></textarea>
        <p>{이름} , {별명} , {회원아이디} , {이메일} , {생일}<br />위와 같이 HTML 코드에 삽입하면 해당 내용에 맞게 변환하여 메일 발송합니다.</p>
    </td>
</tr>
</table>
<p class='center'>
    <input type='submit' class='btn1' accesskey='s' value='  확  인  ' />
</p>
</form>

<script type="text/javascript">
function fmailform_check(f)
{
    errmsg = "";
    errfld = "";

    check_field(f.ma_subject, "제목을 입력하세요.");
    check_field(f.ma_content, "내용을 입력하세요.");

    if (errmsg != "") {
        alert(errmsg);
        errfld.focus();
        return false;
    }
    return true;
}

document.fmailform.ma_subject.focus();
</script>

<?php
include_once("./admin.tail.php");
?>
