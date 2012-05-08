<?php
include_once("_common.php");

$reg_mb_name = $_POST['reg_mb_name'];

// 이름은 한글만 가능
if (!check_string($reg_mb_name, _G4_HANGUL_)) {
    echo "110"; // 이름은 공백없이 한글만 입력 가능합니다.
} else if (strlen($reg_mb_name) < 4) {
    echo "120"; // 4글자 이상 입력
} else {
    echo "000"; // 정상
}
?>