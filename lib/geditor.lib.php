<?
if (!defined('_GNUBOARD_')) exit;

function editor_load()
{
    global $g4;
    return 
        "<script type=\"text/javascript\" src=\"{$g4['editor_path']}/geditor.js\"></script>\n".
        "<script type=\"text/javascript\">$(function(){ geditor_load(); });</script>\n";
}

/*
id 는 textarea 의 id element 를 말한다.
content 는 textarea 의 내용(값)을 말한다. 수정시에 저장된 값을 노출할때 사용된다.
폭은 거의 100%로 사용하므로 앞에 height 를 놓았다.
*/
function editor_run($element_id, $content, $height='400', $width='100%')
{
    global $g4;

    $rows = (int)($height / 20);
    return "<textarea id=\"$element_id\" name=\"$element_id\" class=\"textarea\" rows=\"$rows\" style=\"width:$width\" geditor=\"geditor\">$content</textarea>\n";
}

function editor_submit($element_id)
{
    return "\n";
}

function delete_image($token, $path) {
    global $_COOKIE;
    if ($token==$_COOKIE['ge_token']) {
        if (substr($_COOKIE['ge_file'], 0, strlen($path))==$path) {
            if (file_exists($_COOKIE['ge_file'])) {
                @unlink($_COOKIE['ge_file']);
            }
        }
    }
}

function alert_only($msg='', $url='') {
    echo "<script type=\"text/javascript\"> alert(\"$msg\"); </script>";
    exit;
}
?>