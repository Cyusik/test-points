<?php
if (isset($_POST['id_user']) && isset($_POST['nick_user']) && isset($_POST['point_user']) && isset($_POST['history_user'])) {
	include_once 'connect.php';
	$id_user = $_POST['id_user'];
	$nick_user = trim($_POST['nick_user']);
	$point_user = trim($_POST['point_user']);
	$history_user = $_POST['history_user'];
	if($nick_user != "") {
		if($point_user != "") {
			$query = "UPDATE tablballs SET nickname='$nick_user', balls='$point_user', history='$history_user' WHERE id='$id_user'";
			$result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));
			if($result) {
				echo "<div class='modal_div_content' data-title='Данные игрока $nick_user ($id_user) обновлены...'></div>";
			}
		}
		else {
			echo "<div style='color:#ff0505' class='modal_div_content' data-title='Баллы нельзя оставлять пустыми!'></div>";
		}
	} else {
		echo "<div style='color:#ff0505' class='modal_div_content' data-title='Никнейм нельзя оставлять пустым!'></div>";
	}
}
?>