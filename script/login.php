<?php
require_once 'connect.php';
//$connection = mysqli_connect('localhost', 'root', '', 'basevis') or die(mysqli_error($connection));
//batya
//batyainhouse
if (isset($_POST['submit']))
{
	if (empty($_POST['login_user']))
	{
		$info_input = "<div class='login'><b>Вы не ввели логин</b></div>";
	}
	elseif (empty($_POST['password_user']))
	{
		$info_input = "<div class='login'><b>Вы не ввели пароль</b></div>";
	}
	else
	{
		$login_user = $_POST['login_user'];
		$password_user = md5($_POST['password_user']);
		$user = mysqli_query($link, "SELECT id FROM users WHERE login_user = '$login_user' AND password_user = '$password_user'");
		$id_user = mysqli_fetch_array($user);

		if (empty($id_user['id']))
		{
			$info_input = "<div class='login'><b>Данные неверны</b></div>";
		}
		else
		{
			$_SESSION['password'] = $password_user;
			$_SESSION['login'] = $login_user;
			$_SESSION['id'] = $id_user['id'];

			header('Location:../admin/mainballs.php');
		}
	}
}
$info_input = isset($info_input) ? $info_input : NULL;
echo $info_input;
?>
