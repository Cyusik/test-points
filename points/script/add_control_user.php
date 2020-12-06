<?php
if(!empty($_POST['add_login']) && isset($_POST['add_password']) && isset($_POST['add_priorty'])) {
	if(preg_match("/^[a-z0-9-_]{3,20}$/i", $_POST['add_login'])) {
		if(preg_match("/^[а-яё]+$/iu", $_POST['add_password']) == false) {
			include_once 'connect.php';
			$add_login = htmlspecialchars(mysqli_real_escape_string($link, (trim($_POST['add_login']))));
			$add_password = htmlspecialchars(mysqli_real_escape_string($link, trim($_POST['add_password'])));
			$add_priority = trim($_POST['add_priorty']);
			if($add_priority > 1) {
				echo "<div class='modal_div_content' data-title='Приоритет может быть = 0 или 1'></div>";
				exit();
			}
			if($add_login != "" && $add_password != "") {
				$salt = $add_login.'login_user';
				$password_user = hash("sha256", $add_password.$salt);
				$query = "INSERT INTO users (id, login_user, password_user, role) VALUES (NULL, '$add_login', '$password_user', '$add_priority')";
				$result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));
				if($result) {
					echo "<div class='modal_div_content' data-title='Пользователь $add_login добавлен'></div>";
				}
			}
			else {
				echo "<div class='modal_div_content' data-title='Логин и пароль не могут быть пустыми'></div>";
			}
			$link->close();
		}
		else {
			echo "<div class='modal_div_content' data-title='пароль не может содержать кириллицу'></div>";
		}
	}
	else {
		echo "<div class='modal_div_content' data-title='логин может содержать только цифры и буквы латинского алфавита, тире и подчеркивание от 3 до 20 символов'></div>";
	}
}
else {
	echo "<div class='modal_div_content' data-title='запроса нет'></div>";
}
?>