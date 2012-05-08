<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<!-- 로그인 이후 -->
<div id="login_area">
	<h2 class="skip">로그인</h2>
    <div class="log01"><strong><?php echo $nick?></strong>님</div>
    <div class="log01"><a href="<?php echo "$g4[bbs_path]/point.php"?>" id="outlogin_point" class="win_point">포인트 : <?php echo $point?>점</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        권한 : <?php echo $member[mb_level]?></div>
<?php if ($is_admin == "super" || $is_auth) { ?>
    <div class="log02">
        <a href="<?php echo $g4['admin_path']?>/"><img src="<?php echo $outlogin_skin_path?>/img/btn_admin.gif" alt="관리자" width="34" height="11" /></a>
    </div>
<?php } ?>
    <div class="log04">
        <a href="<?php echo "$g4[bbs_path]/memo.php"?>" id="outlogin_memo" class="win_memo">쪽지</a>&nbsp;&nbsp;&nbsp;
        <a href="<?php echo "$g4[bbs_path]/scrap.php"?>" id="outlogin_scrap" class="win_scrap">스크랩</a>
    </div>
    <div>
        <a href="<?php echo "$g4[bbs_path]/member_confirm.php?url=register_form.php"?>"><img src="<?php echo $outlogin_skin_path?>/img/btn_myinfo.gif" alt="정보수정" /></a>
        <a href="<?php echo "$g4[bbs_path]/logout.php"?>"><img src="<?php echo $outlogin_skin_path?>/img/btn_logout.gif" alt="로그아웃" /></a>
    </div>
</div><!-- 로그인 이후 -->
