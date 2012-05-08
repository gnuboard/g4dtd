<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<div id="password">
    <h2><img src="<?php echo "$member_skin_path/img/title_member_pw.gif"?>" alt="비밀번호확인" /></h2>

    <div class="password_form">
    <form name="fboardpassword" method="post" action="#" onsubmit="return fboardpassword_submit(this);">
    <input type="hidden" name="w"           value="<?php echo $w?>">
    <input type="hidden" name="bo_table"    value="<?php echo $bo_table?>">
    <input type="hidden" name="wr_id"       value="<?php echo $wr_id?>">
    <input type="hidden" name="comment_id"  value="<?php echo $comment_id?>">
    <input type="hidden" name="sfl"         value="<?php echo $sfl?>">
    <input type="hidden" name="stx"         value="<?php echo $stx?>">
    <input type="hidden" name="page"        value="<?php echo $page?>">
        <div class="pwform_01"><label for="password_wr_password"><img src="<?php echo "$member_skin_path/img/img_member_pw.gif"?>" alt="비밀번호" /><input type="password" class="pw_text" maxlength="20" size="15" name="wr_password" id="password_wr_password" /></label></div>
        <div class="pwform_02"><input type="image" src="<?php echo "$member_skin_path/img/btn_member_pw_confirm.gif"?>" alt="" /></div>
    </form>
    </div>
</div>

<script type="text/javascript">
$(function() {
    $("#password .password_form").css("background", "url(<?php echo $member_skin_path?>/img/bg_member_pw.gif) no-repeat left top");
    $("#password_wr_password").focus();
});

function fboardpassword_submit(f)
{
    if (f.wr_password.value.trim() == "") {
        alert("비밀번호를 입력하십시오.");
        f.wr_password.focus();
        return false;
    }

    f.action = "<?php echo $action?>";
    return true;
}
</script>
