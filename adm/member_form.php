<?php
$sub_menu = "200100";
include_once("./_common.php");

auth_check($auth[$sub_menu], "w");

$token = get_token();

if ($w == "")
{
    $required_mb_id = "required minlength=3 alnum_";
    $update_mb_id = "";
    $required_mb_password = "required itemname='패스워드'";

    $mb[mb_mailling] = 1;
    $mb[mb_open] = 1;
    $mb[mb_level] = $config[cf_register_level];
    $html_title = "등록";
}
else if ($w == "u")
{
    $mb = get_member($mb_id);
    if (!$mb[mb_id])
        alert("존재하지 않는 회원자료입니다.");

    if ($is_admin != 'super' && $mb[mb_level] >= $member[mb_level])
        alert("자신보다 권한이 높거나 같은 회원은 수정할 수 없습니다.");

    $required_mb_id = "";
    $update_mb_id = "readonly='readonly' style='background-color:#dddddd;'";
    $required_mb_password = "";
    $html_title = "수정";

    $mb[mb_email]       = get_text($mb[mb_email]);
    $mb[mb_homepage]    = get_text($mb[mb_homepage]);
    $mb[mb_password_q]  = get_text($mb[mb_password_q]);
    $mb[mb_password_a]  = get_text($mb[mb_password_a]);
    $mb[mb_birth]       = get_text($mb[mb_birth]);
    $mb[mb_tel]         = get_text($mb[mb_tel]);
    $mb[mb_hp]          = get_text($mb[mb_hp]);
    $mb[mb_addr1]       = get_text($mb[mb_addr1]);
    $mb[mb_addr2]       = get_text($mb[mb_addr2]);
    $mb[mb_signature]   = get_text($mb[mb_signature]);
    $mb[mb_recommend]   = get_text($mb[mb_recommend]);
    $mb[mb_profile]     = get_text($mb[mb_profile]);
    $mb[mb_1]           = get_text($mb[mb_1]);
    $mb[mb_2]           = get_text($mb[mb_2]);
    $mb[mb_3]           = get_text($mb[mb_3]);
    $mb[mb_4]           = get_text($mb[mb_4]);
    $mb[mb_5]           = get_text($mb[mb_5]);
    $mb[mb_6]           = get_text($mb[mb_6]);
    $mb[mb_7]           = get_text($mb[mb_7]);
    $mb[mb_8]           = get_text($mb[mb_8]);
    $mb[mb_9]           = get_text($mb[mb_9]);
    $mb[mb_10]          = get_text($mb[mb_10]);
}
else
    alert("제대로 된 값이 넘어오지 않았습니다.");

if ($mb[mb_mailling]) $mailling_checked = "checked='checked'"; // 메일 수신
if ($mb[mb_sms])      $sms_checked = "checked='checked'"; // SMS 수신
if ($mb[mb_open])     $open_checked = "checked='checked'"; // 정보 공개

$g4[title] = "회원정보 " . $html_title;
include_once("./admin.head.php");
?>

