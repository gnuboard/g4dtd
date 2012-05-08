<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<div id="re_password">
    <h2><img src="<?php echo $member_skin_path?>/img/title_member_re_pw.gif" alt="비밀번호확인" /></h2>

    <form id="fconfirm" method="post" action="#" onsubmit="return fconfirm_submit(this);">
    <div class="re_pw_form">
        <input type="hidden" name="mb_id" value="<?php echo $member[mb_id]?>" />
        <input type="hidden" name="w"  value="u" />
        <div class="logform_01"><img src="<?php echo $member_skin_path?>/img/img_member_login_id.gif" alt="아이디" /> <span class="userid"><?php echo $member[mb_id]?></span></div>
        <div class="logform_01">
            <label>
                <img src="<?php echo $member_skin_path?>/img/img_member_login_pw.gif" alt="비밀번호" />
                <input type="password" name="mb_password" maxlength="20" size="15" class="login_text required" title="비밀번호" />
            </label>
        </div>
        <div class="logform_02"><input type="image" src="<?php echo $member_skin_path?>/img/btn_member_re_pw_confirm.gif" /></div>
    </div>
    </form>
</div>

<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
    $("#re_password .re_pw_form").css({"background":"url(<?php echo $member_skin_path?>/img/bg_member_re_pw.gif) no-repeat left top"});
    $("#confirm_mb_password").focus();
});

function fconfirm_submit(f)
{
    f.action = "<?php echo $url?>";
    return true;
}
//]]>
</script>
