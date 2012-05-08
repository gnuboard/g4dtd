<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<div id="pop_header">
    <h1><?php echo $g4[title]?></h1>
</div>

<form id="fmemo" method="post" action = "#" onsubmit="return fmemo_submit(this);">
<div id="pop_content">

    <div class="memo_menu">
        <ul>
            <li><a href="./memo.php?kind=recv"><span>받은쪽지함</span></a></li>
            <li><a href="./memo.php?kind=send"><span>보낸쪽지함</span></a></li>
            <li><a href="./memo_form.php" class="selected"><span>쪽지보내기</span></a></li>
        </ul>
    </div>

    <?php if ($config[cf_memo_send_point]) { ?>
    <div class='msg'>* 쪽지를 보낼 때에는 회원당 <?php echo number_format($config[cf_memo_send_point])?>점의 포인트가 차감됩니다.</div>
    <?php } ?>

    <table cellspacing="0" class="write_table">
    <colgroup>
        <col width="23%" />
        <col width="*" />
    </colgroup>
    <tr>
        <th>받는 회원아이디</th>
        <td><input type="text" name="me_recv_mb_id" id="me_recv_mb_id" class="text required" style="width:95%;" title="받는 회원아이디" value="<?php echo $me_recv_mb_id?>"  /><p>여러 회원에게 보낼때는 컴마(,)로 구분하세요.</p></td>
    </tr>
    <tr>
        <th>쪽지 내용</th>
        <td><textarea name="me_memo" id="me_memo" class="textarea required" title="쪽지 내용" cols="1" rows="1"></textarea></td>
     </tr>
    <tr>
        <th><img id="kcaptcha_image" /></th>
        <td>
            <input type="input" name="wr_key" class="text required" title="자동등록방지" />&nbsp;&nbsp;왼쪽의 글자를 입력하세요.
        </td>
    </tr>
    </table>
</div>

<div id="pop_tailer">
    <input type="image" src="<?php echo $member_skin_path?>/img/btn_memo_write.gif" alt="쪽지보내기" />
    <a href="javascript:;" onclick="window.close();"><img src="<?php echo $member_skin_path?>/img/btn_close.gif" alt="창닫기" /></a>
</div>
</form>

<script type="text/javascript" src="<?php echo $g4[path]?>/js/md5.js"></script>
<script type="text/javascript" src="<?php echo $g4[path]?>/js/jquery.kcaptcha.js"?>"></script>
<script type="text/javascript">
//<![CDATA[
$(function() {
    // 첫번째 입력 필드에 포커스 맞추기
    $("#fmemo").attr("autocomplete", "off").find(":input[type=text]:visible:enabled:first").focus();
    /*
    if ($("#me_recv_mb_id").val() == "")
        $("#me_recv_mb_id").focus();
    else
        $("#me_memo").focus();
    */

    $(".href_click").bind("click", function(e) {
        if (typeof(opener.document) != "unknown") {
            opener.document.location.href = this.href;
        }
    });

    $(".del_click").bind("click", function(e) {
        del(this.href);
    });
});

function fmemo_submit(f)
{
    if (!check_kcaptcha(f.wr_key)) {
        return false;
    }

    f.action = "./memo_form_update.php";
    return true;
}
//]]>
</script>
