<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$is_nick_modify = false;
// 닉네임 수정일이 지났다면 수정가능
if ($member['mb_nick_date'] <= date("Y-m-d", $g4['server_time'] - ($config['cf_nick_modify'] * 86400))) {
    $is_nick_modify = true;
}

// 남아있는 별명 수정일
$nick_modify_days = $config['cf_nick_modify'] - floor(($g4['server_time'] - strtotime($member['mb_nick_date'])) / 86400);

list($mb_tel1, $mb_tel2, $mb_tel3) = explode("-", $member['mb_tel']);
list($mb_hp1,  $mb_hp2,  $mb_hp3)  = explode("-", $member['mb_hp']);
?>

<?php if ($w == "") { ?>
<h2 class="member_join_title"><img src="<?php echo $member_skin_path?>/img/title_member_join_21.gif" alt="회원가입폼작성" /></h2>
<?php } ?>
<h3 class="member_join_title"><img src="<?php echo $member_skin_path?>/img/title_member_join_22.gif" alt="아래 입력칸에 해당하는 정확한 회원정보를 입력해주세요." /></h3>

<form id="fregister" method="post" action="./register_form_update.php" class="register_form" enctype="multipart/form-data">
<table summary="회원가입을 위한 사용자 입력 양식입니다. 천천히 차례대로 사용자의 정보를 기입해 주시기 바랍니다.">
<col width="150" />
<col width="*" />
<tr class="first_child">
    <th>아이디</th>
    <td>
        <input type="hidden" name="w"     value="<?php echo $w?>" />
        <input type="hidden" name="url"   value="<?php echo $urlencode?>" />
        <input type="hidden" name="token" value="<?php echo $token?>" />

        <?php if ($w == "") { ?>
        <p><input type="text" name="mb_id" id="reg_mb_id" maxlength="20" size="20" class="text required alnum_ minlength=4" title="회원아이디" /> <span id='msg_mb_id'></span></p>
        <p class="guide">※ 영문자, 숫자, _ 만 입력 가능. 최소 4글자 이상 입력하세요.</p>
        <?php } else if ($w == "u") { ?>
        <input type="hidden" name="mb_id" id="reg_mb_id" value="<?php echo $member['mb_id']?>" /><p><span style="font-size:15px;"><strong><?php echo $member['mb_id']?></strong></span></p>
        <?php } ?>
    </td>
</tr>
<tr>
    <th>비밀번호</th>
    <td>
        <p><input type="password" name="mb_password" id="reg_mb_password" size="20" maxlength="20" class="text minlength=4 <?php echo ($w=="")?"required":"";?>" title="비밀번호" /></p>
        <p class="guide">최소 4글자 이상 입력하세요.</p>
    </td>
</tr>
<tr>
    <th>비밀번호 확인</th>
    <td>
        <p><input type="password" name="mb_password_re" id="reg_mb_password_re" size="20" maxlength="20" class="text minlength=4 <?php echo ($w=="")?"required":"";?>" title="비밀번호 확인" /></p>
    </td>
</tr>
<!--
<tr>
    <th>비밀번호 분실시 질문</th>
    <td>
        <p>
            <select name="mb_password_q_select" id="reg_mb_password_q_select">
              <option value="">선택하세요.</option>
              <option value="내가 좋아하는 캐릭터는?">내가 좋아하는 캐릭터는?</option>
              <option value="타인이 모르는 자신만의 신체비밀이 있다면?">타인이 모르는 자신만의 신체비밀이 있다면?</option>
              <option value="자신의 인생 좌우명은?">자신의 인생 좌우명은?</option>
              <option value="초등학교 때 기억에 남는 짝꿍 이름은?">초등학교 때 기억에 남는 짝꿍 이름은?</option>
              <option value="유년시절 가장 생각나는 친구 이름은?">유년시절 가장 생각나는 친구 이름은?</option>
              <option value="가장 기억에 남는 선생님 성함은?">가장 기억에 남는 선생님 성함은?</option>
              <option value="친구들에게 공개하지 않은 어릴 적 별명이 있다면?">친구들에게 공개하지 않은 어릴 적 별명이 있다면?</option>
              <option value="다시 태어나면 되고 싶은 것은?">다시 태어나면 되고 싶은 것은?</option>
              <option value="가장 감명깊게 본 영화는?">가장 감명깊게 본 영화는?</option>
              <option value="읽은 책 중에서 좋아하는 구절이 있다면?">읽은 책 중에서 좋아하는 구절이 있다면?</option>
              <option value="기억에 남는 추억의 장소는?">기억에 남는 추억의 장소는?</option>
              <option value="인상 깊게 읽은 책 이름은?">인상 깊게 읽은 책 이름은?</option>
              <option value="자신의 보물 제1호는?">자신의 보물 제1호는?</option>
              <option value="받았던 선물 중 기억에 남는 독특한 선물은?">받았던 선물 중 기억에 남는 독특한 선물은?</option>
              <option value="자신이 두번째로 존경하는 인물은?">자신이 두번째로 존경하는 인물은?</option>
              <option value="아버지의 성함은?">아버지의 성함은?</option>
              <option value="어머니의 성함은?">어머니의 성함은?</option>
         </select>
        </p>
        <p class="guide"><input type="text" name="mb_password_q" id="reg_mb_password_q" size="50" class="text required" title="비밀번호 분실시 질문" value="<?php echo $member['mb_password_q']?>" /></p>
        <p class="guide">비밀번호 분실시 질문을 선택하시거나 직접 입력하세요.</p>
    </td>
