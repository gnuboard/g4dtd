<?php
include_once("_common.php");

@mkdir($g4['editor_data_path'], 0707);
@chmod($g4['editor_data_path'], 0707);

$ym = date('ym', $g4['server_time']);

define('EDITOR_YM_PATH', $g4['editor_data_path'].'/'.$ym);
define('EDITOR_YM_URL',  $g4['editor_data_url'].'/'.$ym);

@mkdir(EDITOR_YM_PATH, 0707);
@chmod(EDITOR_YM_PATH, 0707);

$obj   = $_POST['obj'];
$token = $_POST['token'];
$work  = $_POST['work'];

if (!$token) exit;

if (!$obj)
    alert_only('오브젝트 변수가 없습니다.');

if ($work == 'delete') {
    delete_image($token, EDITOR_YM_PATH);
    exit;
}

$file = $_FILES['image'];
$size = getImageSize($file['tmp_name']);
$mime = array('image/png', 'image/jpeg', 'image/gif');

if (!is_uploaded_file($file[tmp_name]))
    alert_only("첨부파일이 업로드되지 않았습니다.\\n\\n$file[error]");

if (!in_array($size['mime'], $mime))
    alert_only("PNG, GIF, JPG 형식의 이미지 파일만 업로드 가능합니다.");

if (!preg_match("/\.(jpg|png|gif)$/i", $file[name]))
    alert_only("PNG, GIF, JPG 형식의 이미지 파일만 업로드 가능합니다.");

delete_image($token, EDITOR_YM_PATH);

$real_filename = duplicate_filename(EDITOR_YM_PATH, $file['name']);
$real_filepath = EDITOR_YM_PATH.'/'.$real_filename;
move_uploaded_file($file['tmp_name'], $real_filepath);
chmod($real_filepath, 0606);

setCookie('ge_token', $token);
setCookie('ge_file', $real_filepath);
?>
<script type="text/javascript">
parent.<?=$obj?>.insert_image_preview("<?=EDITOR_YM_URL.'/'.$real_filename?>");
</script>