<?
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if ($g4['editor'] == 'geditor') {
    $g4['editor_url']       = $g4['url'].'/plugin/geditor';
    $g4['editor_data_url']  = $g4['url'].'/data/editor';
    $g4['editor_path']      = $g4['path'].'/plugin/geditor';
    $g4['editor_data_path'] = $g4['path'].'/data/editor';

    include_once("$g4[path]/lib/geditor.lib.php");
}
?>