</tr>
<tr>
    <th>비밀번호 분실시 답변</th>
    <td>
        <p><input type="text" name="mb_password_a" id="reg_mb_password_a" class="text required nospace" title="비밀번호 분실시 답변" value="<?php echo $member['mb_password_a']?>" /></p>
        <p class="guide">비밀번호 분실시 질문에 대한 답변을 공백 없이 입력하세요.</p>
    </td>
</tr>
-->
<tr>
    <th>이름</th>
    <td>
        <?php if ($w == "") { ?>
        <p><input type="text" id="reg_mb_name" name="mb_name" class="text required hangul minlength=2" title="이름" value="" /></p>
        <p class="guide">이름은 공백 없이 한글만 최소 2글자 이상 입력하세요.</p>
        <?php } else if ($w == "u") { ?>
        <input type="hidden" id="reg_mb_name" name="mb_name" value="<?php echo $member['mb_name']?>" />
        <p><span style="font-size:15px;"><strong><?php echo $member['mb_name']?></strong></span></p>
        <?php } ?>
    </td>
</tr>

<tr>
    <th>닉네임</th>
    <td>
        <?php if ($is_nick_modify) { ?>
        <p><input type="text" id="reg_mb_nick" name="mb_nick" maxlength="20" class="text required hanalnum minlength=2" title="닉네임" value="<?php echo $member['mb_nick']?>" /> <span id='msg_mb_nick'></span></p>
        <p class="guide">닉네임은 공백 없이 한글,영문,숫자만 입력 가능 (한글2자, 영문4자 이상)</p>
        <p class="guide">게시판에 글을 쓰는 경우 글쓴이에 이름 대신 표시합니다.</p>
        <?php } else { ?>
        <p>
            <input type="hidden" name="mb_nick" value="<?php echo $member['mb_nick']?>" />
            <span style="font-size:15px;"><strong><?php echo $member['mb_nick']?></strong></span>
        </p>
        <?php } ?>
        <p class="guide">
            <input type="hidden" name="mb_nick_default" value="<?php echo $member['mb_nick']?>" />
            닉네임은 <?php echo (int)$config['cf_nick_modify']?>일에 한번만 변경이 가능합니다.
        </p>

        <?php if ($w=="u" && $nick_modify_days) { ?>
        <p class="guide">앞으로 <?php echo $nick_modify_days?>일후에 닉네임 변경이 가능합니다.</p>
        <?php } ?>
    </td>
</tr>
<tr>
    <th>이메일 주소</th>
    <td>
        <p><input type="hidden" name="old_email" value="<?php echo $member['mb_email']?>" />
            <input type="text" id="reg_mb_email" name="mb_email" size="50" maxlength="100" class="text required email" title="이메일 주소" value="<?php echo $member['mb_email']?>" /> <span id='msg_mb_email'></span></p>
        <p class="guide">입력 예) gnuboard@sir.co.kr , 한글 메일 주소 지원 안함</p>
        <?php if ($config['cf_use_email_certify']) { ?>
        <?php if ($w == "") { ?>
        <p class="guide">이메일로 발송된 내용을 확인한 후 인증하셔야 회원가입이 완료됩니다.</p>
        <?php } else if ($w == "u") { ?>
        <p class="guide">이메일 주소를 변경하시면 다시 인증하셔야 합니다.</p>
        <?php } ?>
        <?php } ?>
    </td>
</tr>

