<?php
if (isset($_POST['add_login']) && isset($_POST['add_password']) && isset($_POST['add_priorty'])) {
	//echo "<div class='modal_div_content' data-title='запрос есть'></div>";
	include_once 'connect.php';
	$add_login = trim(mysqli_real_escape_string($link, $_POST['add_login']));
	$add_password = trim($_POST['add_password']);
	$add_priority = trim($_POST['add_priorty']);
	if ($add_priority > 1) {
		echo "<div class='modal_div_content' data-title='Приоритет может быть = 0 или 1'></div>";
		exit();
	}
	if ($add_login != "" && $add_password != "") {
		$query = "INSERT INTO users (id, login_user, password_user, role) VALUES (NULL, '$add_login', MD5('$add_password'), '$add_priority')";
		$result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));
		if ($result) {
			echo "<div class='modal_div_content' data-title='Пользователь $add_login добавлен'></div>";
		}
	} else {
		echo "<div class='modal_div_content' data-title='Логин и пароль не могут быть пустыми'></div>";
	} $link->close();
} else {
	echo "<div class='modal_div_content' data-title='запроса нет'></div>";
}
?>