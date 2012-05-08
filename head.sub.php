<?php
// 이 파일은 새로운 파일 생성시 반드시 포함되어야 함
if(!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$begin_time = get_microtime();

if(!$g4['title']) $g4['title'] = $config['cf_title'];

// 쪽지를 받았나?
if($member['mb_memo_call']) {
    $mb = get_member($member['mb_memo_call'], 'mb_nick');
    sql_query(" update {$g4[member_table]} set mb_memo_call = '' where mb_id = '$member[mb_id]' ");

    alert($mb['mb_nick'].'님으로부터 쪽지가 전달되었습니다.', $_SERVER['REQUEST_URI']);
}

$lo_location = addslashes($g4['title']);
if(!$lo_location) $lo_location = $_SERVER['REQUEST_URI'];
$lo_url = $_SERVER['REQUEST_URI'];
if(strstr($lo_url, "/$g4[admin]/") || $is_admin == 'super') $lo_url = '';

// 자바스크립트에서 go(-1) 함수를 쓰면 폼값이 사라질때 해당 폼의 상단에 사용하면
// 캐쉬의 내용을 가져옴. 완전한지는 검증되지 않음
header('Content-Type: text/html; charset=' . $g4['charset']);
$gmnow = gmdate('D, d M Y H:i:s') . ' GMT';
header('Expires: 0'); // rfc2616 - Section 14.21
header('Last-Modified: ' . $gmnow);
header('Cache-Control: no-store, no-cache, must-revalidate'); // HTTP/1.1
header('Cache-Control: pre-check=0, post-check=0, max-age=0'); // HTTP/1.1
header('Pragma: no-cache'); // HTTP/1.0
/*
// 만료된 페이지로 사용하시는 경우
header("Cache-Control: no-cache"); // HTTP/1.1
header("Expires: 0"); // rfc2616 - Section 14.21
header("Pragma: no-cache"); // HTTP/1.0
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ko" xml:lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $g4['charset']?>" />
<title><?php echo $g4['title']?></title>
<link rel="stylesheet" type="text/css" href="<?php echo $g4['path']?>/css/style.css" charset="UTF-8" media="all" />
<?php
if(defined('_G4_ADMIN_')) echo '<link rel="stylesheet" type="text/css" href="'.$g4['admin_path'].'/admin.style.css" charset="UTF-8" media="all" />'."\n";
if(defined('_JQUERY_UI_')) echo '<link rel="stylesheet" type="text/css" href="'.$g4['path'].'/css/ui-lightness/jquery-ui-1.8.7.custom.css" charset="UTF-8" media="all" />'."\n";
//회원서비스 스킨 CSS 로드
if(!is_null($member_skin_path) && file_exists($member_skin_path . '/style.css'))
	echo '<link rel="stylesheet" type="text/css" href="'.$member_skin_path.'/style.css" charset="UTF-8" media="all" />'."\n";
//게시판 스킨 CSS 로드
if(!is_null($board_skin_path) && file_exists($board_skin_path . '/style.css'))
	echo '<link rel="stylesheet" type="text/css" href="'.$board_skin_path.'/style.css" charset="UTF-8" media="all" />'."\n";
//최근게시물 스킨 CSS 로드
if(!is_null($new_skin_path) && file_exists($new_skin_path . '/style.css'))
	echo '<link rel="stylesheet" type="text/css" href="'.$new_skin_path.'/style.css" charset="UTF-8" media="all" />'."\n";
//현재접속자스킨 CSS 로드
if(!is_null($connect_skin_path) && file_exists($connect_skin_path . '/style.css'))
	echo '<link rel="stylesheet" type="text/css" href="'.$connect_skin_path.'/style.css" charset="UTF-8" media="all" />'."\n";
//사용자 정의 스킨
if(file_exists($g4['path'] . '/css/skin.css'))
	echo '<link rel="stylesheet" type="text/css" href="' . $g4['path'] . '/css/skin.css" charset="UTF-8" media="all" />'."\n";


/*
$latest_skin_path			//최근게시물 스킨
$outlogin_skin_path		//외부로그인 스킨
$poll_skin_path				//설문조사 스킨
$visit_skin_path			//현재접속자 스킨(외부호출, current_connect.php 페이지 제외)
위 변수는 함수내에서 스킨폴더를 정의하므로 head에서 호출 할 수 없습니다.
/css/skin.css 파일에 CSS를 직접 정의해두도록 합니다.
*/
?>
<script type="text/javascript">
//<![CDATA[
// 자바스크립트에서 사용하는 전역변수 선언
var g4_path      = "<?php echo $g4['path']?>";
var g4_bbs       = "<?php echo $g4['bbs']?>";
var g4_bbs_img   = "<?php echo $g4['bbs_img']?>";
var g4_bbs_path  = "<?php echo $g4['bbs_path']?>";
var g4_url       = "<?php echo $g4['url']?>";
var g4_https_url = "<?php echo $g4['https_url']?>";
var g4_is_member = "<?php echo $is_member?>";
var g4_is_admin  = "<?php echo $is_admin?>";
var g4_bo_table  = "<?php echo isset($bo_table) ? $bo_table : '';?>";
var g4_sca       = "<?php echo isset($sca) ? $sca : '';?>";
var g4_charset   = "<?php echo $g4['charset']?>";
var g4_cookie_domain = "<?php echo $g4['cookie_domain']?>";
var g4_is_gecko  = navigator.userAgent.toLowerCase().indexOf('gecko') != -1;
var g4_is_ie     = navigator.userAgent.toLowerCase().indexOf('msie') != -1;
<?php if($is_admin) { echo "var g4_admin = '{$g4['admin']}';\n"; } ?>
//]]>
</script>
<script type="text/javascript" src="<?php echo $g4['path']?>/js/jquery-1.4.4.min.js"></script>
<?php
if(defined('_JQUERY_UI_')) echo '<script type="text/javascript" src="'.$g4['path'].'/js/jquery-ui-1.8.7.custom.min.js"></script>'."\n";
if(defined('_JQUERY_UI_')) echo '<script type="text/javascript" src="'.$g4['path'].'/js/jquery.ui.datepicker-ko.js"></script>'."\n";
?>
<script type="text/javascript" src="<?php echo $g4['path']?>/js/common.js"></script>
<script type="text/javascript" src="<?php echo $g4['path']?>/js/wrest.js"></script>
<?php if(defined('_JQUERY_LIGHTBOX_')) echo '<script type="text/javascript" src="'.$g4['path'].'/js/lightbox/js/jquery.lightbox.min.js"></script>'."\n"; ?>
</head>

<body>