<?php
// ------- DELET LIST-------------
if(isset($_POST['new_login']) && isset($_POST['new_password']) && isset($_POST['new_priorty'])) {
	if(preg_match("/^[а-яё]+$/iu", $_POST['new_password']) == false) {
		include_once '../script/connect.php';
		$login_user = trim(htmlspecialchars(mysqli_real_escape_string($link, $_POST['new_login'])));
		$password_user = htmlspecialchars(mysqli_real_escape_string($link, trim($_POST['new_password'])));
		$num_pass = mb_strlen($password_user); //
		if(($num_pass < 5) || ($num_pass > 30)) {
			echo 'Длинна пароля должна быть от 5 до 30 символов';
			$link->close();
			exit();
		}
		$priority_user = trim($_POST['new_priorty']);
		if($priority_user != "") {
			if((($priority_user == '1') || ($priority_user == '2') || ($priority_user == '3')) == false) {
				echo 'Приоритет может быть только 1 или 2 или 3';
				$link->close();
				exit();
			}
		}
		if($login_user != "") {
			$query = "SELECT * FROM users WHERE role = 1";
			$result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));
			if($result) {
				$check = mysqli_num_rows($result);
				if($check == 1) {
					if($password_user != "") {
						$salt = $login_user.'login_user';
						$password_user = hash("sha256", $password_user.$salt);
						$query = "UPDATE users SET password_user='$password_user' WHERE login_user='$login_user'";
						$result = mysqli_query($link, $query) or die("Error: ".mysqli_error($link));
						if($result) {
							echo "Пароль ".$login_user." обновлен";
						} else {
							echo "А такой логин есть?";
						}
					}
					else if($password_user == "" && $priority_user == 0) {
						echo "Должен быть как минимум 1 админ";
					}
					else if($priority_user == 1) {
						$query = "UPDATE users SET role='$priority_user' WHERE login_user='$login_user'";
						$result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));
						if($result) {
							echo "Приоритет ".$login_user." обновлен";
						} else {
							echo "А такой логин есть?";
						}
					}
				}
				else {
					if($password_user != "") {
						$salt = $login_user.'login_user';
						$password_user = hash("sha256", $password_user.$salt);
						$query = "UPDATE users SET password_user='$password_user', role='$priority_user' WHERE login_user='$login_user'";
						$result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));
						if($result) {
							echo "Пароль и приоритет ".$login_user." обновлен";
						} else {
							echo "А такой логин есть?";
						}
					}
					else if($password_user == "") {
						$query = "UPDATE users SET role='$priority_user' WHERE login_user='$login_user'";
						$result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));
						if($result) {
							echo "Приоритет ".$login_user." обновлен";
						} else {
							echo "А такой логин есть?";
						}
					}
				}
			}
			$link->close();
		}
		else {
			echo "Логин не может быть пустой";
		}
	}
	else {
		echo "Пароль не может содержать кириллицу";
	}
} else {
	echo "Не все данные в _POST";
}
?>
