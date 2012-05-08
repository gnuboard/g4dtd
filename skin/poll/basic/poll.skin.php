<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// 투표번호가 넘어오지 않았다면 가장 큰(최근에 등록한) 투표번호를 얻는다
if (!$po_id) {
    $po_id = $config[cf_max_po_id];

    if (!$po_id) return;
}

$po = sql_fetch(" select * from $g4[poll_table] where po_id = '$po_id' ");
?>

<!-- 설문조사 -->
<div id="poll_area">
    <form id="fpoll" method="post" action="<?php echo $g4['bbs_path']; ?>/poll_update.php">
    <h2 class="title">설문조사</h2>
    <div class="question"><?php echo $po[po_subject]?> <span class="point">(<?php echo $po[po_point]?>p)</span></div>
    <ul class="answer">
        <?php for ($i=1; $i<=9 && $po["po_poll{$i}"]; $i++) { ?>
        <li>
            <label><input type="radio" id="gb_poll_<?php echo $i?>" name="gb_poll" value="<?php echo $i?>" /><?php echo $po['po_poll'.$i]?></label>
        </li>
        <?php } ?>
    </ul>
    <div class="poll_btn">
        <input type="hidden" name="po_id" value="<?php echo $po_id?>" />
        <input type="hidden" name="skin_dir" value="<?php echo $skin_dir?>" />
        <input type="image" src="<?php echo $poll_skin_path?>/img/btn_poll.gif" alt="" />
        <a href="<?php echo $g4['bbs_path']?>/poll_result.php?po_id=<?php echo $po_id?>" class="win_poll"><img src="<?php echo $poll_skin_path?>/img/btn_poll_result.gif" alt="결과보기" /></a>
    </div>
    </form>
</div><!-- 설문조사 -->

<script type='text/javascript'>
//<![CDATA[
$("#fpoll")
.attr("target", "win_poll")
.submit(function() {
    if(!$("#fpoll input[name='gb_poll']:checked").val()) {
        alert("항목을 선택하세요.")
        return false;
    }
    window.open("", "win_poll", "width=616, height=500, scrollbars=1");
});
$(".win_poll").click(function() {
    win_poll(this.href + "&skin_dir=" + $("#fpoll input[name='skin_dir']").val());
	return false;
});
</script>
