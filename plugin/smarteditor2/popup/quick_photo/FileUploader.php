<?php
include_once("_common.php");

@mkdir($g4['se_data_path'], 0707);
@chmod($g4['se_data_path'], 0707);

$ym = date('ym', $g4['server_time']);

define('SE_YM_PATH', $g4['se_data_path'].'/'.$ym);
define('SE_YM_URL', $g4['se_data_url'].'/'.$ym);

@mkdir(SE_YM_PATH, 0707);
@chmod(SE_YM_PATH, 0707);

//기본 리다이렉트
echo $_REQUEST["htImageInfo"];

$filename = $_FILES['Filedata']['name'];
$tmp_name = $_FILES['Filedata']['tmp_name'];

preg_match("/(\.[\w]+)$/", $filename, $matches);
$ext = strtolower($matches[1]);

$bFileFormat = false;
switch ($ext) {
case '.gif' :
case '.png' :
case '.jpg' :
    $bFileFormat = true;
}

$url = $_REQUEST["callback"] .'?callback_func='. $_REQUEST["callback_func"];
$bSuccessUpload = is_uploaded_file($tmp_name);
if ($bFileFormat && $bSuccessUpload) { //성공 시 파일 사이즈와 URL 전송
    // 실제파일명은 아이피와 날짜,시간을 붙여서 만든다.
    //$real_filename = abs(ip2long($_SERVER['REMOTE_ADDR'])).'_'.date('ymdhis').'_'.urlencode($filename);
    // 실제파일명은 아이피를 붙여서 만든다.
    $real_filename = abs(ip2long($_SERVER['REMOTE_ADDR'])).'_'.urlencode($filename);
	$new_path = SE_YM_PATH.'/'.$real_filename;
	@move_uploaded_file($tmp_name, $new_path);
	$url .= '&bNewLine=true';
	$url .= '&sFileName='.urlencode($real_filename);
	//$url .= '&size='. $_FILES['Filedata']['size'];
	//아래 URL을 변경하시면 됩니다.
	$url .= '&sFileURL='.SE_YM_URL.'/'.urlencode($real_filename);
} else { //실패시 errstr=error 전송
	$url .= '&errstr=error';
}
header('Location: '. $url);
?>