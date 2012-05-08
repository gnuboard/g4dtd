<?php
include_once("_common.php");

$reg_mb_nick = $_POST['reg_mb_nick'];

// 별명은 한글, 영문, 숫자만 가능
if (!check_string($reg_mb_nick, _G4_HANGUL_ + _G4_ALPHABETIC_ + _G4_NUMERIC_)) {
    echo "110"; // 별명은 공백없이 한글, 영문, 숫자만 입력 가능합니다.
} else if (strlen($reg_mb_nick) < 4) {
    echo "120"; // 4글자 이상 입력
} else {
    $row = sql_fetch(" select count(*) as cnt from {$g4['member_table']} where mb_nick = '$reg_mb_nick' ");
    if ($row['cnt']) {
        echo "130"; // 이미 존재하는 별명
    } else {
        if (preg_match("/[\,]?{$reg_mb_nick}/i", $config[cf_prohibit_id]))
            echo "140"; // 예약어로 금지된 회원아이디, 별명
        else
            echo "000"; // 정상
    }
}
?>