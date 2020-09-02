<?php
if (isset($_POST['id_user']) && isset($_POST['login_user']) && isset($_POST['password_user']) && isset($_POST['priority_user'])) {
	include_once 'connect.php';
	$id_user = trim(mysqli_real_escape_string($link, $_POST['id_user']));
	$login_user = trim(mysqli_real_escape_string($link, $_POST['login_user']));
	$password_user = md5(trim($_POST['password_user']));
	$priority_user = trim(mysqli_real_escape_string($link, $_POST['priority_user']));
	if($login_user != "") {
		if($password_user != "") {
			$query = "UPDATE users SET login_user='$login_user', password_user='$password_user', role='$priority_user' WHERE id='$id_user'";
			$result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));
			if($result) {
				echo "<div class='modal_div_content' data-title='Данные пользователя $login_user обновлены...'></div>";
			}
		}
		else {
			echo "<div style='color:#ff0505' class='modal_div_content' data-title='Пароль не должен быть пустым'></div>";
		}
	} else {
		echo "<div style='color:#ff0505' class='modal_div_content' data-title='Логин не должен быть пустым'></div>";
	}
}
?>
