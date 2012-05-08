<?php
define('_NO_CONFIG_', false); // config 테이블을 읽지 않는다.
include_once("_common.php");
//error_reporting (E_ALL);
include('kcaptcha.php');

//session_start();
$captcha = new KCAPTCHA();
$captcha->setKeyString(get_session("captcha_keystring"));
$captcha->getKeyString();
$captcha->image();
?>