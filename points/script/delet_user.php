<?php
if (isset($_POST['id_user']) && isset($_POST['nick_user'])) {
	include_once 'connect.php';
	$id_user = $_POST['id_user'];
	$nick_user = $_POST['nick_user'];
	//-------------------------------------------
	session_start();
	$login = $_SESSION['login'];
	$logarr = array('points', 'delet user', $login);
	//-------------------------------------------
	if($nick_user == true) {
		$query = "DELETE FROM tablballs WHERE id = '$id_user'";
		$result = mysqli_query($link, $query) or die(fwrite($fw, $newdate.'Ошибка delet_user.php(17): '.mysqli_error($link)."\n"));
		if($result) {
			$logarr[] = 'Удалил игрока '.$nick_user.' из таблицы баллов';
		}
	} else {
		echo "<div class='modal_div_content' data-title='Никнейм(id $id_user) не может быть пустой'></div>";
	}
	require_once 'LogAdminAction.php';
	fclose($fw);
}
?>