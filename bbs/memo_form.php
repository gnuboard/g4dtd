<?php
include_once("./_common.php");

$me_id = mysql_real_escape_string($me_id); 

if (!$member[mb_id])
    alert_close("회원만 이용하실 수 있습니다.");

if (!$member[mb_open] && $is_admin != "super" && $member[mb_id] != $mb_id)
    alert_close("자신의 정보를 공개하지 않으면 다른분에게 쪽지를 보낼 수 없습니다.\\n\\n정보공개 설정은 회원정보수정에서 하실 수 있습니다.");

$content = "";
// 탈퇴한 회원에게 쪽지 보낼 수 없음
if ($me_recv_mb_id)
{
    $mb = get_member($me_recv_mb_id);
    if (!$mb[mb_id])
        alert_close("회원정보가 존재하지 않습니다.\\n\\n탈퇴하였을 수 있습니다.");

    if (!$mb[mb_open] && $is_admin != "super")
        alert_close("정보공개를 하지 않았습니다.");

    // 4.00.15
    $row = sql_fetch(" select me_memo from $g4[memo_table] where me_id = '$me_id' and (me_recv_mb_id = '$member[mb_id]' or me_send_mb_id = '$member[mb_id]') ");
    if ($row[me_memo])
    {
        $content = "\n\n\n>"
                 . "\n>"
                 . "\n> " . preg_replace("/\n/", "\n> ", get_text($row[me_memo], 0))
                 . "\n>"
                 . "\n";

    }
}

$g4[title] = "쪽지 보내기";
$member_skin_path = "$g4[path]/skin/member/$config[cf_member_skin]";
include_once("$g4[path]/head.sub.php");

include_once("$member_skin_path/memo_form.skin.php");

include_once("$g4[path]/tail.sub.php");
?>
