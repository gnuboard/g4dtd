<?php
include_once("_common.php");

@mkdir($g4['editor_data_path'], 0707);
@chmod($g4['editor_data_path'], 0707);

$ym = date('ym', $g4['server_time']);

$data = new stdClass;
$data->path = $g4['editor_data_path'].'/'.$ym;
$data->url  = $g4['editor_data_url'].'/'.$ym;

@mkdir($data->path, 0707);
@chmod($data->path, 0707);

$sFileInfo = '';
$headers = array(); 
foreach ($_SERVER as $k => $v){   
    if(substr($k, 0, 9) == "HTTP_FILE"){ 
        $k = substr(strtolower($k), 5); 
        $headers[$k] = $v; 
    } 
}

$file = new stdClass; 
$file->name = abs(ip2long($_SERVER['REMOTE_ADDR'])).'_'.rawurldecode($headers['file_name']);	
$file->size = $headers['file_size'];
$file->content = file_get_contents("php://input"); 

$newPath = $data->path.'/'.$file->name;

if(file_put_contents($newPath, $file->content)) {
    $sFileInfo .= "&bNewLine=true";
    $sFileInfo .= "&sFileName=".$file->name;
    $sFileInfo .= "&sFileURL=".$data->url.'/'.$file->name;
}
echo $sFileInfo;
?>