<?php
include_once("_common.php");

// 시간이 비어 있는지 검사
function is_null_time($datetime)
{
	// 공란 0 : - 제거
	$datetime = ereg_replace("[ 0:-]", "", $datetime);
	if ($datetime == "")
	    return true;
	else
	    return false;
}

// echo "한글"로 출력하지 않는 이유는 Ajax 는 euc_kr 에서 한글을 제대로 인식하지 못하기 때문
// 여기에서 영문으로 echo 하여 Request 된 값을 Javascript 에서 한글로 메세지를 출력함


$reg_mb_id        = strtolower(trim($_POST['reg_mb_id']));
$reg_mb_recommend = strtolower(trim($_POST['reg_mb_recommend']));

if ($reg_mb_id == $reg_mb_recommend) {
    echo "140"; // 자기 자신을 추천할 수 없습니다.
} else if (preg_match("/[^0-9a-z_]+/i", $reg_mb_recommend)) {
    echo "110"; // 유효하지 않은 회원아이디
} else if (strlen($reg_mb_recommend) < 4) {
    echo "120"; // 길이 4보다 작은 회원아이디
} else {
    $row = sql_fetch(" select mb_leave_date, mb_intercept_date, mb_email_certify from {$g4['member_table']} where mb_id = '$reg_mb_recommend' ");
    if ($row) {
        if ($row['mb_leave_date'] || $row['mb_intercept_date'] || is_null_time($row['mb_email_certify'])) {
            echo "150"; // 탈퇴나 차단된 회원 또는 이메일인증 되지 않은 회원이라면 비정상
        } else {
            echo "000"; // 이미 존재하는 회원아이디 이므로 정상
        }
    } else {
        echo "130"; // 존재하지 않는 아이디
    }
}
?>