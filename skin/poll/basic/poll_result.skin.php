<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<div id="pop_header">
    <h2>설문조사결과</h2>
</div>

<div id="pop_content">
    <div id="poll_result">
        <div class="question"><?php echo $po_subject?> <span class="poll_count">(전체 <?php echo $nf_total_po_cnt?>표)</span></div>

        <ul class="result">
            <?php for ($i=1; $i<=count($list); $i++) { ?>
            <li class="item"><span><?php echo $list[$i][num]?>.</span><?php echo $list[$i][content]?></li>
            <li class="graph"><img src="<?php echo $poll_skin_path?>/img/poll_graph_y.gif" width="<?php echo (int)$list[$i][bar]?>" height="11" alt="" /></li>
            <li class="num"><?php echo $list[$i][cnt]?> (<?php echo number_format($list[$i][rate], 1)?>%)</li>
            <?php }?>
        </ul>

<?php if ($is_etc) { ?>
    <?php if ($member[mb_level] >= $po[po_level]) { ?>
        <form id="fpollresult" method="post" action="#" onsubmit="return fpollresult_submit(this);">
        <fieldset>
        <input type='hidden' name='po_id' value='<?php echo $po_id?>' />
        <input type='hidden' name='w' />
        <div id="poll_write">
            <p><?php echo $po_etc?></p>
            <ul>
                <li class="name">
                    <?php if ($member[mb_id]) { ?>
                    <input type='hidden' name='pc_name' value='<?php echo cut_str($member[mb_nick],255)?>' />
                    <strong><?php echo $member[mb_nick]?></strong>
                    <?php } else { ?>
                    이름 <input type='text' name='pc_name' size='10' class='text required' title='이름' />
                    <?php }?>
                </li>
                <li class="input">의견 <input type='text' name='pc_idea' size='40' class='text required' title='의견' maxlength="100" /></li>
                <li class="btn"><input type="image" src="<?php echo $poll_skin_path?>/img/ok_btn.gif" alt="" /></li>
            </ul>
        </div>
        </fieldset>
        </form>
    <?php }?>

        <table class="poll_comment_list" cellspacing="0">
        <?php for ($i=0; $i<count($list2); $i++) { ?>
        <tr>
            <td>
                <table class="poll_comment_view" cellspacing="0">
                <colgroup>
                    <col width="70%" />
                    <col width="30%" />
                </colgroup>
                    <tr>
                        <td><?php echo $list2[$i][name]?></td>
                        <td class="date"><?php echo $list2[$i][datetime]?> <?php if ($list2[$i][del]) { echo $list2[$i][del] . "<img src='$poll_skin_path/img/btn_comment_delete.gif' width=45 height=14 border=0></a>"; } ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"><?php echo $list2[$i][idea]?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <?php }?>
        </table>
<?php }?>

        <div class="other_poll">
            <p>다른 투표 결과 보기</p>

            <select name="po_id" id="po_id">
                <?php for ($i=0; $i<count($list3); $i++) { ?>
                <option value='<?php echo $list3[$i][po_id]?>'>[<?php echo str_replace('-','.',$list3[$i][date])?>] <?php echo strip_tags($list3[$i][subject])?></option>
                <?php }?>
            </select>
        </div>
    </div>
</div>

<div id="pop_tailer">
    <a href="javascript:;" onclick="window.close();"><img src="<?php echo $poll_skin_path?>/img/btn_close.gif" alt="창닫기" /></a>
</div>

<script type="text/javascript">
$(function() {
    $('#po_id').bind('change', function() {
        document.location.href = "./poll_result.php?po_id="+this.value;
    });
    <?php if ($po_id) { ?>
    $('#po_id').val('<?php echo $po_id?>');
    <?php }?>
});

function fpollresult_submit(f)
{
    f.action = "./poll_etc_update.php";
    return true;
}
</script>
