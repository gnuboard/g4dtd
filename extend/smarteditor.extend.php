<?
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 현재 파일의 웹경로
//echo preg_replace("/".addslashes($_SERVER['DOCUMENT_ROOT'])."/", "", dirname(__FILE__));

$g4['se_url']       = $g4['url'].'/plugin/smarteditor2';
$g4['se_data_url']  = $g4['url'].'/data/smarteditor2';
$g4['se_path']      = $g4['path'].'/plugin/smarteditor2';
$g4['se_data_path'] = $g4['path'].'/data/smarteditor2';

include_once("$g4[path]/lib/smarteditor2.lib.php");