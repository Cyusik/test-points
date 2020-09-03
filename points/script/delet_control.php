<?php
if (isset($_POST['id_user']) && isset($_POST['login_user'])) {
	include_once 'connect.php';
	$id_user = intval($_POST['id_user']);
	$login_user = trim(mysqli_real_escape_string($link, $_POST['login_user']));
	if ($id_user !=0) {
		$query = "SELECT * FROM users WHERE role = 1";
		$result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));
		if ($result) {
			$check = mysqli_num_rows($result);
			if ($check == 1) {
				$query = "DELETE FROM users WHERE id = '$id_user' AND role = 0";
				$result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));
				$link->close();
			} else {
			if($login_user != "") {
				$query = "DELETE FROM users WHERE id = '$id_user'";
				$result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));
				if ($result) {
					echo "<div class='modal_div_content' data-title='Пользователь $login_user удален'></div>";
				}
			} else {
				echo "<div class='modal_div_content' data-title='Логин не должен быть пустым'></div>";
			}
		}
	}
	}else {
		echo "<div class='modal_div_content' data-title='без id не работает'></div>";
	} $link->close();
}
?>
