<?php
include_once '../script/login.php';
session_start();
if($_GET['do'] == 'logout'){
	unset($_SESSION['login']);
	session_destroy();
}
if($_SESSION['login']){
	$login = $_SESSION['login'];
	$file_login = "../logfiles/login_to_admin.log";
	$fw = fopen($file_login, "a+");
	$date = date('Y-m-d h:i:s');
	$newdate = date('Y-m-d h:i:s A', strtotime($date));
	fwrite($fw, $newdate.' '.$login.' Вошел formobmen.php'.' Логин: '. $login."\r\n");
	fclose($fw);
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
	<script src="jsadmin/modaldiv.js"></script>
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
		<!--<a href="" class="add_message2" id="click_mes_form2">-->
			<h3 class="heding" title="Жмякни, чтобы скрыть для удобства">Экспорт/просмотр/очистка заявок</h3>
		<!--</a>-->
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
				<td>
					<b>Добавить заявку</b><br>
					Дата добавления фиксируется автоматически. Призы и баллы писать вручную. Баллы - пишем необходимое количество баллов для обмена<br><br>
					<form id="addexchange" method="POST" action="../script/add_string_exchange.php">
						<table class="table_dark2">
							<tr>
								<th style="width:20%;">Никнейм</th>
								<th style="width:25%;">Логин</th>
								<th style="width:40%;">Призы</th>
								<th style="width:15%;">Баллы</th>
							</tr>
							<tr>
								<td style="width:20%;"><input type="text" name="nicknames" id="nicknames" class="input" required></td>
								<td style="width:30%;"><input type="text" name="login" id="login" class="input" required></td>
								<td style="width:40%;"><textarea type="text" rows="1" cols="50" name="prizes" id="prizes" class="textarea" required></textarea></td>
								<td style="width:10%;"><input type="number" class="input" name="points" id="points" required></td>
							</tr>
						</table>
						<div id="hideMe" class="modal_div_interior">
							<div id="resultdiv5" class="modal_div_external"></div>
						</div>
						<br>
						<div class="block_button">
							<button id="addclick" class="button10" type="submit">Добавить</button>
						</div>
					</form>
				</td>
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
							<input class="button10" type="submit" name="open" value="Открыть опрос">
							<input class="button10" type="submit" name="close" value="Закрыть опрос">
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
									<input class="button10" type="submit" name="export2" value="CSV Экспорт">
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
								<br><form id="delexchange" action="../script/deltablform.php" method="POST">
									<input class="button10" type="hidden" name="truncate2" value="1">
									<input class="button10" type="submit" value="ОЧИСТИТЬ">
								</form>
								<div class="close-popup js-close-campaign"></div>
								<div id="resultdiv10"></div>
							</div>
						</div>
					</td>
				</tr>
		</table>
	</div>
</div>
	<br>
	<div class="importb1">
		<!--<a href="" class="add_message1" id="click_mes_form1">-->
			<h3 class="heding" title="Жмякни, чтобы скрыть для удобства">Список заявок</h3>
		<!--</a>-->
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
					<td>
						<b>Поиск заявок по никнейму</b><br>
						Лимит 500 заявок. Сортировка по дате.<br><br>
						<form id="poiskobmennick" method="POST" action="../script/poiskadminform.php">
							<table class="table_dark2" style="width:250px">
								<tr>
									<th>От (дата)</th>
									<th>До (дата)</th>
									<th colspan="2">Найти заявки</th>
								</tr>
								<tr>
									<td>
										<input style="height:auto; width:150px" class="input" name="monthFrom" type="date" min="2000-01" max="2099-12" placeholder="Выбери дату">
									</td>
									<td>
										<input style="height:auto; width:150px" class="input" name="monthTo" type="date" min="2000-01" max="2099-12" placeholder="Выбери дату">
									</td>
									<td>
										<input style="width:150px" placeholder="Введите ник" class="input" id="obmennick" name="names2" type="text" size="20"/>
									</td>
									<td>
										<input class="button10" type="submit" value="Поиск"/>
									</td>
								</tr>
							</table>
						</form>
						<br>
						<div id="resultdiv1"></div>
					</td>
				</tr>
				<tr>
					<td>
						<b>Просмотр всех заявок</b><br>
						Лимит 500 заявок. Сортировка по дате.<br><br>
						<form id="poiskall" method="POST" action="../script/poiskadminformall.php">
							<table class="table_dark2" style="width:250px">
								<tr>
									<th>От (дата)</th>
									<th>До (дата)</th>
									<th></th>
								</tr>
								<tr>
									<td>
										<input style="height:auto; width:150px" class="input" name="monthFromAll" type="date" min="2000-01" max="2099-12">
									</td>
									<td>
										<input style="height:auto; width:150px" class="input" name="monthToAll" type="date" min="2000-01" max="2099-12" placeholder="Выбери дату">
									</td>
									<td>
										<input type="hidden" name="output1" value="all">
										<input class="button10" type="submit" name="output" value="Просмотр">
									</td>
								</tr>
							</table>
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

