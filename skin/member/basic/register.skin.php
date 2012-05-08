<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<h2 class="member_join_title"><img src="<?php echo $member_skin_path?>/img/title_member_join_11.gif" alt="회원가입약관" /></h2>
<h3 class="member_join_title"><img src="<?php echo $member_skin_path?>/img/title_member_join_12.gif" alt="아래의 약관을 확인 하신 후 이용하시기 바랍니다." /></h3>

<form id="fregister" method="post" action="#" onsubmit="return fregister_submit(this);">
<div class="agreement">
    <img src="<?php echo $member_skin_path?>/img/img_member_join_11.gif" alt="" />
    <div class="agreement_box"><?php echo nl2br(get_text($config['cf_stipulation']))?></div>
    <div>
        &nbsp; <input type="radio" value="1" name="agree" id="agree11" />&nbsp;<label for="agree11">동의합니다.</label>
        &nbsp; <input type="radio" value="0" name="agree" id="agree10" />&nbsp;<label for="agree10">동의하지 않습니다.</label>
    </div>
</div>

<div class="agreement">
    <img src="<?php echo $member_skin_path?>/img/img_member_join_12.gif" alt="" />
    <div class="agreement_box"><?php echo nl2br(get_text($config['cf_privacy']))?></div>
    <div>
        &nbsp; <input type="radio" value="1" name="agree2" id="agree21" />&nbsp;<label for="agree21">동의합니다.</label>
        &nbsp; <input type="radio" value="0" name="agree2" id="agree20" />&nbsp;<label for="agree20">동의하지 않습니다.</label>
    </div>
</div>

<p class="btn_confirm"><input type="image" src="<?php echo $member_skin_path?>/img/btn_confirm.gif" /></p>
</form>

<script type="text/javascript">
//<![CDATA[
function fregister_submit(f)
{
    var agree1 = document.getElementsByName("agree");
    if (!agree1[0].checked) {
        alert("회원가입약관의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
        agree1[0].focus();
        return false;
    }

    var agree2 = document.getElementsByName("agree2");
    if (!agree2[0].checked) {
        alert("개인정보취급방침의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
        agree2[0].focus();
        return false;
    }

    f.action = "./register_form.php";
    return true;
}
//]]>
</script>