<?/* if ($w=="") { */?>
<tr>
    <th>생년월일</th>
    <td>
        <p>
            <input type="text" name="mb_birth" id="reg_mb_birth" size="10" maxlength="8" class="text datepicker" style="margin-right:5px;" />
        </p>
        <p class="guide">입력예) <?php echo date("Ymd", $g4['server_time']-25*365*86400)?></p>
        <p class="guide">만 14세 미만의 아동은 법정대리인의 동의를 얻어야 회원가입이 가능합니다.</p>
    </td>
</tr>
<tr>
    <th>성별</th>
    <td>
        <p>
            <input type="radio" name="mb_sex" id="reg_mb_sex1" value="M" /> <label for="reg_mb_sex1">남자</label>
            &nbsp;
            <input type="radio" name="mb_sex" id="reg_mb_sex2" value="F" /> <label for="reg_mb_sex2">여자</label>
        </p>
    </td>
</tr>
<?php /* } */ ?>

<?php if ($config['cf_use_homepage'] || $config['cf_req_homepage']) { ?>
<tr>
    <th>홈페이지</th>
    <td>
        <p>
            <input type="text" name="mb_homepage" id="mb_homepage" size="38" maxlength="255" class="text <?php echo $config['cf_req_homepage']?'required':'';?>" title="홈페이지" value="<?php echo $member['mb_homepage']?>" />
        </p>
    </td>
</tr>
<?php } ?>

<?php if ($config['cf_use_tel'] || $config['cf_req_tel']) { ?>
<tr>
    <th>전화번호</th>
    <td>
        <p>
            <input type="hidden" name="mb_tel" />
            <select name="mb_tel1" id="reg_mb_tel1" class="<?php echo $config['cf_req_tel']?'required':'';?>" title="전화번호 지역번호">
            <option value="">선택</option>
            <option value="02" >02</option>
            <option value="031">031</option>
            <option value="032">032</option>
            <option value="033">033</option>
            <option value="041">041</option>
            <option value="042">042</option>
            <option value="043">043</option>
            <option value="051">051</option>
            <option value="052">052</option>
            <option value="053">053</option>
            <option value="054">054</option>
            <option value="055">055</option>
            <option value="061">061</option>
            <option value="062">062</option>
            <option value="063">063</option>
            <option value="064">064</option>
            <option value='070'>070</option>
            <option value='080'>080</option>
            <option value='0303'>0303</option>
            <option value='0502'>0502</option>
            <option value='0505'>0505</option>
            <option value='0506'>0506</option>
            </select>
             -
            <input type="text" name="mb_tel2" id="mb_tel2" size="5" maxlength="4" class="text <?php echo $config['cf_req_tel']?'required numeric minlength=3':'';?>" title="전화번호 국번" value="<?php echo $mb_tel2?>" />
             -
            <input type="text" name="mb_tel3" id="mb_tel3" size="5" maxlength="4" class="text <?php echo $config['cf_req_tel']?'required numeric minlength=4':'';?>" title="전화번호 번호" value="<?php echo $mb_tel3?>" />
        </p>
    </td>
</tr>
<?php } ?>

<?php if ($config['cf_use_hp'] || $config['cf_req_hp']) { ?>
<tr>
    <th>휴대폰번호</th>
    <td>
        <p>
            <input type="hidden" name="mb_hp" />
            <select name="mb_hp1" id="reg_mb_hp1" class="<?php echo $config['cf_req_hp']?'required':'';?>" title="휴대폰 앞번호">
            <option value="">선택</option>
            <option value="010">010</option>
            <option value="011">011</option>
            <option value="016">016</option>
            <option value="017">017</option>
            <option value="018">018</option>
            <option value="019">019</option>
            </select>
             -
            <input type="text" name="mb_hp2" id="mb_hp2" size="5" maxlength="4" class="text <?php echo $config['cf_req_hp']?'required numeric minlength=3':'';?>" title="휴대폰 중간번호" value="<?php echo $mb_hp2?>" />
             -
            <input type="text" name="mb_hp3" id="mb_hp3" size="5" maxlength="4" class="text <?php echo $config['cf_req_hp']?'required numeric minlength=4':'';?>" title="휴대폰 뒷번호" value="<?php echo $mb_hp3?>" />
        </p>
    </td>
</tr>
<?php } ?>

