<?php
if (isset($_POST['id_user']) && isset($_POST['login_user']) && isset($_POST['password_user']) && isset($_POST['priority_user'])) {
	include_once 'connect.php';
	$id_user = intval(mysqli_real_escape_string($link, $_POST['id_user']));
	$login_user = trim(mysqli_real_escape_string($link, $_POST['login_user']));
	$password_user = trim($_POST['password_user']);
	$priority_user = trim(mysqli_real_escape_string($link, $_POST['priority_user']));
	if ($priority_user > 1) {
		echo "<div class='modal_div_content' data-title='Приоритет может быть = 0 или 1'></div>";
		exit();
	}
	if($id_user != 0) {
		if($password_user != "") {
			$query = "UPDATE users SET password_user=MD5('$password_user'), role='$priority_user' WHERE id='$id_user'";
			$result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));
			if($result) {
				echo "<div class='modal_div_content' data-title='Пароль и приоритет $login_user обновлен'></div>";
			}
		}
		else if ($password_user == "") {
			$query = "UPDATE users SET role='$priority_user' WHERE id='$id_user'";
			$result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));
			if($result) {
				echo "<div class='modal_div_content' data-title='Приоритет $login_user обновлен'></div>";
			}
		}
	} else {
		echo "<div style='color:#ff0505' class='modal_div_content' data-title='без id не сработает'></div>";
	}
}
?>