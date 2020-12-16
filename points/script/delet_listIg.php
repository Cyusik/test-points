<?php
if (isset($_POST['id_ignore']) && isset($_POST['nick_ignore'])) {
	include_once 'connect.php';
	$id_ignore = $_POST['id_ignore'];
	$nick_ignore = $_POST['nick_ignore'];
	//-------------------------------------------
	$login = $_SESSION['login'];
	$file_login = "../logfiles/points_log.log";
	$fw = fopen($file_login, "a+");
	include_once 'datetime.php';
	fwrite($fw, $newdate.' '.$login.' Удалил: '.'id=>'.$id_ignore.'; nick=>'.$nick_ignore."\r\n");
	//-------------------------------------------
	if($nick_ignore == true) {
		$delet_listIg = "DELETE FROM ignoresstory WHERE id = '$id_ignore'";
		$result = mysqli_query($link, $delet_listIg) or die(fwrite($fw, $newdate.'Ошибка delet_listIg.php(17): '.mysqli_error($link)."\n"));
		if($result) {
			fwrite($fw, $newdate.' delet result listIg => true'."\r\n");
		}
	} else {
		echo "Error, nickname $id_ignore !== true..";
	}
	fclose($fw);
	$link ->close();
}
?>