<?php if ($config['cf_use_addr'] || $config['cf_req_addr']) { ?>
<tr>
    <th>주소</th>
    <td>
        <p>
            <input type="hidden" id="cf_req_addr" value="<?php echo $config['cf_req_addr']?>" />
            <input type="text" id="mb_zip1" name="mb_zip1" size="5" maxlength="3" readonly="readonly" class="text <?php echo $config['cf_req_addr']?'required':'';?>" title="우편번호 앞자리" value="<?php echo $member['mb_zip1']?>" />
            -
            <input type="text" id="mb_zip2" name="mb_zip2" size="5" maxlength="3" readonly="readonly" class="text <?php echo $config['cf_req_addr']?'required':'';?>" title="우편번호 뒷자리" value="<?php echo $member['mb_zip2']?>" />
            <a href="<?php echo $g4['bbs_path']?>/zip.php?frm_name=fregister&amp;frm_zip1=mb_zip1&amp;frm_zip2=mb_zip2&amp;frm_addr1=mb_addr1&amp;frm_addr2=mb_addr2" class="win_zip_find" onclick="return false;"><img src="<?php echo $member_skin_path?>/img/btn_zip.gif" alt="우편번호검색" /></a>
        </p>
        <p class="guide"><input type="text" id="mb_addr1" name="mb_addr1" size="60" readonly="readonly" class="text <?php echo $config['cf_req_addr']?'required':'';?>" title="주소" value="<?php echo $member['mb_addr1']?>" /></p>
        <p class="guide"><input type="text" id="mb_addr2" name="mb_addr2" size="60" class="text <?php echo $config['cf_req_addr']?'required':'';?>" title="상세주소" value="<?php echo $member['mb_addr2']?>" /></p>
    </td>
</tr>
<?php } ?>

<?php if ($config['cf_use_signature'] || $config['cf_req_signature']) { ?>
<tr>
    <th>서명</th>
    <td>
        <p>
            <input type="hidden" id="cf_req_signature" value="<?php echo $config['cf_req_signature']?>" />
            <textarea name="mb_signature" id="mb_signature" class="textarea <?php echo $config['cf_req_signature']?'required':'';?>" title="서명" rows="3" cols="1"><?php echo $member['mb_signature']?></textarea>
        </p>
    </td>
</tr>
<?php } ?>

<?php if ($config['cf_use_profile'] || $config['cf_req_profile']) { ?>
<tr>
    <th>자기소개</th>
    <td>
        <p>
            <input type="hidden" id="cf_req_profile" value="<?php echo $config['cf_req_profile']?>" />
            <textarea name="mb_profile" id="mb_profile" class="textarea <?php echo $config['cf_req_profile']?'required':'';?>" title="자기소개" rows="3" cols="1"><?php echo $member['mb_profile']?></textarea>
        </p>
    </td>
</tr>
<?php } ?>

<?php if ($w == "u" && $member['mb_level'] >= $config['cf_icon_level']) { ?>
<tr>
    <th>회원아이콘</th>
    <td>
        <p><input type="file" class="file" name="mb_icon" id="reg_mb_icon" size="50" class="extension=gif" /></p>
        <p class="guide">gif 이미지 / 가로(<?php echo $config['cf_member_icon_width']?>픽셀) x 세로(<?php echo $config['cf_member_icon_height']?>픽셀) / 용량 <?php echo number_format($config['cf_member_icon_size'])?> 바이트 이하만 등록됩니다.</p>
        <?php if (file_exists($mb_icon)) { ?>
            <p><img src="<?php echo $mb_icon?>" /> <input type="checkbox" name="del_mb_icon" id="del_mb_icon" value="1" /> <label for="del_mb_icon">아이콘 삭제</label></p>
        <?php } ?>
    </td>
</tr>
<?php } ?>

<tr>
    <th>메일링 서비스</th>
    <td>
        <p><label for="mb_mailling">
            <input type="checkbox" name="mb_mailling" id="mb_mailling" value="1" <?php echo ($w=="" || $member['mb_mailling'])?'checked="checked"':'';?> /> 홍보성 메일을 받겠습니다.</label></p>
    </td>
</tr>
<tr>
    <th>문자 수신여부</th>
    <td>
        <p><label for="mb_sms">
            <input type="checkbox" name="mb_sms" id="mb_sms" value="1" <?php echo ($w=="" || $member['mb_sms'])?'checked="checked"':'';?> /> 홍보성 문자메세지를 받겠습니다.</label></p>
    </td>
</tr>

