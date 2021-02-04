<?php
session_start();
if($_SESSION['login']){
	header("Location:../admin/mainballs.php");
	exit;
}
include_once '../script/login.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Управление баллами</title>
	<link rel="shortcut icon" href="http://mwogame.com/forum/favicon.ico" type="image/x-icon">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<link href="../css/normalize.css" rel="stylesheet">
	<link href="../admin/css/authorization.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="avtoriz">
	<div class="blockvis">
		<br>
		<h1>Управление баллами</h1>
		<h3>Авторизация</h3>
	</div>
	<form action="../admin/index.php" method="POST">
		<table>
			<tr>
				<td>Введите логин:</td>
				<td><input type="text" name="login_user" /></td>
			</tr>
			<tr>
				<td>Введите пароль:</td>
				<td><input type="password" name="password_user" /></td>
			</tr>
			<tr>
				<td colspan="2"><input class="button" type="submit" value="Войти" name="submit" /></td>
			</tr>
		</table>
	</form>
</div>
</body>
</html>
