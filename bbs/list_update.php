<?php
$sw = $_POST['sw'];

switch ($sw) {
	case "copy" :
	case "move" :
		include_once("./move.php");
		break;
	case "delete" :
		include_once("./delete_all.php");
		break;
	default :
		echo "지정되지 않은 작업입니다!";
		break;
}
?>
