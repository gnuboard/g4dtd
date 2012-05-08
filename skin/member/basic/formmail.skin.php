<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<div id="pop_header">
    <h1><?php echo $g4[title]?></h1>
</div>

<form id='fformmail' method='post' action='#' onsubmit='return fformmail_submit(this);' enctype='multipart/form-data'>
<input type='hidden' name='to'     value='<?php echo $email?>' />
<input type='hidden' name='attach' value='2' />
<input type='hidden' name='token'  value='<?php echo $token?>' />
<div id="pop_content">
    <h2><?php echo $name?> 메일보내기</h2>

    <table cellspacing="0" class="table_formmail" summary="메일보내기">
    <caption>메일보내기</caption>
    <col width="150" />
    <col width="*" />
    <?php if ($is_member) { // 회원이면 ?>
    <input type='hidden' name='fnick'  value='<?php echo $member[mb_nick]?>'>
    <input type='hidden' name='fmail'  value='<?php echo $member[mb_email]?>'>
    <?php } else { ?>
    <tr>
        <th>이름</th>
        <td><input type="text" name="fnick" id="fnick" size="20" class="text required minlength=2" title="이름"  /></td>
    </tr>
    <tr>
        <th>메일주소</th>
        <td><input type="text" name="fmail" id="fmail" size="60" class="text required email" title="메일주소"  /></td>
    </tr>
    <?php } ?>
    <tr>
        <th>제목</th>
        <td><input type="text" name="subject" id="subject" size="60" class="text required" title="제목"  /></td>
    </tr>
    <tr>
        <th>선택</th>
        <td>
            <input type="radio" name="type" value="0" checked="checked" /> TEXT
            <input type="radio" name="type" value="1" /> HTML
            <input type="radio" name="type" value="2" /> TEXT+HTML
        </td>
    </tr>
    <tr>
        <th>내용</th>
        <td><textarea name="content" rows="5" cols="1" class="textarea required w90" title="내용"></textarea></td>
     </tr>
    <tr>
        <th>첨부파일 #1</th>
        <td style="text-align:left;"><input type="file" name="file1" id="file1" size="40" class="file" /></td>
    </tr>
    <tr>
        <th>첨부파일 #2</th>
        <td><input type="file" name="file2" id="file2" size="40" class="file" /></td>
    </tr>
    <tr>
        <th><img id='kcaptcha_image' src='#' alt='자동등록방지 이미지' /></th>
        <td><input type="text" name="wr_key" class="text required" title='자동등록방지용 글자' /><p>왼쪽의 글자를 입력하세요.</p></td>
    </tr>
    </table>
</div>

<div id="pop_tailer">
    <p>
        <input type='image' id='btn_submit' src="<?php echo $member_skin_path?>/img/btn_mail_write.gif" alt="메일보내기" /></a>
        <a href="javascript:;" onclick="window.close();"><img src="<?php echo $member_skin_path?>/img/btn_close.gif" alt="창닫기" /></a>
    </p>
</div>
</form>


<script type="text/javascript" src="<?php echo "$g4[path]/js/md5.js"?>"></script>
<script type="text/javascript" src="<?php echo "$g4[path]/js/jquery.kcaptcha.js"?>"></script>
<script type="text/javascript">
$(function() {
    // 첫번째 입력 필드에 포커스 맞추기
    $("#fformmail").attr("autocomplete", "off").find(":input:visible:enabled:first").focus();
});

function fformmail_submit(f)
{
    if (!check_kcaptcha(f.wr_key)) {
        return false;
    }

    if (f.file1.value || f.file2.value) {
        // 4.00.11
        if (!confirm("첨부파일의 용량이 큰경우 전송시간이 오래 걸립니다.\n\n메일보내기가 완료되기 전에 창을 닫거나 새로고침 하지 마십시오."))
            return false;
    }

    document.getElementById('btn_submit').disabled = true;

    f.action = "./formmail_send.php";
    return true;
}
</script>




