<?php
include_once '../script/login.php';
session_start();
if($_GET['do'] == 'logout'){
	unset($_SESSION['login']);
	session_destroy();
}
if($_SESSION['login']){
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
	<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
	<meta name="description" content="Описание страницы">
	<meta name="keywords" content="Ключевые слова через запятую">
	<link href="../normalize.css" rel="stylesheet">
	<link href="../admin/Styleformobmen.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="../jquery-3.4.1.min.js"></script>
	<script src="jsadmin/formobmen.js"></script>
</head>
<body>
<div class="fon">
	<header>
		Управление заявками на обмен
	</header>
	<hr>
	<br>
	<div>
		<nav>
			<ul class="menu">
				<li><a href="../admin/importballs.php" class="button15">Управление баллами</a></li>
				<li><a href="../admin/importspisok.php" class="button15">Управление обменом</a></li>
				<li><a href="../admin/mainballs.php" class="button15">Назад</a></li>
				<li><a href="../admin/mainballs.php?do=logout" class="button15">Выйти</a></li>
			</ul>
		</nav>
	</div>
	<div class="importb1">
		<a href="" class="add_message2" id="click_mes_form2">
			<h3 class="heding" title="Жмякни, чтобы скрыть для удобства">Экспорт/просмотр/очистка заявок</h3>
		</a>
		<script type="text/javascript">
			$(document).ready(function(){
				$(".add_message2").click(function(){
					$("#popup_message_form2").slideToggle("slow");
					$(this).toggleClass("active"); return false;
				});
			});
		</script>
		<div class="importb2" id="popup_message_form2" style="display:block;">
			<table class="table_import1">
				<tr>
					<th><b style="color:red">Обязательно к прочтению!</b></th>
				</tr>
			<tr>
				<td>
					<div>
						<b>Открытие и закрытие опроса.</b><br>
						После открытия убедиться что опрос открыт, посмотрев на сайте.<br><br>
						<?php
						include_once '../script/statusform.php'
						?>
						<form method="POST" action="../script/openclickform.php">
							<input class="button14" type="submit" name="open" value="Открыть опрос">
							<input class="button14" type="submit" name="close" value="Закрыть опрос">
						</form>
					</div>
				</td>
			</tr>
				<tr>
					<td>
						<b>Экспорт заявок<b>
								<?php
								include_once '../script/exportformopros.php';
								?>
								<form method="POST" action="../script/exportformopros.php">
									<input type="submit" name="export2" value="CSV Экспорт">
								</form>
					</td>
				</tr>
				<tr>
					<td>
						<b>Очищаем заявки только в случае крайней необходимости.</b><br>
						Предварительно экспортировать и обсудить необходимость очистки.<br>
						<div class="button js-button-campaign"><span>Очистить заявки</span></div>
						<div class="overlay js-overlay-campaign">
							<div class="popup js-popup-campaign">
								<h2>Внимание!</h2>
								Очистить заявки?<br>
								Данные нельзя будет восстановить. Экспортируйте заявки перед очисткой.
								<?php
								include_once '../script/deltablform.php';
								echo '<br><form action="../admin/formobmen.php" method="POST">
						<input class="button10" type="submit" name="truncate2" value="ОЧИСТИТЬ">
						</form>';
								?>
								<div class="close-popup js-close-campaign"></div>
							</div>
						</div>
					</td>
				</tr>
		</table>
	</div>
</div>
	<br>
	<div class="importb1_2">
		<a href="" class="add_message1" id="click_mes_form1">
			<h3 class="heding" title="Жмякни, чтобы скрыть для удобства">Список заявок</h3>
		</a>
		<script type="text/javascript">
			$(document).ready(function(){
				$(".add_message1").click(function(){
					$("#popup_message_form1").slideToggle("slow");
					$(this).toggleClass("active"); return false;
				});
			});
		</script>
		<div class="importb2" id="popup_message_form1" style="display:block;">
			<table class="table_import1">
				<tr>
					<th><b style="color:red">Обязательно к прочтению!</b></th>
				</tr>
				<tr>
					<td>
						<b>Поиск заявок по никнейму</b><br>
						Выводится последние 250 заявок. Сортировка по дате.
						Если таблица пустая - то ник неверный или нет в заявке.<br><br>
						<form id="poiskobmennick" method="POST" action="../script/poiskadminform.php">
							<input id="obmennick" name="names2" type="text" placeholder="Никнейм" size="20"/>
							<input class="button14" type="submit" value="Поиск"/>
						</form>
						<br>
						<div id="resultdiv1"></div>
					</td>
				</tr>
				<tr>
					<td>
						<b>Просмотр всех заявок</b><br>
						Выводится последние 250 заявок. Сортировка по дате.<br><br>
						<form id="poiskall" method="POST" action="../script/poiskadminformall.php">
							<input type="hidden" name="output1" value="all">
							<input class="button14" type="submit" name="output" value="Просмотр">
						</form> <br>
						<div id="resultdiv2"></div>
					</td>
				</tr>
				<tr>
					<td>
						<br>
					</td>
				</tr>
			</table>
</div>
	</div>
	<br>
	<br>
</div>
<script src="../admin/main.js"></script>
</body>
<footer>
	<br>
	author by <a href="http://mwogame.com/forum/user/17146-cyusik-c%d1%8e%d1%81%d0%b8%d0%ba/" target="_blank">Cyusik</a>
	<br>
</footer>
</html>