<tr>
    <th>정보공개</th>
    <td>
        <?php if ($member['mb_open_date'] <= date("Y-m-d", $g4['server_time'] - ($config['cf_open_modify'] * 86400))) { // 정보공개 수정일이 지났다면 수정가능 ?>
        <input type="hidden" name="mb_open_default" value="<?php echo $member['mb_open']?>" />
        <p><label for="mb_open">
            <input type="checkbox" name="mb_open" id="mb_open" value="1" <?php echo ($w=="" || $member['mb_open'])?'checked="checked"':'';?> /> 나의 정보를 공개합니다.</label></p>
        <p class="guide">
            정보공개를 바꾸시면 앞으로 <?php echo (int)$config['cf_open_modify']?>일 이내에는 변경이 안됩니다.<br />
            이렇게 하는 이유는 잦은 정보공개 수정으로 인하여 쪽지를 보낸 후 받지 않는 경우를 막기 위해서 입니다.
        </p>
        <?php } else { ?>
        <input type="hidden" name="mb_open" value="<?php echo $member['mb_open']?>">
        정보공개는 수정후 <?php echo (int)$config['cf_open_modify']?>일 이내, <?php echo date("Y년 m월 j일", strtotime("{$member['mb_open_date']} 00:00:00") + ($config['cf_open_modify'] * 86400))?> 까지는 변경이 안됩니다.<br />
        이렇게 하는 이유는 잦은 정보공개 수정으로 인하여 쪽지를 보낸 후 받지 않는 경우를 막기 위해서 입니다.
        <?php } ?>
    </td>
</tr>

<?php if ($w == "" && $config['cf_use_recommend']) { ?>
<tr>
    <th>추천인 아이디</th>
    <td>
        <p><input type="text" id="reg_mb_recommend" name="mb_recommend" size="15" class="text" /> <span id='msg_mb_recommend'></span></p>
        <p class="guide">자기 자신 또는 탈퇴, 차단, 인증이 안된 회원은 추천할 수 없습니다.</p>
    </td>
</tr>
<?php } ?>

<tr class="last_child">
    <th><img id='kcaptcha_image' src='#' alt='자동등록방지 이미지' /></th>
    <td>
        <p><input type="text" name="wr_key" size="10" class="captcha_key text required" title="자동등록방지 코드" />
        왼쪽의 자동등록방지용 코드를 순서대로 입력하세요.</p>
    </td>
</tr>
</table>

<p class="btn_confirm">
    <input type="image" id="btn_confirm" src="<?php echo $member_skin_path?>/img/btn_confirm.gif" />
</p>

</form>


<script type="text/javascript" src="<?php echo $g4['path']?>/js/md5.js"></script>
<script type="text/javascript" src="<?php echo $g4['path']?>/js/jquery.kcaptcha.js"></script>
<script type="text/javascript">
//<![CDATA[
var enabled_mb_id    = false;
var enabled_mb_name  = false;
var enabled_mb_nick  = false;
var enabled_mb_email = false;
var enabled_mb_recommend = false;

// 저장값과 입력값이 같다면 ajax 코드 실행하지 않음
var save_mb_id    = null;
var save_mb_name  = null;
var save_mb_nick  = null;
var save_mb_email = null;
var save_mb_recommend = null;

var d = new Date();

