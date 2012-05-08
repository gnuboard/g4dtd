<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<div id="pop_header">
    <h1><?php echo $g4[title]?></h1>
</div>

<form name="fpasswordlost" method="post" action="#" onsubmit="return fpasswordlost_submit(this);">
<div id="pop_content">
    <table cellspacing="0" class="password_forget">
    <colgroup>
        <col width="30%" />
        <col width="*" />
    </colgroup>
    <tr>
        <th colspan="2" class="title">회원가입시 등록하신 이메일주소 입력를 입력하세요.</th>
    </tr>
    <tr>
        <th><label for="mb_name">이메일주소</label></th>
        <td><input type="text" name="mb_email" id="mb_email" size="30" class="text required email" title="이메일주소"  /></td>
    </tr>
    <tr>
        <th><img id="kcaptcha_image" /></td></th>
        <td>
            <input type="text" name="wr_key" size="10" class="text required" title="자동등록방지" />
            <br />왼쪽의 숫자를 입력하세요.
        </td>
    </tr>
    </table>
</div>

<div id="pop_tailer">
    <input type="image" src="<?php echo $member_skin_path?>/img/btn_nextstep.gif" id="next" />
    <a href="javascript:;" onclick="window.close();"><img src="<?php echo $member_skin_path?>/img/btn_close.gif" alt="닫기" /></a>
</div>
</form>

<script type="text/javascript" src="<?php echo "{$g4['path']}/js/md5.js"?>"></script>
<script type="text/javascript" src="<?php echo "{$g4['path']}/js/jquery.kcaptcha.js"?>"></script>
<script type="text/javascript">
//<![CDATA[
$(function() {
    $("#fpasswordlost").attr("autocomplete", "off");
    $("#mb_email").css("ime-mode", "disabled").focus().select();
});

function fpasswordlost_submit(f)
{
    if (!check_kcaptcha(f.wr_key)) {
        return false;
    }

    <?php
    if ($g4[https_url])
        echo "f.action = '{$g4['https_url']}/{$g4['bbs']}/password_lost2.php';";
    else
        echo "f.action = './password_lost2.php';";
    ?>

    return true;
}

self.focus();

$(function() {
    var sw = screen.width;
    var sh = screen.height;
    var cw = document.body.clientWidth;
    var ch = document.body.clientHeight;
    var top  = sh / 2 - ch / 2 - 100;
    var left = sw / 2 - cw / 2;
    moveTo(left, top);
});
//]]>
</script>
