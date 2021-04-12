<?php
if(isset($_POST['add_name']) && isset($_POST['add_login']) && isset($_POST['add_password']) && isset($_POST['add_priorty'])) {
	if(
		preg_match("/^[a-z0-9-_]{3,21}$/i", $_POST['add_name']) &&
		preg_match("/^[a-z0-9-_]{3,30}$/i", $_POST['add_login'])
	) {
		if(preg_match("/^[а-яё]+$/iu", $_POST['add_password']) == false) {
			include_once '../script/connect.php';
			//-------------------------
			session_start();
			$names = $_SESSION['names'];
			//--------------------------
			$add_name = trim(htmlspecialchars(mysqli_real_escape_string($link, $_POST['add_name'])));
			$add_login = htmlspecialchars(mysqli_real_escape_string($link, (trim($_POST['add_login']))));
			$add_password = htmlspecialchars(mysqli_real_escape_string($link, trim($_POST['add_password'])));
			$num_pass = mb_strlen($add_password); //
			if(($num_pass < 5) || ($num_pass > 30)) {
				echo 'Длинна пароля должна быть от 5 до 30 символов';
				$link->close();
				exit();
			}
			if($add_name == $add_login) {
				echo 'Имя и Логин не должны быть одинаковыми';
				$link->close();
				exit();
			}
			$add_priority = trim($_POST['add_priorty']);
			if((($add_priority == '1') || ($add_priority == '2') || ($add_priority == '3')) == false) {
				echo 'Приоритет может быть только 1 или 2 или 3';
				$link->close();
				exit();
			}
			if($add_login != "" && $add_password != "") {
				$check_user = "SELECT name_user, login_user FROM users";
				$res_ch = mysqli_query($link, $check_user) or die("Error: ".mysqli_error($link));
				if($res_ch) {
					$ln = mysqli_num_rows($res_ch);
					for($i = 0; $i < $ln; ++$i) {
						$st = mysqli_fetch_row($res_ch);
						for($h = 0; $h < count($st); ++$h) {
							if((($add_name == $st[$h]) || ($add_login == $st[$h]))) {
								echo "Указанное Имя или Логин совпадает с Именем или Логином уже имеющимся в базе";
								$link->close();
								exit();
							}
						}
					}
				}
				$salt = $add_login.'login_user';
				$password_user = hash("sha256", $add_password.$salt);
				$query = "INSERT INTO users(name_user,login_user,password_user,role) VALUES ('$add_name', '$add_login', '$password_user', '$add_priority')";
				$result = mysqli_query($link, $query) or die("Error: ".mysqli_error($link));
				if($result) {
					$ins_add_ct = "INSERT INTO control_log(login_ad,action,field_one,field_two,field_three) VALUES ('$names', 'new_user', '$add_name', '$add_login', '$add_priority')";
					$res_add_ct = mysqli_query($link, $ins_add_ct) or die('Error: '.mysqli_error($link));
					if($res_add_ct) {
						$echo = "Запись добавлена. ";
					}
					echo $echo."Пользователь ".$add_login." добавлен";
				}
			}
			else {
				echo "Логин и пароль не могут быть пустыми";
			}
			$link->close();
		}
		else {
			echo "Пароль не может содержать кириллицу";
		}
	}
	else {
		echo "Имя и Логин может содержать только цифры и буквы латинского алфавита, тире и подчеркивание, длинну от 3 до 30 символов";
	}
}
else {
	echo "не все данные в _POST";
}
?>