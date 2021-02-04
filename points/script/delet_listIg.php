<?php
if (isset($_POST['id_ignore']) && isset($_POST['nick_ignore'])) {
	include_once 'connect.php';
	$id_ignore = $_POST['id_ignore'];
	$nick_ignore = $_POST['nick_ignore'];
	//-------------------------------------------
	$login = $_SESSION['login'];
	$file_login = "../logfiles/points_log.log";
	$fw = fopen($file_login, "a+");
	$logarr = array('points', 'delete ignore line', $login);
	include_once 'datetime.php';
	//-------------------------------------------
	if($nick_ignore == true) {
		$select_idIg = "SELECT id,date,nickname,points,accrued FROM ignoresstory WHERE id ='$id_ignore'";
		$result = mysqli_query($link, $select_idIg) or die(fwrite($fw, $newdate.' Ошибка delet_listIg.php (16): '.mysqli_error($link)."\n"));
		$row = mysqli_fetch_row($result);
		if (!empty($row)) {
			$id = $row[0];
			$dates = $row[1];
			$nickname = $row[2];
			$points = $row[3];
			$delet_listIg = "DELETE FROM ignoresstory WHERE id = '$id_ignore'";
			$result = mysqli_query($link, $delet_listIg) or die(fwrite($fw, $newdate.'Ошибка delet_listIg.php(17): '.mysqli_error($link)."\n"));
			if($result) {
				$logResult = array($dates, $nick_ignore, $points, 'строка удалена');
			}
		}
	} else {
		echo "Error, nickname $id_ignore !== true..";
	}
	$logarr = array_merge($logarr, $logResult);
	require_once 'LogAdminAction.php';
	fclose($fw);
	$link ->close();
}
?>