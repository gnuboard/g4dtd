<?php
include_once("./_common.php");

function json_parse($str)
{
    // Damn pesky carriage returns...
    $str = str_replace("\r\n", "\n", $str);
    $str = str_replace("\r", "\n", $str);

    // JSON requires new line characters be escaped
    $str = str_replace("\n", "\\n", $str);

    $str = str_replace('"', '\"', $str);

    return $str;
}

$wr_id = $_GET['comment_id'];
$sql = " select mb_id, wr_option, wr_content from $write_table where wr_id = '$wr_id' ";
$wr = sql_fetch($sql);
if ($is_admin || ($member[mb_id] && $member[mb_id] == $wr[mb_id])) {
    $secret = strstr($wr[wr_option], "secret") ? "secret" : "";
    echo "{\"secret\": \"$secret\", \"wr_content\":\"".json_parse($wr[wr_content])."\"}";
} else {
    echo "";
}
?>