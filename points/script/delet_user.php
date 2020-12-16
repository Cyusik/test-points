<?php
if (isset($_POST['id_user']) && isset($_POST['nick_user'])) {
	include_once 'connect.php';
	$id_user = $_POST['id_user'];
	$nick_user = $_POST['nick_user'];
	//-------------------------------------------
	session_start();
	$login = $_SESSION['login'];
	$file_login = "../logfiles/points_log.log";
	$fw = fopen($file_login, "a+");
	include_once 'datetime.php';
	fwrite($fw, $newdate.' '.$login.' Удалил: '.'id=>'.$id_user.'; nick=>'.$nick_user."\r\n");
	//-------------------------------------------
	if($nick_user == true) {
		$query = "DELETE FROM tablballs WHERE id = '$id_user'";
		$result = mysqli_query($link, $query) or die(fwrite($fw, $newdate.'Ошибка delet_user.php(17): '.mysqli_error($link)."\n"));
		if($result) {
			fwrite($fw, $newdate.' delet result=>true'."\r\n");
		}
		//echo "<div class='modal_div_content' data-title='Игрок $nick_user (id $id_user) удален из таблицы'></div>";
	} else {
		echo "<div class='modal_div_content' data-title='Никнейм(id $id_user) не может быть пустой'></div>";
	}
	fclose($fw);
}
?>