<?/*?>
<table width="600" height="50" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center" valign="middle" bgcolor="#EBEBEB"><table width="590" height="40" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="25" align="center" bgcolor="#FFFFFF" ><img src="<?php echo $member_skin_path?>/img/icon_01.gif" width="5" height="5"></td>
                    <td width="75" align="left" bgcolor="#FFFFFF" ><font color="#666666"><b><?php echo $g4[title]?></b></font></td>
                    <td width="490" bgcolor="#FFFFFF" ></td>
                </tr>
            </table></td>
    </tr>
</table>

<table width="600" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="600" height="20" colspan="4"></td>
    </tr>
    <tr>
        <td width="30" height="24"></td>
        <td width="20" align="center" valign="middle" bgcolor="#EFEFEF"><img src="<?php echo $member_skin_path?>/img/arrow_01.gif" width="7" height="5"></td>
        <td width="520" align="left" valign="middle" bgcolor="#EFEFEF"><b><?php echo $name?></b>님께 메일보내기</td>
        <td width="30" height="24"></td>
    </tr>
</table>

<form name="fformmail" method="post" onsubmit="return fformmail_submit(this);" enctype="multipart/form-data" style="margin:0px;">
<input type="hidden" name="to"     value="<?php echo $email?>">
<input type="hidden" name="attach" value="2">
<input type="hidden" name="token"  value="<?php echo $token?>">
<table width="600" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td height="330" align="center" valign="top"><table width="540" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td height="20"></td>
        </tr>
        <tr>
            <td height="2" bgcolor="#808080"></td>
        </tr>
        <tr>
            <td width="540" height="2" align="center" valign="top" bgcolor="#FFFFFF">
                <table width="540" border="0" cellspacing="0" cellpadding="0">
                <colgroup width="130">
                <colgroup width="10">
                <colgroup width="400">
                <?php if ($is_member) { // 회원이면 ?>
                <input type='hidden' name='fnick'  value='<?php echo $member[mb_nick]?>'>
                <input type='hidden' name='fmail'  value='<?php echo $member[mb_email]?>'>
                <?php } else { ?>
                <tr>
                    <td height="27" align="center"><b>이름</b></td>
                    <td valign="bottom"><img src="<?php echo $member_skin_path?>/img/l.gif" width="1" height="8"></td>
                    <td><input type=text style='width:90%;' name='fnick' required minlength=2 itemname='이름'></td>
                </tr>
                <tr>
                    <td height="27" align="center"><b>E-mail</b></td>
                    <td valign="bottom"><img src="<?php echo $member_skin_path?>/img/l.gif" width="1" height="8"></td>
                    <td><input type=text style='width:90%;' name='fmail' required email itemname='E-mail'></td>
                </tr>
                <?php } ?>

                <tr>
                    <td height="27" align="center"><b>제목</b></td>
                    <td valign="bottom"><img src="<?php echo $member_skin_path?>/img/l.gif" width="1" height="8"></td>
                    <td><input type=text style='width:90%;' name='subject' required itemname='제목'></td>
                </tr>
                <tr>
                    <td height="1" colspan="3" bgcolor="#E9E9E9"></td>
                </tr>
                <tr>
                    <td height="28" align="center"><b>선택</b></td>
                    <td valign="bottom"><img src="<?php echo $member_skin_path?>/img/l.gif" width="1" height="8"></td>
                    <td><input type='radio' name='type' value='0' checked> TEXT <input type='radio' name='type' value='1' > HTML <input type='radio' name='type' value='2' > TEXT+HTML</td>
                </tr>
                <tr>
                    <td height="1" colspan="3" bgcolor="#E9E9E9"></td>
                </tr>
                <tr>
                    <td height="150" align="center"><b>내용</b></td>
                    <td valign="bottom"><img src="<?php echo $member_skin_path?>/img/l.gif" width="1" height="8"></td>
                    <td><textarea name="content" style='width:90%;' rows='9' required itemname='내용'></textarea></td>
                </tr>
                <tr>
                    <td height="1" colspan="3" bgcolor="#E9E9E9"></td>
                </tr>
                <tr>
                    <td height="27" align="center">첨부파일 #1</td>
                    <td valign="bottom"><img src="<?php echo $member_skin_path?>/img/l.gif" width="1" height="8"></td>
                    <td><input type=file style='width:90%;' name='file1'></td>
                </tr>
                <tr>
                    <td height="1" colspan="3" bgcolor="#E9E9E9"></td>
                </tr>
                <tr>
                    <td height="27" align="center">첨부파일 #2</td>
                    <td valign="bottom"><img src="<?php echo $member_skin_path?>/img/l.gif" width="1" height="8"></td>
                    <td><input type=file style='width:90%;' name='file2'></td>
                </tr>
                <tr>
                    <td height="1" colspan="3" bgcolor="#E9E9E9"></td>
                </tr>
                <tr>
                    <td height="27" align="center"><img id='kcaptcha_image' /></td>
                    <td valign="bottom"><img src="<?php echo $member_skin_path?>/img/l.gif" width="1" height="8"></td>
                    <td><input class='ed' type=input size=10 name=wr_key itemname="자동등록방지" required>&nbsp;&nbsp;왼쪽의 글자를 입력하세요.</td>
                </tr>
                <tr>
                    <td height="1" colspan="3" bgcolor="#E9E9E9"></td>
                </tr>
                </table></td>
        </tr>
        </table></td>
</tr>
<tr>
    <td height="2" align="center" valign="top" bgcolor="#D5D5D5"></td>
</tr>
<tr>
    <td height="2" align="center" valign="top" bgcolor="#E6E6E6"></td>
</tr>
<tr>
    <td height="40" align="center" valign="bottom"><input id=btn_submit type=image src="<?php echo $member_skin_path?>/img/btn_mail_send.gif" border=0>&nbsp;&nbsp;<a href="javascript:window.close();"><img src="<?php echo $member_skin_path?>/img/btn_close.gif" width="48" height="20" border="0"></a></td>
</tr>
</table>
</form>

<script type="text/javascript" src="<?php echo "$g4[path]/js/md5.js"?>"></script>
<script type="text/javascript" src="<?php echo "$g4[path]/js/jquery.kcaptcha.js"?>"></script>
<script type="text/javascript">

function fformmail_submit(f)
{
    if (!check_kcaptcha(f.wr_key)) {
        return false;
    }

    if (f.file1.value || f.file2.value) {
        // 4.00.11
        if (!confirm("첨부파일의 용량이 큰경우 전송시간이 오래 걸립니다.\n\n메일보내기가 완료되기 전에 창을 닫거나 새로고침 하지 마십시오."))
            return false;
    }

    document.getElementById('btn_submit').disabled = true;

    f.action = "./formmail_send.php";
    return true;
}
</script>
<?*/?>
