<?php
include_once("_common.php");

@mkdir($g4['editor_data_path'], 0707);
@chmod($g4['editor_data_path'], 0707);

$ym = date('ym', $g4['server_time']);

define('EDITOR_YM_PATH', $g4['editor_data_path'].'/'.$ym);
define('EDITOR_YM_URL',  $g4['editor_data_url'].'/'.$ym);

@mkdir(EDITOR_YM_PATH, 0707);
@chmod(EDITOR_YM_PATH, 0707);

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
    $real_filename = duplicate_filename(EDITOR_YM_PATH, $filename);
	@move_uploaded_file($tmp_name, EDITOR_YM_PATH.'/'.$real_filename);
	$url .= '&bNewLine=true';
	$url .= '&sFileName='.$real_filename;
	//$url .= '&size='. $_FILES['Filedata']['size'];
	//아래 URL을 변경하시면 됩니다.
	$url .= '&sFileURL='.EDITOR_YM_URL.'/'.$real_filename;
} else { //실패시 errstr=error 전송
	$url .= '&errstr=error';
}
header('Location: '. $url);
?>