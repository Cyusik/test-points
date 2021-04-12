<?php
require_once 'connect.php';
//$connection = mysqli_connect('localhost', 'root', '', 'basevis') or die(mysqli_error($connection));
//batya
//batyainhouse
if(isset($_POST['submit'])) {
	$ip_user = $_SERVER['REMOTE_ADDR'];
	if(empty($_POST['login_user'])) {
		$info_input = "<div class='login'><b>Вы не ввели логин</b></div>";
	}
	elseif(empty($_POST['password_user'])) {
		$info_input = "<div class='login'><b>Вы не ввели пароль</b></div>";
	}
	else {
		if(preg_match("/^[a-z0-9-_]{3,20}$/i", $_POST['login_user'])) {
			$login_user = htmlspecialchars(mysqli_real_escape_string($link, (trim($_POST['login_user']))));
			if(preg_match("/^[а-яё]+$/iu ", $_POST['password_user']) == false) {
				$password_user = htmlspecialchars(mysqli_real_escape_string($link, trim($_POST['password_user'])));
				$select_login = "SELECT id,name_user,login_user,password_user,role FROM users WHERE login_user='$login_user'";
				$result = mysqli_query($link, $select_login) or die ('Error: '.mysqli_error($link));
				$row_login = mysqli_fetch_row($result);
				if($row_login) {
					$salt = $row_login[2].'login_user';
					$password_user = hash("sha256", $password_user.$salt);
					if($password_user === $row_login[3]) {
						$res_log = 'Вход выполнен';
						$_SESSION['role'] = $row_login[4];
						$_SESSION['names'] = $row_login[1];
						header('Location:../admin/description.php');
					}
					else {
						$info_input = "<div class='login'><b>Данные неверны</b></div>";
						$res_log = 'false/no password in the db';
					}
				}
				else {
					$info_input = "<div class='login'><b>Данные неверны</b></div>";
					$res_log = 'false/no login in the db';
				}
			}
			else {
				$info_input = "<div class='login'><b>Данные неверны</b></div>";
				$res_log = 'false preg_match password';
			}
		}
		else {
			$info_input = "<div class='login'><b>Данные неверны</b></div>";
			$res_log = 'false preg_match login';
		}
	}
	$ins_aut_log = "INSERT INTO auth_adm_log(ipuser,login,password,loginresult) VALUES ('$ip_user', '$login_user', '$password_user', '$res_log')";
	$rea_aut = mysqli_query($link, $ins_aut_log) or die(mysqli_error($link));
}
$info_input = isset($info_input) ? $info_input : null;
echo $info_input;
?>