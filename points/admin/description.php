<?php
ini_set('session.cookie_secure',1);
ini_set('session.cookie_httponly',1); // посмотреть позже
ini_set('session.use_only_cookies',1);
include_once '../script/login.php';
session_start();
if($_GET['action'] == 'logout'){
	unset($_SESSION['names']);
	unset($_SESSION['role']);
	session_destroy();
}
if($_SESSION['names'] && $_SESSION['role']){
	$names = $_SESSION['names'];
	$role = $_SESSION['role'];
}
else {
	header("Location: ../admin/index.php");
	exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Админка баллы</title>
	<link rel="shortcut icon" href="http://mwogame.com/forum/favicon.ico" type="image/x-icon">
	<meta name="description" content="Описание страницы">
	<meta name="keywords" content="Ключевые слова через запятую">
	<link href="../css/normalize.css" rel="stylesheet">
	<link href="../admin/css/general-admin.css" rel="stylesheet">
	<link href="../admin/css/table_admin.css" rel="stylesheet">
	<link href="../admin/css/navigation-admin.css" rel="stylesheet">
	<link href="../admin/css/modal-window.css" rel="stylesheet">
	<link href="../admin/css/upload-csv.css" rel="stylesheet">
	<link href="../admin/css/control.css" rel="stylesheet">
	<link href="../admin/css/adaptive.css" rel="stylesheet">
	<link href="https://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<script type="text/javascript" src="../jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="../admin/jsadmin/navigation-admin.js"></script>
	<script type="text/javascript">
		var isMobile = false;
		// проверка на размер экрана
		$(document).ready( function() {
			if ($('body').width() <= 460) {
				isMobile = true;
			}
			if (!isMobile) {
				//alert(isMobile);
				$('body').append('<script type="text/javascript" src="../jsjq/fixed-div.js"></scr' + 'ipt>');
			} else {
				$('body').append('<script type="text/javascript" src="jsadmin/menu_mob.js"></scr' + 'ipt>');
			}
		});
	</script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<div class="main">
		<div class="navigation clearfix">
			<div class="fixed-div">
			<? include_once '../script/navigation-ul.php'?>
		</div>
		</div>
		<div class="content clearfix">
			<?
				if(!empty($_GET['action'])) {
					include_once $_GET['action'];
				} else {
					include_once 'instruction.php';
				}
			?>
		</div>
		<div class="end"></div>
		<div class="content-foot">
			Сайт любезно разработан игроком <a href="http://mwogame.com/forum/user/17146-cyusik-c%d1%8e%d1%81%d0%b8%d0%ba/" target="_blank">Cyusik</a>
			<br>
			Copyright (c) GDT Limited. <a href="http://gdteam.com">http://gdteam.com</a>
		</div>
		</div>
</body>
</html>