<div id="adm_member">
<?php echo subtitle("회원정보 등록")?>
<form id='fmember' method='post' action='#' onsubmit="return fmember_submit(this);" enctype="multipart/form-data">
<table class='normal2'>
	<tr>
		<th width="20%">아이디</th>
		<td width="30%">
			<input type='hidden' name='w' value='<?php echo $w?>' />
			<input type='hidden' name='sfl' value='<?php echo $sfl?>' />
			<input type='hidden' name='stx' value='<?php echo $stx?>' />
			<input type='hidden' name='sst' value='<?php echo $sst?>' />
			<input type='hidden' name='sod' value='<?php echo $sod?>' />
			<input type='hidden' name='page' value='<?php echo $page?>' />
			<input type='hidden' name='token' value='<?php echo $token?>' />
			<input type='text' name='mb_id' size='20' maxlength='20' class='text <?php echo $required_mb_id?>' <?php echo $update_mb_id?> title='회원아이디' value='<?php echo $mb[mb_id]?>' />
			<?php if ($w=="u"){?><a href='./boardgroupmember_form.php?mb_id=<?php echo $mb[mb_id]?>'>접근가능그룹보기</a><?php }?>
		</td>
		<th width="20%">패스워드</th>
		<td><input type='password' name='mb_password' size='20' maxlength='20' class='text <?php echo $required_mb_password?>' title='암호' /></td>
	</tr>
	<tr>
		<th>이름(실명)</th>
		<td><input type='text' name='mb_name' maxlength='20' class='text minlength=2 required' title='이름(실명)' value='<?php echo $mb[mb_name] ?>' /></td>
		<th>별명</th>
		<td><input type='text' name='mb_nick' maxlength='20' class='text minlength=2 required' title='별명' value='<?php echo $mb[mb_nick] ?>' /></td>
	</tr>
	<tr>
		<th>회원 권한</th>
		<td><?php echo get_member_level_select("mb_level", 1, $member[mb_level], $mb[mb_level])?></td>
		<th>포인트</th>
		<td><a href='./point_list.php?sfl=mb_id&amp;stx=<?php echo $mb[mb_id]?>' class='bold'><?php echo number_format($mb[mb_point])?></a> 점</td>
	</tr>
	<tr>
		<th>E-mail</th>
		<td><input type='text' name='mb_email' size='40' maxlength='100' class='text required email' title='e-mail' value='<?php echo $mb[mb_email] ?>' /></td>
		<th>홈페이지</th>
		<td><input type='text' name='mb_homepage' size='40' maxlength='255' class='text' title='홈페이지' value='<?php echo $mb[mb_homepage] ?>' /></td>
	</tr>
	<tr>
		<th>전화번호</th>
		<td><input type='text' name='mb_tel' maxlength='20' class='text' title='전화번호' value='<?php echo $mb[mb_tel] ?>' /></td>
		<th>핸드폰번호</th>
		<td><input type='text' name='mb_hp' maxlength='20' class='text' title='핸드폰번호' value='<?php echo $mb[mb_hp] ?>' /></td>
	</tr>
	<tr>
		<th>주소</th>
		<td>
			<input type='text' name='mb_zip1' size='4' maxlength='3' readonly='readonly' class='text' title='우편번호 앞자리' value='<?php echo $mb[mb_zip1] ?>' /> -
			<input type='text' name='mb_zip2' size='4' maxlength='3' readonly='readonly' class='text' title='우편번호 뒷자리' value='<?php echo $mb[mb_zip2] ?>' />
			<a href="<?php echo $g4[bbs_path]?>/zip.php?frm_name=fmember&amp;frm_zip1=mb_zip1&amp;frm_zip2=mb_zip2&amp;frm_addr1=mb_addr1&amp;frm_addr2=mb_addr2" class="win_zip_find" onclick="return false;"><img src='<?php echo $g4[bbs_img_path]?>/btn_zip.gif' alt="우편번호검색" /></a>
			<input type='text' name='mb_addr1' size='40' readonly='readonly' class='text' value='<?php echo $mb[mb_addr1] ?>' />
			<input type='text' name='mb_addr2' size='25' class='text' title='상세주소' value='<?php echo $mb[mb_addr2] ?>' /> 상세주소 입력</td>
		<th>회원아이콘</th>
		<td colspan='3'>
			<input type='file' name='mb_icon' class='text' /><br />이미지 크기는 <?php echo $config[cf_member_icon_width]?>x<?php echo $config[cf_member_icon_height]?>으로 해주세요.
			<?php
			$mb_dir = substr($mb[mb_id],0,2);
			$icon_file = "$g4[path]/data/member/$mb_dir/$mb[mb_id].gif";
			if (file_exists($icon_file)) {
				echo "<br /><img src='$icon_file' alt='' />";
				echo " <label><input type='checkbox' name='del_mb_icon' value='1' />삭제</label>";
			}
			?>
		</td>
	</tr>
	<tr>
		<th>생년월일</th>
		<td><input type='text' name='mb_birth' size='9' maxlength='8' class='text' title='생년월일' value='<?php echo $mb[mb_birth] ?>' /></td>
		<th>남녀</th>
		<td>
			<select name='mb_sex' id='mb_sex'>
			<option value=''>----</option>
			<option value='F'>여자</option>
			<option value='M'>남자</option>
			</select>
			<script type='text/javascript'> document.getElementById('mb_sex').value = "<?php echo $mb[mb_sex]?>"; </script>
		</td>
	</tr>
	<tr>
		<th>메일 수신</th>
		<td><input type='checkbox' name='mb_mailling' value='1' <?php echo $mailling_checked?> /> 정보 메일을 받음</td>
		<th>SMS 수신</th>
		<td><input type='checkbox' name='mb_sms' value='1' <?php echo $sms_checked?> /> 문자메세지를 받음</td>
	</tr>
	<tr>
		<th>정보 공개</th>
		<td colspan='3'>
			<input type='checkbox' name='mb_open' value='1' <?php echo $open_checked?> /> 타인에게 자신의 정보를 공개
		</td>
	</tr>
	<tr>
		<th>서명</th>
		<td><textarea name='mb_signature' rows='5' cols='1' class='textarea w99'><?php echo $mb[mb_signature] ?></textarea></td>
		<th>자기 소개</th>
		<td><textarea name='mb_profile' rows='5' cols='1' class='textarea w99'><?php echo $mb[mb_profile] ?></textarea></td>
	</tr>
	<tr>
		<th>메모</th>
		<td colspan='3'><textarea name='mb_memo' rows='5' cols='1' class='textarea w99'><?php echo $mb[mb_memo] ?></textarea></td>
	</tr>

	<?php if ($w == "u") { ?>
	<tr>
		<th>회원가입일</th>
		<td><?php echo $mb[mb_datetime]?></td>
		<th>최근접속일</th>
		<td><?php echo $mb[mb_today_login]?></td>
	</tr>
	<tr>
		<th>IP</th>
		<td><?php echo $mb[mb_ip]?></td>

		<?php if ($config[cf_use_email_certify]) { ?>
		<th>인증일시</th>
		<td><?php echo $mb[mb_email_certify]?>
			<?php if ($mb[mb_email_certify] == "0000-00-00 00:00:00") { echo "<input type=checkbox name=passive_certify>수동인증"; } ?></td>
		<?php } else { ?>
		<th>&nbsp;</th>
		<td>&nbsp;</td>
		<?php } ?>

	</tr>
	<?php } ?>

	<?php if ($config[cf_use_recommend]) { // 추천인 사용 ?>
	<tr>
		<th>추천인</th>
		<td colspan='3'><?php echo ($mb[mb_recommend] ? get_text($mb[mb_recommend]) : "없음"); // 081022 : CSRF 보안 결함으로 인한 코드 수정 ?></td>
	</tr>
	<?php } ?>

	<tr>
		<th>탈퇴일자</th>
		<td><input type='text' name='mb_leave_date' size='9' maxlength='8' class='text' value='<?php echo $mb[mb_leave_date] ?>' /></td>
		<th>접근차단일자</th>
		<td>
			<input type='text' name='mb_intercept_date' size='9' maxlength='8' class='text' value='<?php echo $mb[mb_intercept_date] ?>' />
			<input type='checkbox' value='<?php echo date("Ymd"); ?>' onclick='if (this.form.mb_intercept_date.value==this.form.mb_intercept_date.defaultValue) { this.form.mb_intercept_date.value=this.value; } else { this.form.mb_intercept_date.value=this.form.mb_intercept_date.defaultValue; } ' />오늘
		</td>
	</tr>

	<?php for ($i=1; $i<=10; $i=$i+2) { $k=$i+1; ?>
	<tr>
		<th>여분 필드 <?php echo $i?></th>
		<td><input type='text' name='mb_<?php echo $i?>' maxlength='255' class='text w99' value='<?php echo $mb["mb_$i"]?>' /></td>
		<th>여분 필드 <?php echo $k?></th>
		<td><input type='text' name='mb_<?php echo $k?>' maxlength='255' class='text w99' value='<?php echo $mb["mb_$k"]?>' /></td>
	</tr>
	<?php } ?>
