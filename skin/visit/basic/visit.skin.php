<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<!-- 방문자 -->
<div id="visit_area">
    <h3 class="title">방문자정보</h3>
    <ul class="count">
        <li class="first-child">오늘 : <?php echo number_format($visit[1])?></li>
        <li>어제 : <?php echo number_format($visit[2])?></li>
        <li>최대 : <?php echo number_format($visit[3])?></li>
        <li>전체 : <?php echo number_format($visit[4])?></li>
    </ul>
</div><!-- 방문자 -->
