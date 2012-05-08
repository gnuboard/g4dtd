<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<h2 class="member_join_title"><img src="<?php echo $member_skin_path?>/img/title_member_join_31.gif" alt="회원가입완료" /></h2>
<h3 class="member_join_title"><img src="<?php echo $member_skin_path?>/img/title_member_join_32.gif" alt="회원님의 가입을 진심으로 축하합니다." /></h3>

<div class="result">
    <p><strong><?php echo $mb['mb_name']?></strong>님의 회원가입을 진심으로 축하합니다.</p>
    <p>회원님의	아이디는 <strong><?php echo $mb['mb_id']?></strong> 입니다.<br /></p>
    <p>회원님의 비밀번호는 아무도 알 수 없는 암호화 코드로 저장되므로 안심하셔도 좋습니다.</p>
    <p>아이디, 비밀번호 분실시에는 회원가입시 입력하신 비밀번호 분실시 질문, 답변을 이용하여 찾을 수 있습니다.</p>
    <?php if ($config['cf_use_email_certify']) { ?>
    <p>이메일(<?php echo $mb['mb_email']?>)로 발송된 내용을 확인한 후 인증하셔야 회원가입이 정상 완료됩니다.</p>
    <?php } ?>
    <p>회원의 탈퇴는 언제든지 가능하며 탈퇴 후 일정기간이 지난 후, 회원님의 모든 소중한 정보는 삭제하고 있습니다.</p>
    <p>감사합니다.</p>
</div>
<p class="btn_confirm"><a href="<?php echo $g4['url']?>/"><img src="<?php echo $member_skin_path?>/img/btn_home.gif" alt="홈으로가기" /></a></p>
