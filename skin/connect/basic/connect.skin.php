<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<!-- 현재접속자 -->
<div id="connect_area">
    <h3 class="title">현재접속자</h3>
    <ul class="count">
        <li><a href="<?php echo $g4[bbs_path]?>/current_connect.php">전체: <?php echo $row['total_cnt']?> (회원 <?php echo $row['mb_cnt']?>)</a></li>
    </ul>
</div><!-- 현재접속자 -->