</table>

<?php echo subtitle("XSS / CSRF 방지")?>
<table class='normal2'>
	<tr>
		<th width="20%">관리자 패스워드</th>
		<td width="30%">
			<input class='ed text minlength=2 required' type='password' name='admin_password' title="관리자 패스워드" />
			<?php echo help("관리자 권한을 빼앗길 것에 대비하여 로그인한 관리자의 패스워드를 한번 더 묻는것 입니다."); ?>
		</td>
		<th width="20%">&nbsp;</th>
		<td>&nbsp;</td>
    </tr>
</table>

<p class='center'>
    <input type='submit' class='btn1' accesskey='s' value='  확    인  ' />
    <input type='button' class='btn1' value='  목  록  ' onclick="document.location.href='./member_list.php?<?php echo $qstr?>';" />

    <?php if ($w != '') { ?>
    <input type='button' class='btn1' value='  삭  제  ' onclick="del('./member_delete.php?<?php echo $qstr?>&amp;w=d&amp;mb_id=<?php echo $mb[mb_id]?>&amp;url=<?php echo $_SERVER[PHP_SELF]?>');" />
    <?php } ?>
</p>
</form>

<script type='text/javascript'>
//<![CDATA[
if (typeof(document.getElementById('fmember').mb_level) != "undefined")
    document.getElementById('fmember').mb_level.value   = "<?php echo $mb[mb_level]?>";

function fmember_submit(f)
{
    if (!f.mb_icon.value.match(/\.(gif|jp[e]g|png)$/i) && f.mb_icon.value) {
        alert('아이콘이 이미지 파일이 아닙니다. (bmp 제외)');
        return false;
    }

    f.action = './member_form_update.php';
    return true;
}
//]]>
</script>
</div>
<?php
include_once("./admin.tail.php");
?>