$(function() {

    $('.datepicker').datepicker({
        changeMonth: true,
		changeYear: true,
        dateFormat: "yymmdd",
        maxDate: "+0d",
        yearRange: (d.getFullYear()-50)+":"+(d.getFullYear())
    });

    // 회원아이디 검사
    $("#reg_mb_id").bind("blur", function() {
        this.value = this.value.toLowerCase();
        if (save_mb_id != this.value) {
            enabled_mb_id = false;
            $.ajax({
                async: false,
                cache: false,
                type: "POST",
                url: "<?php echo $member_skin_path?>/ajax_mb_id_check.php",
                data: {
                    "reg_mb_id": $(this).val()
                },
                success: function(data, textStatus) {
                    var msg = $("#msg_mb_id");
                    switch(data) {
                        case "110" : msg.html("영소문자, 숫자, _ 만 입력하세요.").removeClass().addClass("ajax_error"); break;
                        case "120" : msg.html("최소 4글자 이상 입력하세요.").removeClass().addClass("ajax_error"); break;
                        case "130" : msg.html("이미 사용중인 아이디 입니다.").removeClass().addClass("ajax_error"); break;
                        case "140" : msg.html("예약어로 사용할 수 없는 아이디 입니다.").removeClass().addClass("ajax_error"); break;
                        case "000" :
                            msg.html("사용하셔도 좋은 아이디 입니다.").removeClass().addClass("ajax_success");
                            enabled_mb_id = true;
                            break;
                        default : alert( "잘못된 접근입니다.\n\n" + result ); break;
                    }
                }
            });
        }
        save_mb_id = this.value;
    });

    // 회원 별명 검사
    $("#reg_mb_nick").bind("blur", function() {
        if (save_mb_nick != this.value) {
            enabled_mb_nick = false;
            $.ajax({
                async: false,
                cache: false,
                type: "POST",
                url: "<?php echo $member_skin_path?>/ajax_mb_nick_check.php",
                data: {
                    "reg_mb_nick": $(this).val()
                },
                success: function(data, textStatus) {
                    var msg = $("#msg_mb_nick");
                    switch(data) {
                        case "110" : msg.html("별명은 공백 없이 한글, 영문, 숫자만 입력 가능합니다.").removeClass().addClass("ajax_error"); break;
                        case "120" : msg.html("한글 2글자, 영문 4글자 이상 입력 가능합니다.").removeClass().addClass("ajax_error"); break;
                        case "130" : msg.html("이미 존재하는 별명입니다.").removeClass().addClass("ajax_error"); break;
                        case "140" : msg.html("예약어로 사용할 수 없는 별명 입니다.").removeClass().addClass("ajax_error"); break;
                        case "000" :
                            msg.html("사용하셔도 좋은 별명 입니다.").removeClass().addClass("ajax_success");
                            enabled_mb_nick = true;
                            break;
                        default : alert( "잘못된 접근입니다.\n\n" + result ); break;
                    }
                }
            });
        }
        save_mb_nick = this.value;
    });

    // 이메일 검사
    $("#reg_mb_email").bind("blur", function() {
        if (save_mb_email != this.value) {
            enabled_mb_email = false;
            $.ajax({
                async: false,
                cache: false,
                type: "POST",
                url: "<?php echo $member_skin_path?>/ajax_mb_email_check.php",
                data: {
                    "reg_mb_id": $("#reg_mb_id").val(),
                    "reg_mb_email": $("#reg_mb_email").val()
                },
                success: function(data, textStatus) {
                    var msg = $("#msg_mb_email");
                    switch(data) {
                        case "110" : msg.html("이메일 주소를 입력하세요.").removeClass().addClass("ajax_error"); break;
                        case "120" : msg.html("이메일 주소가 형식에 맞지 않습니다.").removeClass().addClass("ajax_error"); break;
                        case "130" : msg.html("이미 존재하는 이메일 주소입니다.").removeClass().addClass("ajax_error"); break;
                        case "000" :
                            msg.html("사용하셔도 좋은 이메일 주소입니다.").removeClass().addClass("ajax_success");
                            enabled_mb_email = true;
                            break;
                        default : alert( "잘못된 접근입니다.\n\n" + result ); break;
                    }
                }
            });
        }
        save_mb_email = this.value;
    });

    // 추천인 아이디 검사
    $("#reg_mb_recommend").bind("blur", function() {
        if (this.value.trim() != "") {
            if (save_mb_recommend != this.value) {
                enabled_mb_recommend = false;
                $.ajax({
                    async: false,
                    cache: false,
                    type: "POST",
                    url: "<?php echo $member_skin_path?>/ajax_mb_recommend_check.php",
                    data: {
                        "reg_mb_id": $("#reg_mb_id").val(),
                        "reg_mb_recommend": $("#reg_mb_recommend").val()
                    },
                    success: function(data, textStatus) {
                        var msg = $("#msg_mb_recommend");
                        switch(data) {
                            case "110" : msg.html("영소문자, 숫자, _ 만 입력하세요.").removeClass().addClass("ajax_error"); break;
                            case "120" : msg.html("최소 4글자 이상 입력하세요.").removeClass().addClass("ajax_error"); break;
                            case "130" : msg.html("존재하지 않은 아이디로 추천할 수 없습니다.").removeClass().addClass("ajax_error"); break;
                            case "140" : msg.html("자기 자신을 추천할 수 없습니다.").removeClass().addClass("ajax_error"); break;
                            case "150" : msg.html("추천할 수 없는 아이디 입니다.").removeClass().addClass("ajax_error"); break;
                            case "000" :
                                msg.html("사용하셔도 좋은 추천인 아이디입니다.").removeClass().addClass("ajax_success");
                                enabled_mb_recommend = true;
                                break;
                            default : alert( "잘못된 접근입니다.\n\n" + result ); break;
                        }
                    }
                });
            }
        }
        save_mb_recommend = this.value;
    });

    $("#reg_mb_password_q_select").bind("change", function() {
        if (this.value) {
            $("#reg_mb_password_q").val(this.value);
        }
    });

    $("#reg_mb_tel1").val("<?php echo $mb_tel1?>");
    $("#reg_mb_hp1").val("<?php echo $mb_hp1?>");

    // 첫번째 입력 필드에 포커스 맞추기
    $("#fregister").attr("autocomplete", "off").find(":input:visible:enabled:first").focus();
	$("form.register_form").submit(function() { return fregister_submit(document.getElementById("fregister")); });
});

