<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<div id="pop_header">
    <h1>스크랩하기</h1>
</div>

<form id="fscrap" method="post" action="#" onsubmit="return fscrap_submit(this);">
<div id="pop_content">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table?>" />
    <input type="hidden" name="wr_id"    value="<?php echo $wr_id?>" />
    <table cellspacing="0" class="write_table">
    <colgroup>
        <col width="50" />
        <col width="*" />
    </colgroup>
    <tr>
        <th>제목</th>
        <td><?php echo get_text(cut_str($write[wr_subject], 255))?></td>
    </tr>
    <tr>
        <th>코멘트</th>
        <td>
            <textarea name="wr_content" id="wr_content" class="textarea" cols="1" rows="1"></textarea>
            <p class="guide">해당 게시물에 코멘트를 남깁니다.</p>
        </td>
    </tr>
    </table>
</div>

<div id="pop_tailer">
    <input type="image" src="<?php echo $member_skin_path?>/img/btn_newwin_confirm.gif" alt="확인" />
</div>
</form>

<script type="text/javascript">
//<![CDATA[
$(function() {
    $("#wr_content").focus();
});

function fscrap_submit(f)
{
    f.action = "./scrap_popin_update.php";
    return true;
}
//]]>
</script>
