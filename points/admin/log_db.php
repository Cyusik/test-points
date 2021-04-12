<?php
include_once '../script/login.php';
session_start();
if($_GET['do'] == 'logout'){
	unset($_SESSION['login']);
	unset($_SESSION['role']);
	session_destroy();
}
if($_SESSION['login'] && $_SESSION['role'] == 1){
	$login = $_SESSION['login'];
	$role = $_SESSION['role'];
}
else {
	header("Location: ../admin/index.php");
	exit;
}
?>
<!doctype html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Log</title>
	<link rel="shortcut icon" href="http://mwogame.com/forum/favicon.ico" type="image/x-icon">
	<meta name="description" content="лог">
	<meta name="keywords" content="лог">
	<link href="../css/normalize.css" rel="stylesheet">
	<link href="../admin/css/general-ad.css" rel="stylesheet">
	<link href="../admin/css/control-ad.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="text/javascript" src="../jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="jsadmin/control.js"></script>
	<script type="text/javascript" src="jsadmin/log-bd.js"></script>
</head>
<body>
	<div class="fon clearfix">
		<header>Log_db</header>
		<hr><br>
		<div>
			<nav>
				<ul class="menu">
					<li><a href="../admin/control.php" class="button15">Назад</a></li>
					<li>
						<div class="button js-button-campaign"><span>Очистить логи</span></div>
						<div class="overlay js-overlay-campaign">
							<div class="popup js-popup-campaign">
								<h2>Внимание!</h2>
								Очистить БД логов?<br>
								Данные нельзя будет восстановить
								<br><form id="dellog"  action="../script/truncate_log.php" method="POST">
									<input class="button10" type="hidden" name="truncate" value="1">
									<input class="button10" type="submit" value="Очистить">
								</form>
								<div class="close-popup js-close-campaign"></div>
								<div id="resultdivlog"></div>
							</div>
						</div>
						<script src="../admin/main.js"></script>
					</li>
				</ul>
			</nav>
		</div>
		<div class="importb1">
			<h3>Общий</h3>
			<table class="table_import1">
				<tr>
					<td><b>Выбрать период между\раздел\админ\ (действие??) \ и всё наверное</b></td>
				</tr>
				<!-- ТЕСТ ДЖАВА-->
				<tr>
					<td>
						<form id="search-action" action="" method="GET">
							<table id="parametr-log" class="table_dark2">
								<tr><th colspan="3">Параметры</th></tr>
								<tr>
									<td>Выберите раздел :</td>
									<td colspan="2"><select id="sections" form="search-action" class="input" name="sections" required>
											<option value=""></option>
											<option value="points">Управление баллами</option>
											<option value="exchange">Управление обменом</option>
											<option value="swap">Управление призами</option>
											<option value="app-pr">Список заявок</option>
											<option value="login-admin">Посещения админки</option>
											<option value="search-table">Запросы по таблицам</option>
										</select></td>
								</tr>
							</table>
						</form>
					</td>
				</tr>
			</table>
			</div>
		<div class="log_print"><?include_once '../script/log_db.php'?></div>
		<br>
	</div>
<div>
	autor by Cyusik
</div>
</body>
</html>
