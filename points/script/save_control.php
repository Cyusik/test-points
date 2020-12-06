<?php
if(isset($_POST['id_user']) && isset($_POST['login_user']) && isset($_POST['password_user']) && isset($_POST['priority_user'])) {
	include_once 'connect.php';
	$id_user = intval(mysqli_real_escape_string($link, $_POST['id_user']));
	$login_user = htmlspecialchars(mysqli_real_escape_string($link, (trim($_POST['login_user']))));
	if(preg_match("/^[а-яё]+$/iu ", $_POST['password_user']) == false) {
		$password_user = htmlspecialchars(mysqli_real_escape_string($link, trim($_POST['password_user'])));
		$priority_user = trim(mysqli_real_escape_string($link, $_POST['priority_user']));
		if($priority_user > 1) {
			echo "<div class='modal_div_content' data-title='Приоритет может быть = 0 или 1'></div>";
			exit();
		}
		if($id_user != 0) {
			$query = "SELECT * FROM users WHERE role = 1";
			$result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));
			if($result) {
				$check = mysqli_num_rows($result);
				if($check == 1) {
					if($password_user != "") {
						$salt = $login_user.'login_user';
						$password_user = hash("sha256", $password_user.$salt);
						$query = "UPDATE users SET password_user='$password_user' WHERE id='$id_user'";
						$result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));
						if($result) {
							echo "<div class='modal_div_content' data-title='Пароль $login_user обновлен'></div>";
						}
					}
					else if($password_user == "" && $priority_user == 0) {
						echo "<div class='modal_div_content' data-title='Должен быть как минимум 1 админ'></div>";
					}
					else if($priority_user == 1) {
						$query = "UPDATE users SET role='$priority_user' WHERE id='$id_user'";
						$result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));
						if($result) {
							echo "<div class='modal_div_content' data-title='Приоритет $login_user обновлен'></div>";
						}
					}
				}
				else {
					if($password_user != "") {
						$salt = $login_user.'login_user';
						$password_user = hash("sha256", $password_user.$salt);
						$query = "UPDATE users SET password_user='$password_user', role='$priority_user' WHERE id='$id_user'";
						$result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));
						if($result) {
							echo "<div class='modal_div_content' data-title='Пароль и приоритет $login_user обновлен'></div>";
						}
					}
					else if($password_user == "") {
						$query = "UPDATE users SET role='$priority_user' WHERE id='$id_user'";
						$result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));
						if($result) {
							echo "<div class='modal_div_content' data-title='Приоритет $login_user обновлен'></div>";
						}
					}
				}
			}
			$link->close();
		}
		else {
			echo "<div style='color:#ff0505' class='modal_div_content' data-title='без id не сработает'></div>";
		}
	}
	else {
		echo "<div class='modal_div_content' data-title='пароль не может содержать кириллицу'></div>";
	}
}
?>
