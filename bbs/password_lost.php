<?php
include_once("./_common.php");

if ($member[mb_id])
{
    echo "<script type='text/javascript'>";
    echo "alert('이미 로그인중입니다.');";
    echo "window.close();";
    echo "opener.document.location.reload();";
    echo "</script>";
    exit;
}

$g4[title] = "회원아이디/비밀번호 찾기";
$member_skin_path = "{$g4['path']}/skin/member/{$config['cf_member_skin']}";
include_once("{$g4['path']}/head.sub.php");

include_once("$member_skin_path/password_lost.skin.php");

include_once("{$g4['path']}/tail.sub.php");
?>