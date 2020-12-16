<?php
require_once 'connect.php';
//$connection = mysqli_connect('localhost', 'root', '', 'basevis') or die(mysqli_error($connection));
//batya
//batyainhouse
if(isset($_POST['submit'])) {
	$ip = $_SERVER['REMOTE_ADDR'];
	$file_login = "../logfiles/login_to_admin.log";
	$fw = fopen($file_login, "a+");
	include_once 'datetime.php';
	fwrite($fw, $newdate.' Запрос на вход '.$ip."\r\n");
	if(empty($_POST['login_user'])) {
		$info_input = "<div class='login'><b>Вы не ввели логин</b></div>";
	}
	elseif(empty($_POST['password_user'])) {
		$info_input = "<div class='login'><b>Вы не ввели пароль</b></div>";
	}
	else {
		if(preg_match("/^[a-z0-9-_]{3,20}$/i", $_POST['login_user'])) {
			$login_user = htmlspecialchars(mysqli_real_escape_string($link, (trim($_POST['login_user']))));
			fwrite($fw, $newdate.' login_user: '.$login_user."\r\n");
			if(preg_match("/^[а-яё]+$/iu ", $_POST['password_user']) == false) {
				$password_user = htmlspecialchars(mysqli_real_escape_string($link, trim($_POST['password_user'])));
				$select_login = "SELECT id, login_user, password_user, role FROM users WHERE login_user='$login_user'";
				$result = mysqli_query($link, $select_login) or die (fwrite($fw, $newdate.' Error: '.mysqli_error($link)."\r\n"));
				$row_login = mysqli_fetch_row($result);
				if($row_login) {
					$salt = $row_login[1].'login_user';
					$password_user = hash("sha256", $password_user.$salt);
					if($password_user === $row_login[2]) {
						fwrite($fw, $newdate.' password_user: '.$password_user."\r\n");
						fwrite($fw, $newdate.' Вход выполнен'."\r\n");
						$_SESSION['role'] = $row_login[3];
						$_SESSION['login'] = $row_login[1];
						header('Location:../admin/mainballs.php');
					}
					else {
						$info_input = "<div class='login'><b>Данные неверны</b></div>";
						fwrite($fw, $newdate.' false/no password in the db'."\r\n");
					}
				}
				else {
					$info_input = "<div class='login'><b>Данные неверны</b></div>";
					fwrite($fw, $newdate.' false/no login in the db'."\r\n");
				}
			}
			else {
				$info_input = "<div class='login'><b>Данные неверны</b></div>";
				fwrite($fw, $newdate.' false preg_match password: '.$_POST['password_user']."\r\n");
			}
		}
		else {
			$info_input = "<div class='login'><b>Данные неверны</b></div>";
			fwrite($fw, $newdate.' false preg_match login: '.$_POST['login_user']."\r\n");
		}
	}
	fclose($fw);
}
$info_input = isset($info_input) ? $info_input : null;
echo $info_input;
?>