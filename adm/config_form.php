<?php
$sub_menu = "100100";
include_once("./_common.php");

auth_check($auth[$sub_menu], "r");

$token = get_token();

if ($is_admin != "super")
    alert("최고관리자만 접근 가능합니다.");

$g4['title'] = "기본환경설정";
include_once ("./admin.head.php");
?>
<div id="adm_config">
<form id='fconfigform' method='post' action='#' onsubmit="return fconfigform_submit(this);">
	<?php echo subtitle("기본 설정")?>
	<table class="normal2">
		<tr>
			<th scope="row" width="20%">홈페이지 제목</th>
			<td width="30%"><input type="text" name="cf_title" size="30" class="text required" title="홈페이지 제목" value="<?php echo $config['cf_title']?>" /></td>
			<th scope="row" width="20%">최고관리자</th>
			<td><?php echo get_member_id_select("cf_admin", 10, $config['cf_admin'], "class='required' title='최고 관리자'")?></td>
		</tr>
		<tr>
			<th scope="row">포인트 사용</th>
			<td colspan="3"><input type="checkbox" name="cf_use_point" id="cf_use_point" value="1" <?php echo $config['cf_use_point']?"checked='checked'":"";?> /> <label for="cf_use_point">사용</label></td>
		</tr>
		<tr>
			<th scope="row">로그인시 포인트</th>
			<td><input type="text" name="cf_login_point" size="5" class="text required" title="로그인시 포인트" value="<?php echo $config['cf_login_point']?>" /> 점<?php echo help("회원에게 하루에 한번만 부여")?></td>
			<th scope="row">쪽지보낼시 차감 포인트</th>
			<td><input type="text" name="cf_memo_send_point" size="5" class="text required" title="쪽지전송시 차감 포인트" value="<?php echo $config['cf_memo_send_point']?>" /> 점<?php echo help("양수로 입력하십시오.<br />0으로 입력하시면 쪽지보낼시 포인트를 차감하지 않습니다.")?></td>
		</tr>
		<tr>
			<th scope="row">이름(별명) 표시</th>
			<td colspan="3"><input type='text' name='cf_cut_name' size='2' class='text' value='<?php echo $config['cf_cut_name']?>' /> 자리만 표시<?php echo help("영숫자 2글자 = 한글 1글자")?></td>
		</tr>
		<tr>
			<th scope="row">최근게시물 삭제</th>
			<td><input type='text' name='cf_new_del' size='5' class='text' value='<?php echo $config['cf_new_del']?>' /> 일<?php echo help("설정일이 지난 최근게시물 자동 삭제")?></td>
			<th scope="row">쪽지 삭제</th>
			<td><input type='text' name='cf_memo_del' size='5' class='text' value='<?php echo $config['cf_memo_del']?>' /> 일<?php echo help("설정일이 지난 쪽지 자동 삭제")?></td>
		</tr>
		<tr>
			<th scope="row">접속자로그 삭제</th>
			<td colspan='3'><input type='text' name='cf_visit_del' size='5' class='text' value='<?php echo $config['cf_visit_del']?>' /> 일<?php echo help("설정일이 지난 접속자 로그 자동 삭제")?></td>
			<!-- <th>인기검색어 삭제</th>
			<td><input type='text' name='cf_popular_del' size='5' class='text' value='<?php echo $config['cf_popular_del']?>' /> 일
			<?php echo help("설정일이 지난 인기검색어 자동 삭제")?></td> -->
		</tr>
		<tr>
			<th scope="row">현재 접속자</th>
			<td><input type='text' name='cf_login_minutes' size='5' class='text' value='<?php echo $config['cf_login_minutes']?>' /> 분<?php echo help("설정값 이내의 접속자를 현재 접속자로 인정")?></td>
			<th scope="row">한페이지당 라인수</th>
			<td><input type='text' name='cf_page_rows' size='5' class='text' value='<?php echo $config['cf_page_rows']?>' /> 라인<?php echo help("목록(리스트) 한페이지당 라인수")?></td>
		</tr>
		<tr>
			<th scope="row">최근게시물 스킨</th>
			<td><select id='cf_new_skin' name='cf_new_skin' class='required' title="최근게시물 스킨">
				<?php
				$arr = get_skin_dir("new");
				for ($i=0; $i<count($arr); $i++) {
					echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
				}
				?></select>
				<script type="text/javascript"> document.getElementById('cf_new_skin').value="<?php echo $config['cf_new_skin']?>";</script>
			</td>
			<th scope="row">최근게시물 라인수</th>
			<td><input type='text' name='cf_new_rows' class='text' size='5' value='<?php echo $config['cf_new_rows']?>' /> 라인<?php echo help("목록 한페이지당 라인수")?></td>
		</tr>
		<!-- <tr>
			<th>검색 스킨</th>
			<td colspan='3'><select id='cf_search_skin' name='cf_search_skin' class='required' title="검색 스킨">
				<?php
				$arr = get_skin_dir("search");
				for ($i=0; $i<count($arr); $i++) {
					echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
				}
				?></select>
				<script type="text/javascript"> document.getElementById('cf_search_skin').value="<?php echo $config['cf_search_skin']?>";</script>
			</td>
		</tr> -->
		<tr>
			<th scope="row">접속자 스킨</th>
			<td colspan='3'><select id='cf_connect_skin' name='cf_connect_skin' class='required' title="최근게시물 스킨">
				<?php
				$arr = get_skin_dir("connect");
				for ($i=0; $i<count($arr); $i++) {
					echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
				}
				?></select>
				<script type="text/javascript"> document.getElementById('cf_connect_skin').value="<?php echo $config['cf_connect_skin']?>";</script>
			</td>
		</tr>
		<tr>
			<th scope="row">복사, 이동시 로그</th>
			<td colspan='3'><input type='checkbox' name='cf_use_copy_log' value='1' <?php echo $config['cf_use_copy_log']?"checked='checked'":"";?> /> 남김<?php echo help("게시물 아래에 누구로 부터 복사, 이동됨 표시")?></td>
			<!-- <td>자동등록방지 사용</td>
			<td><input type='checkbox' name='cf_use_norobot' value='1' <?php echo $config['cf_use_norobot']?"checked='checked'":"";?> /> 사용
				<?php echo help("자동 회원가입과 글쓰기를 방지")?></td> -->
		</tr>
		<tr>
			<th scope="row">접근가능 IP</th>
			<td><textarea name='cf_possible_ip' rows='5' cols='1' class='textarea'><?php echo $config['cf_possible_ip']?></textarea><br />입력된 IP의 컴퓨터만 접근할 수 있음.<br />123.123.+ 도 입력 가능. (엔터로 구분)</td>
			<th scope="row">접근차단 IP</th>
			<td><textarea name='cf_intercept_ip' rows='5' cols='1' class='textarea'><?php echo $config['cf_intercept_ip']?></textarea><br />입력된 IP의 컴퓨터는 접근할 수 없음.<br />123.123.+ 도 입력 가능. (엔터로 구분)</td>
		</tr>
	</table>

	<?php echo subtitle("게시판 설정")?>
	<table class="normal2">
		<tr>
			<th scope="col" width="20%">글읽기 포인트</th>
			<td width="30%"><input type='text' name='cf_read_point' size='10' class='text required' title='글읽기 포인트' value='<?php echo $config['cf_read_point']?>' /> 점</td>
			<th scope="col" width="20%">글쓰기 포인트</th>
			<td><input type='text' name='cf_write_point' size='10' class='text required' title='글쓰기 포인트' value='<?php echo $config['cf_write_point']?>' /> 점</td>
		</tr>
		<tr>
			<th scope="col">코멘트쓰기 포인트</th>
			<td><input type='text' name='cf_comment_point' size='10' class='text required' title='답변, 코멘트쓰기 포인트' value='<?php echo $config['cf_comment_point']?>' /> 점</td>
			<th scope="col">다운로드 포인트</th>
			<td><input type='text' name='cf_download_point' size='10' class='text required' title='다운로드받기 포인트' value='<?php echo $config['cf_download_point']?>' /> 점</td>
		</tr>
		<tr>
			<th scope="col">LINK TARGET</th>
			<td><input type='text' name='cf_link_target' size='10' class='text' value='<?php echo $config['cf_link_target']?>' />
				<?php echo help("게시판 내용중 자동으로 링크되는 창의 타켓을 지정합니다.\n\n_self, _top, _blank, _new 를 주로 지정합니다.")?></td>
			<th scope="col">검색 단위</th>
			<td><input type='text' name='cf_search_part' size='10' class='text' title='검색 단위' value='<?php echo $config['cf_search_part']?>' /> 건 단위로 검색</td>
		</tr>
		<tr>
			<th scope="col">검색 배경 색상</th>
			<td><input type='text' name='cf_search_bgcolor' size='10' class='text required' title='검색 배경 색상' value='<?php echo $config['cf_search_bgcolor']?>' /></td>
			<th scope="col">검색 글자 색상</th>
			<td><input type='text' name='cf_search_color' size='10' class='text required' title='검색 글자 색상' value='<?php echo $config['cf_search_color']?>' /></td>
		</tr>
		<tr>
			<th scope="col">새로운 글쓰기</th>
			<td><input type='text' name='cf_delay_sec' size='10' class='text required' title='새로운 글쓰기' value='<?php echo $config['cf_delay_sec']?>' /> 초 지난후 가능</td>
			<th scope="col">페이지 표시 수</th>
			<td><input type='text' name='cf_write_pages' size='10' class='text required' title='페이지 표시 수' value='<?php echo $config['cf_write_pages']?>' /> 페이지씩 표시</td>
		</tr>
		<tr>
			<th scope="col">이미지 업로드 확장자</th>
			<td colspan='3'><input type='text' name='cf_image_extension' size='80' class='text' title='이미지 업로드 확장자' value='<?php echo $config['cf_image_extension']?>' />
				<?php echo help("게시판 글작성시 이미지 파일 업로드 가능 확장자. | 로 구분")?></td>
		</tr>
		<tr>
			<th scope="col">플래쉬 업로드 확장자</th>
			<td colspan='3'><input type='text' name='cf_flash_extension' size='80' class='text' title='플래쉬 업로드 확장자' value='<?php echo $config['cf_flash_extension']?>' />
				<?php echo help("게시판 글작성시 플래쉬 파일 업로드 가능 확장자. | 로 구분")?></td>
		</tr>
		<tr>
			<th scope="col">동영상 업로드 확장자</th>
			<td colspan='3'><input type='text' name='cf_movie_extension' size='80' class='text' title='동영상 업로드 확장자' value='<?php echo $config['cf_movie_extension']?>' />
				<?php echo help("게시판 글작성시 동영상 파일 업로드 가능 확장자. | 로 구분")?></td>
		</tr>
		<tr>
			<th scope="col">단어 필터링
				<?php echo help("입력된 단어가 포함된 내용은 게시할 수 없습니다.\n\n단어와 단어 사이는 ,로 구분합니다.")?></th>
			<td colspan='3'><textarea name='cf_filter' rows='7' cols='1' class='textarea'><?php echo $config['cf_filter']?></textarea></td>
		</tr>
	</table>

	<?php echo subtitle("회원가입 설정")?>
	<table class="normal2">
		<tr>
			<th scope="col">회원 스킨</th>
			<td colspan="3"><select id="cf_member_skin" name="cf_member_skin" class="required" title="회원가입 스킨">
				<?php
				$arr = get_skin_dir("member");
				for ($i=0; $i<count($arr); $i++) {
					echo "<option value='$arr[$i]'>$arr[$i]</option>\n";
				}
				?></select>
				<script type="text/javascript"> document.getElementById('cf_member_skin').value="<?php echo $config['cf_member_skin']?>";</script>
			</td>
		</tr>
		<tr>
			<th scope="col" width="20%">홈페이지 입력</th>
			<td width="30%">
				<label><input type='checkbox' name='cf_use_homepage' value='1' <?php echo $config['cf_use_homepage']?"checked='checked'":"";?> />보이기</label>
				<label><input type='checkbox' name='cf_req_homepage' value='1' <?php echo $config['cf_req_homepage']?"checked='checked'":"";?> />필수입력</label>
			</td>
			<th scope="col" width="20%">주소 입력</th>
			<td>
				<label><input type='checkbox' name='cf_use_addr' value='1' <?php echo $config['cf_use_addr']?"checked='checked'":"";?> />보이기</label>
				<label><input type='checkbox' name='cf_req_addr' value='1' <?php echo $config['cf_req_addr']?"checked='checked'":"";?> />필수입력</label>
			</td>
		</tr>
		<tr>
			<th scope="col">전화번호 입력</th>
			<td>
				<label><input type='checkbox' name='cf_use_tel' value='1' <?php echo $config['cf_use_tel']?"checked='checked'":"";?> />보이기</label>
				<label><input type='checkbox' name='cf_req_tel' value='1' <?php echo $config['cf_req_tel']?"checked='checked'":"";?> />필수입력</label>
			</td>
			<th scope="col">핸드폰 입력</th>
			<td>
				<label><input type='checkbox' name='cf_use_hp' value='1' <?php echo $config['cf_use_hp']?"checked='checked'":"";?> />보이기</label>
				<label><input type='checkbox' name='cf_req_hp' value='1' <?php echo $config['cf_req_hp']?"checked='checked'":"";?> />필수입력</label>
			</td>
		</tr>
		<tr>
			<th scope="col">서명 입력</th>
			<td>
				<label><input type='checkbox' name='cf_use_signature' value='1' <?php echo $config['cf_use_signature']?"checked='checked'":"";?> />보이기</label>
				<label><input type='checkbox' name='cf_req_signature' value='1' <?php echo $config['cf_req_signature']?"checked='checked'":"";?> />필수입력</label>
			</td>
			<th scope="col">자기소개 입력</th>
			<td>
				<label><input type='checkbox' name='cf_use_profile' value='1' <?php echo $config['cf_use_profile']?"checked='checked'":"";?> />보이기</label>
				<label><input type='checkbox' name='cf_req_profile' value='1' <?php echo $config['cf_req_profile']?"checked='checked'":"";?> />필수입력</label>
			</td>
		</tr>
		<tr>
			<th scope="col">회원가입시 권한</th>
			<td><?php echo get_member_level_select('cf_register_level', 1, 9, $config['cf_register_level']) ?></td>
			<th scope="col">회원가입시 포인트</th>
			<td><input type='text' name='cf_register_point' size='5' class='text' value='<?php echo $config['cf_register_point']?>' /> 점</td>
		</tr>
		<tr>
			<!--<th scope="col">주민등록번호</th>
			<td><input type='checkbox' name='cf_use_jumin' value='1' <?php echo $config['cf_use_jumin']?"checked='checked'":"";?> /> 사용
				<?php echo help("주민등록번호는 암호화하여 저장하므로 회원정보 DB가 유출되어도 알 수 없습니다.")?></td> -->
			<th scope="col">회원탈퇴후 삭제일</th>
			<td colspan='3'><input type='text' name='cf_leave_day' size='5' class='text' value='<?php echo $config['cf_leave_day']?>' /> 일 후 자동 삭제</td>
		</tr>
		<tr>
			<th scope="col">회원아이콘 사용</th>
			<td>
				<select name='cf_use_member_icon'>
				<option value='0'>미사용</option>
				<option value='1'>아이콘만 표시</option>
				<option value='2'>아이콘+이름 표시</option>
				</select>
				<?php echo help("게시물에 게시자 별명 대신 아이콘 사용")?>
				<script type='text/javascript'> document.getElementById('fconfigform').cf_use_member_icon.value = '<?php echo $config['cf_use_member_icon']?>'; </script>
			</td>
			<th scope="col">아이콘 업로드 권한</th>
			<td colspan='3'><?php echo get_member_level_select('cf_icon_level', 1, 9, $config['cf_icon_level']) ?> 이상</td>
		</tr>
		<tr>
			<th scope="col">회원아이콘 용량</th>
			<td><input type='text' name='cf_member_icon_size' size='5' class='text' value='<?php echo $config['cf_member_icon_size']?>' /> 바이트 이하</td>
			<th scope="col">회원아이콘 사이즈</th>
			<td>폭 <input type='text' name='cf_member_icon_width' size='5' class='text' value='<?php echo $config['cf_member_icon_width']?>' /> 픽셀 ,
				높이 <input type='text' name='cf_member_icon_height' size='5' class='text' value='<?php echo $config['cf_member_icon_height']?>' /> 픽셀 이하</td>
		</tr>
		<tr>
			<th scope="col">추천인제도 사용</th>
			<td><input type='checkbox' name='cf_use_recommend' value='1' <?php echo $config['cf_use_recommend']?"checked='checked'":"";?> /> 사용</td>
			<th scope="col">추천인 포인트</th>
			<td><input type='text' name='cf_recommend_point' size='5' class='text' value='<?php echo $config['cf_recommend_point']?>' /> 점</td>
		</tr>
		<tr>
			<th scope="col">아이디,별명 금지단어
				<?php echo help("입력된 단어가 포함된 내용은 회원아이디, 별명으로 사용할 수 없습니다.\n\n단어와 단어 사이는 , 로 구분합니다.")?></th>
			<td><textarea name='cf_prohibit_id' rows='5' cols='1' class='textarea'><?php echo $config['cf_prohibit_id']?></textarea></td>
			<th scope="col">입력 금지 메일
				<?php echo help("hanmail.net과 같은 메일 주소는 입력을 못합니다.\n\n엔터로 구분합니다.")?></th>
			<td><textarea name='cf_prohibit_email' rows='5' cols='1' class='textarea'><?php echo $config['cf_prohibit_email']?></textarea><br /></td>
		</tr>
		<tr>
			<th scope="col">회원가입약관</th>
			<td colspan='3'><textarea name='cf_stipulation' rows='10' cols='1' class='textarea'><?php echo $config['cf_stipulation']?></textarea></td>
		</tr>
		<tr>
			<th scope="col">개인정보취급방침</th>
			<td colspan='3'><textarea name='cf_privacy' rows='10' cols='1' class='textarea'><?php echo $config['cf_privacy']?></textarea></td>
		</tr>
	</table>

	<?php echo subtitle("메일 설정")?>
	<table class="normal2">
		<tr>
			<th width="20%">메일발송 사용</th>
			<td><input type='checkbox' name='cf_email_use' value='1' <?php echo $config['cf_email_use']?"checked='checked'":"";?> /> 사용 (체크하지 않으면 메일발송을 아예 사용하지 않습니다. 메일 테스트도 불가합니다.)</td>
		</tr>
		<tr>
			<th>메일인증 사용</th>
			<td><input type='checkbox' name='cf_use_email_certify' value='1' <?php echo $config['cf_use_email_certify']?"checked='checked'":"";?> /> 사용
				<?php echo help("메일에 배달된 인증 주소를 클릭하여야 회원으로 인정합니다.");?></td>
		</tr>
		<tr>
			<th>폼메일 사용 여부</th>
			<td><input type='checkbox' name='cf_formmail_is_member' value='1' <?php echo $config['cf_formmail_is_member']?"checked='checked'":"";?> /> 회원만 사용
				<?php echo help("체크하지 않으면 비회원도 사용 할 수 있습니다.")?></td>
		</tr>
		<tr>
			<th><span class='title'>게시판 글 작성시</span></th>
			<td></td>
		</tr>
		<tr>
			<th>최고관리자 메일발송</th>
			<td><input type='checkbox' name='cf_email_wr_super_admin' value='1' <?php echo $config['cf_email_wr_super_admin']?"checked='checked'":"";?> /> 사용 (최고관리자에게 메일을 발송합니다.)</td>
		</tr>
		<tr>
			<th>그룹관리자 메일발송</th>
			<td><input type='checkbox' name='cf_email_wr_group_admin' value='1' <?php echo $config['cf_email_wr_group_admin']?"checked='checked'":"";?> /> 사용 (그룹관리자에게 메일을 발송합니다.)</td>
		</tr>
		<tr>
			<th>게시판관리자 메일발송</th>
			<td><input type='checkbox' name='cf_email_wr_board_admin' value='1' <?php echo $config['cf_email_wr_board_admin']?"checked='checked'":"";?> /> 사용 (게시판관리자에게 메일을 발송합니다.)</td>
		</tr>
		<tr>
			<th>원글 메일발송</th>
			<td><input type='checkbox' name='cf_email_wr_write' value='1' <?php echo $config['cf_email_wr_write']?"checked='checked'":"";?> /> 사용 (게시자님께 메일을 발송합니다.)</td>
		</tr>
		<tr>
			<th>코멘트 메일발송</th>
			<td><input type='checkbox' name='cf_email_wr_comment_all' value='1' <?php echo $config['cf_email_wr_comment_all']?"checked='checked'":"";?> /> 사용 (원글에 코멘트가 올라오는 경우 코멘트 쓴 모든 분들께 메일을 발송합니다.)</td>
		</tr>
		<tr>
			<th><span class='title'>회원 가입시</span></th>
			<td></td>
		</tr>
		<tr>
			<th>최고관리자 메일발송</th>
			<td><input type='checkbox' name='cf_email_mb_super_admin' value='1' <?php echo $config['cf_email_mb_super_admin']?"checked='checked'":"";?> /> 사용 (최고관리자에게 메일을 발송합니다.)</td>
		</tr>
		<tr>
			<th>회원님께 메일발송</th>
			<td><input type='checkbox' name='cf_email_mb_member' value='1' <?php echo $config['cf_email_mb_member']?"checked='checked'":"";?> /> 사용 (회원가입한 회원님께 메일을 발송합니다.)</td>
		</tr>
		<tr>
			<th><span class='title'>투표 기타의견 작성시</span></th>
			<td></td>
		</tr>
		<tr>
			<th>최고관리자 메일발송</th>
			<td><input type='checkbox' name='cf_email_po_super_admin' value='1' <?php echo $config['cf_email_po_super_admin']?"checked='checked'":"";?> /> 사용 (최고관리자에게 메일을 발송합니다.)</td>
		</tr>
	</table>
	<?php echo subtitle("여분 필드")?>
	<table class="normal2">
		<?php for ($i=1; $i<=10; $i=$i+2) { $k=$i+1; ?>
		<tr>
			<th width="20%"><input type='text' name='cf_<?php echo $i?>_subj' size='15' class='text' value='<?php echo get_text($config["cf_{$i}_subj"])?>' title='여분필드 <?php echo $i?> 제목' style='text-align:right;font-weight:bold;' /></th>
			<td width="30%"><input type='text' name='cf_<?php echo $i?>' class='text w90' value='<?php echo $config["cf_$i"]?>' title='여분필드 <?php echo $i?> 설정값' /></td>
			<th width="20%"><input type='text' name='cf_<?php echo $k?>_subj' size='15' class='text' value='<?php echo get_text($config["cf_{$k}_subj"])?>' title='여분필드 <?php echo $k?> 제목' style='text-align:right;font-weight:bold;' /></th>
			<td><input type='text' name='cf_<?php echo $k?>' class='text w90' value='<?php echo $config["cf_$k"]?>' title='여분필드 <?php echo $k?> 설정값' /></td>
		</tr>
		<?php } ?>
	</table>

	<?php echo subtitle("XSS / CSRF 방지")?>
	<table class="normal2">
		<tr>
			<th scope="row" width="20%">관리자 패스워드</td>
			<td colspan="3">
				<input class='ed text required' type='password' name='admin_password' title="관리자 패스워드" />
        		<?=help("관리자 권한을 빼앗길 것에 대비하여 로그인한 관리자의 패스워드를 한번 더 묻는것 입니다.");?>
			</td>
		</tr>
	</table>

	<p class="center"><input type='submit' accesskey="s" value="  확  인  " /></p>
</form>

<script type="text/javascript" src="<?php echo $g4['path']?>/js/md5.js"></script>
<script type="text/javascript" src="<?php echo $g4['path']?>/js/jquery.kcaptcha.js"></script>

<script type="text/javascript">
function fconfigform_submit(f)
{
    if (!check_kcaptcha($("wr_key").val())) {
            return false;
    }

    f.action = "./config_form_update.php";
    return true;
}
</script>
</div>
<?php
include_once ("./admin.tail.php");
?>