// 날짜 유효성 검사
function is_valid_date(yyyy, mm, dd)
{
    var d = new Date(yyyy, mm-1, dd);
    return (d.getFullYear()==yyyy && d.getMonth()+1==mm && d.getDate()==dd) ? true : false;
}

function fregister_submit(f)
{
    if (f.w.value == "") {
        if (!enabled_mb_id) {
            alert("회원아이디를 입력하지 않았거나 입력에 오류가 있습니다.");
            //f.mb_id.focus();
            f.mb_id.select();
            return false;
        }
    }

    if (f.mb_password.value != f.mb_password_re.value) {
        alert("비밀번호와 비밀번호 확인이 같지 않습니다.");
        //f.mb_password_re.focus();
        f.mb_password_re.select();
        return false;
    }

    if (typeof(f.mb_nick) != "undefined") {
        if (f.mb_nick.value.trim() == "" || f.mb_nick.value != f.mb_nick.defaultValue) {
            if (f.mb_nick.type == "text") {
                if (!enabled_mb_nick) {
                    alert("닉네임을 입력하지 않았거나 입력에 오류가 있습니다.");
                    //f.mb_nick.focus();
                    f.mb_nick.select();
                    return false;
                }
            }
        }
    }

    if (typeof(f.mb_email) != "undefined") {
        if (f.mb_email.value.trim() == "" || f.mb_email.value != f.old_email.value) {
            if (!enabled_mb_email) {
                alert("이메일을 입력하지 않았거나 입력에 오류가 있습니다.");
                //f.mb_email.focus();
                f.mb_email.select();
                return false;
            }
        }
    }

    if (typeof(f.mb_birth) != "undefined") {
			/* 생년월일에 대한 필수 설정이 없으므로 주석 처리 합니다 # 2011-03-15 17:18:13 [By. June.] #
        if (f.mb_birth.value.trim() == "") {
            alert("생년월일을 입력하여 주십시오.\n\n달력아이콘으로도 날짜를 선택할 수 있습니다.");
            //f.mb_birth.focus();
            f.mb_birth.select();
            return false;
        }
			*/
			if (f.mb_birth.value.trim() != "") {
        if (!/[0-9]{8}/.test(f.mb_birth.value)) {
            alert("생년월일은 숫자로 8자리를 입력하여 주십시오.\n\n년도 4자리 + 월 2자리 + 일 2자리\n\n입력예) 를 참고하세요.");
            //f.mb_birth.focus();
            f.mb_birth.select();
            return false;
        }

        var y = f.mb_birth.value.substr(0,4);
        var m = f.mb_birth.value.substr(4,2);
        var d = f.mb_birth.value.substr(6,2);
        if (!is_valid_date(y,m,d)) {
            alert("생년월일의 날짜에 오류가 있습니다.\n\n입력예) 를 참고하세요.");
            //f.mb_birth.focus();
            f.mb_birth.select();
            return false;
        }

        // 오늘날짜에서 생일을 빼고 거기서 140000 을 뺀다.
        // 결과가 0 이상의 양수이면 만 14세가 지난것임
        var n = <?php echo date("Ymd", $g4['server_time']);?> - parseInt(f.mb_birth.value) - 140000;
        if (n < 0) {
            alert("만 14세 미만의 아동은 정보통신망 이용촉진 및 정보보호 등에 관한 법률\n\n제 31조 1항의 규정에 의하여 법정대리인의 동의를 얻어야 회원가입이 가능합니다.");
            //f.mb_birth.focus();
            f.mb_birth.select();
            return false;
        }
			}
    }

    if (typeof(f.mb_sex) != "undefined") {
        if (chk_radio("mb_sex") === false) {
            alert("성별을 선택하여 주십시오.");
            f.mb_sex['0'].focus();
            return false;
        }
    }

    <?php if ($config['cf_req_homepage']) { ?>
    if (f.mb_homepage.value.trim() == "") {
        alert("홈페이지를 반드시 입력하여 주십시오.");
        //f.mb_homepage.focus();
        f.mb_homepage.select();
        return false;
    }
    <?php } ?>

    <?php if ($config['cf_req_tel']) { ?>
    if (f.mb_tel1.value == "") {
        alert("전화번호 앞자리(지역번호)를 반드시 선택하여 주십시오.");
        f.mb_tel1.focus();
        return false;
    }

    if (!/[0-9]{3,4}/.test(f.mb_tel2.value)) {
        alert("전화번호 중간자리(국번)를 반드시 숫자로 입력하여 주십시오. (3자리 이상)");
        //f.mb_tel2.focus();
        f.mb_tel2.select();
        return false;
    }

    if (!/[0-9]{4}/.test(f.mb_tel3.value)) {
        alert("전화번호 끝자리(번호)를 반드시 숫자로 입력하여 주십시오. (4자리)");
        //f.mb_tel3.focus();
        f.mb_tel3.select();
        return false;
    }
    <?php } ?>

    <?php if ($config['cf_req_hp']) { ?>
    if (f.mb_hp1.value == "") {
        alert("휴대폰번호 앞자리를 반드시 선택하여 주십시오.");
        f.mb_hp1.focus();
        return false;
    }

    if (!/^[0-9]{3,4}$/.test(f.mb_hp2.value)) {
        alert("휴대폰번호 중간자리를 반드시 숫자로 입력하여 주십시오. (3자리 이상)");
        //f.mb_hp2.focus();
        f.mb_hp2.select();
        return false;
    }

    if (!/^[0-9]{4}$/.test(f.mb_hp3.value)) {
        alert("휴대폰번호 뒷자리를 반드시 숫자로 입력하여 주십시오. (4자리)");
        //f.mb_hp3.focus();
        f.mb_hp3.select();
        return false;
    }
    <?php } ?>

    <?php if ($config['cf_req_addr']) { ?>
    if (f.mb_zip1.value == "") {
        alert("우편번호 검색 버튼을 클릭하여 우편번호와 주소를 반드시 입력하여 주십시오.");
        return false;
    }

    if (f.mb_addr2.value.trim() == "") {
        alert("상세주소(번지, 동호수 등)를 반드시 입력하여 주십시오.");
        //f.mb_addr2.focus();
        f.mb_addr2.select();
        return false;
    }
    <?php } ?>

    <?php if ($config['cf_req_signature']) { ?>
    if (f.mb_signature.value.trim() == "") {
        alert("서명을 반드시 입력하여 주십시오.");
        //f.mb_signature.focus();
        f.mb_signature.select();
        return false;
    }
    <?php } ?>

    <?php if ($config['cf_req_profile']) { ?>
    if (f.mb_profile.value.trim() == "") {
        alert("자기소개를 반드시 입력하여 주십시오.");
        //f.mb_profile.focus();
        f.mb_profile.select();
        return false;
    }
    <?php } ?>

    if (typeof(f.mb_icon) != "undefined") {
        if (f.mb_icon.value != "") {
            if (!/\.gif$/i.test(f.mb_icon.value)) {
                alert("회원아이콘은 gif 파일만 업로드 가능합니다.");
                //f.mb_icon.focus();
                f.mb_icon.select();
                return false;
            }
        }
    }

    if (typeof(f.mb_recommend) != "undefined") {
        if (f.mb_recommend.value.trim() != "") {
            if (!enabled_mb_recommend) {
                alert("추천인 아이디 입력에 오류가 있습니다.");
                //f.mb_recommend.focus();
                f.mb_recommend.select();
                return false;
            }
        }
    }

    if (!check_kcaptcha(f.wr_key)) {
        return false;
    }

    if (typeof(f.mb_tel) != "undefined") {
        if(f.mb_tel1.value != "" && f.mb_tel2.value != "" && f.mb_tel3.value != "") {
            f.mb_tel.value = f.mb_tel1.value + "-" + f.mb_tel2.value + "-" + f.mb_tel3.value;
        }
    }

    if (typeof(f.mb_hp) != "undefined") {
        if(f.mb_hp1.value != "" && f.mb_hp2.value != "" && f.mb_hp3.value != "") {
            f.mb_hp.value  = f.mb_hp1.value  + "-" + f.mb_hp2.value  + "-" + f.mb_hp3.value;
        }
    }

    if (g4_https_url)
        f.action = g4_https_url+"/"+g4_bbs+"/register_form_update.php";
    else
        f.action = "./register_form_update.php";

    return true;
}

function chk_radio(elem)
{
    // return 0 이 되는 경우가 있으므로 === false 로 물어볼 것
    var rdo = document.getElementsByName(elem);
    for (i=0; i<rdo.length; i++) {
        if (rdo['i'].checked)
            return i;
    }
    return false;
}
//]]>
</script>
