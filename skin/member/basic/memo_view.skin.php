<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<div id="pop_header">
    <h1><?php echo $g4[title]?></h1>
</div>
<div id="pop_content">

    <div class="view_memo_prev"><a href="<?php echo $prev_link?>"><img src="<?php echo "$member_skin_path/img/btn_memo_view_prev.gif"?>" alt="이전쪽지보기" /></a></div>
    <div class="view_memo_next"><a href="<?php echo $next_link?>"><img src="<?php echo "$member_skin_path/img/btn_memo_view_next.gif"?>" alt="다음쪽지보기" /></a></div>
    <div class="clear"></div>

    <div class="view_area">
        <p>
            <!-- <img src="http://sir.co.kr/data/member/gg/ggul.gif" alt="mb_icon" /> 초코맛님께서 2009-10-14 11:13:13에 보내온 쪽지의 내용입니다 -->
            <?php
            $nick = get_sideview($mb[mb_id], $mb[mb_nick], $mb[mb_email], $mb[mb_homepage]);
            if ($kind == "recv")
                echo "<strong>$nick</strong>님께서 {$memo[me_send_datetime]}에 보내온 쪽지의 내용입니다.";

            if ($kind == "send")
                echo "<strong>$nick</strong>님께 {$memo[me_send_datetime]}에 보낸 쪽지의 내용입니다.";
            ?>
        </p>
        <div class="memo">
            <?php echo conv_content($memo[me_memo], 0)?>
        </div>
    </div>
</div>

<div id="pop_tailer">
    <?php if ($kind == "recv") echo "<a href='./memo_form.php?me_recv_mb_id=$mb[mb_id]&me_id=$memo[me_id]'><img src='$member_skin_path/img/btn_memo_reply.gif' alt='답장하기' /></a>"; ?>
    <a href="./memo.php?kind=<?php echo $kind?>"><img src="<?php echo "$member_skin_path/img/btn_memo_list.gif"?>" alt="목록보기" /></a>
    <a href="javascript:;" onclick="window.close();"><img src="<?php echo "$member_skin_path/img/btn_close.gif"?>" alt="창닫기" /></a>
</div>
