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
	<link href="../admin/Styleimportspisok.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="../jquery-3.4.1.min.js"></script>
	<script src="jsadmin/formspisok.js"></script>
	<script src="jsadmin/modaldiv.js"></script>
</head>
<body>
<div class="fon">
	<header>
		Управление итогами обмена на призы
	</header>
	<hr>
	<br>
	<div>
		<nav>
			<ul class="menu">
				<li><a href="../results.php" class="button15" target="_blank">Таблица итогов обмена</a></li>
				<li><a href="../admin/importballs.php" class="button15">Управление баллами</a></li>
				<li><a href="../admin/formobmen.php" class="button15">Заявки на призы</a></li>
				<li><a href="../admin/mainballs.php" class="button15">Назад</a></li>
				<li><a href="../admin/importspisok.php?do=logout" class="button15">Выйти</a></li>
			</ul>
		</nav>
	</div>
	<br>
	<div class="importb1">
		<!--<a href="" class="add_message2" id="click_mes_form2">-->
			<h3 class="heding" title="Жмякни, чтобы скрыть для удобства">Добавить/удалить/редактировать строки</h3>
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
						<b>Добавить строку</b><br><br>
						<form id="zapvis" method="POST" action="../script/zapisstrokaobmen.php">
							<table class="table_dark2">
								<tr>
									<th>Дата и время</th>
									<th>Никнейм</th>
									<th>Выдача</th>
									<th>Причина</th>
								</tr>
								<tr>
									<td>
										<input style="height:auto" class="input" id="newdate" name="dates" type="datetime-local" step="1" placeholder="дд.мм.гг чч:мм"/>
									</td>
									<td>
										<input class="input" id="newnick" name="nickname" type="text"/>
									</td>
									<td>
										<select form="zapvis" class="input" id="newitog" name="itog" type="text">
											<option value="" selected="selected"></option>
											<option>Выдано</option>
											<option>Не выдано</option>
										</select>
									</td>
									<td>
										<input class="input" id="newprichina" name="prichina" type="text"/>
									</td>
								</tr>
							</table>
							<div id="hideMe" class="modal_div_interior">
								<div id="resultdiv1" class="modal_div_external"></div>
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
						<b>Поиск строк в итогах выдачи призов</b><br>
						Можно редактировать Никнейм, выдачу и причину<br><br>
						<form id="" method="GET" action="importspisok.php">
							<table class="table_dark2" style="width:250px;">
								<tr>
									<th colspan="3">
										Найти игрока
									</th>
								</tr>
								<tr>
									<td>
										<input style="height:auto; width:150px" class="input" name="month" type="month" min="2000-01" max="2099-12" placeholder="Выбери дату">
									</td>
									<td>
										<input style="width:150px" class="input" id="names1" name="names" type="text" placeholder="Введите ник" size="20"/>
									</td>
									<td>
										<div class="block_button" style="margin-top:0px">
											<button class="button10" >Найти</button>
										</div>
									</td>
								</tr>
							</table>
						</form>
						<?php
						if (isset($_GET['names']) && isset($_GET ['month'])) {
							$month = $_GET['month'];
							$names = $_GET['names'];
							if($names == false) {
								if($month == false) {
									echo "<table class='table_dark2'>
												<tr>
													<th>Ошибка</th>
												</tr>
												<tr>
													<td>Введите дату</td>
												</tr>
												</table>"; } else {
								echo "<table class='table_dark2'>
												<tr>
													<th>Ошибка</th>
												</tr>
												<tr>
													<td>Введите никнейм</td>
												</tr>
												</table>";
							}
							} else {
								mysqli_query($link, "SET NAMES 'utf8'");
								$query = "SELECT * FROM itogobmen WHERE dates LIKE'$month%' AND nickname='$names' ORDER by dates DESC LIMIT 50";
								$result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));
								if($result) {
						$rows = mysqli_num_rows($result);
						if($rows > 0) {
						echo "<table class='table_dark2'><tr>
											<th style='padding:0; width:0'></th>
											<th style='width:30px'>id</th>
											<th style='width:140px'>Дата и время</th>
											<th>Никнейм</th>
											<th style='width:100px'>Выдача</th>
											<th style='width:225px'>Причина</th>
											<th style='width:215px'>Действие</th>
										</tr>";
						for($i = 0; $i < $rows; ++$i) {
						$row = mysqli_fetch_row($result);
						$id_button_save = 'save1'.$i;
						$id_button_delet = 'delet1'.$i;
						$id_form = 'form1'.$i;
						$div_result = 'result_div1'.$i;
						$hideME = 'hide_Me1'.$i;
							$id_tr = 'tr1'.$i;
						echo "<tr id='$id_tr'>";
						echo "<form id='$id_form' name='form' method='POST' action=''>";
						echo "<td style='padding:0; width:0'><div id='$hideME' class='modal_div_interior' style='display:none'>
				<div id='$div_result' class='modal_div_external' ></div>
				</div></td>";
						echo nl2br("<td style='width:30px'><input class='input' name='id_results' value='$row[0]' readonly='readonly'></td>");
						echo nl2br("<td style='width:140px'><input class='input' name='dates_results' value='$row[1]' readonly='readonly'></td>");
						echo nl2br("<td><input class='input' name='nick_results' value='$row[2]'></td>");
						echo nl2br("<td style='width:100px'><input class='input' name='result_results' value='$row[3]'></td>");
						echo nl2br("<td style='width:225px'><input class='input' name='cause_results' value='$row[4]'></td>");
						echo "<td style='width:215px'>";
						echo "<button id='$id_button_save' type='submit' class='button10'>Сохранить</button>";
						?>
						<script>
							$(document).ready(function () {
								$('#<?=$id_button_save?>').click(function () {
									$('#<?=$hideME?>').fadeIn(800);

									function Out() {
										$('#<?=$hideME?>').fadeOut(800);
									}

									setTimeout(Out, 5000);
									$.ajax({
										type: "POST",
										url: "../../points/script/save_results.php",
										data: $("#<?=$id_form?>").serialize(),
										success: function (result) {
											$("#<?=$div_result?>").html(result);
										},
									});
									return false;
								});
							});
						</script>
						<?php
						echo "<button id='$id_button_delet' class='button10' type='submit'>Удалить</button>";
						?>
						<script>
							$(document).ready(function () {
								$('#<?=$id_button_delet?>').click(function () {
									$(this).attr('disabled', true);
									$('#<?=$hideME?>').fadeIn(800);
									$.ajax({
										type: "POST",
										url: "../../points/script/delet_results.php",
										data: $("#<?=$id_form?>").serialize(),
										success: function (result) {
											$("#<?=$div_result?>").html(result);
										},
									});
									$("#<?=$id_tr?>").empty();
									$("#<?=$id_tr?>").stop().animate({
											height: "0px",
											opacity: 0,
										}, 800, function() {
											$(this).remove();
										}
									);
									return false;
								});
							});
						</script>
						<?php
						echo "</form></td></tr>";
						} echo "</table>";
						} else {
							echo "<table class='table_dark2'>
												<tr>
													<th>Ошибка</th>
												</tr>
												<tr>
													<td>За этот период нет записей с таким никнеймом</td>
												</tr>
												</table>";
						}
								}
							}
						}
						?>
					</td>				</tr>
			</table>
		</div>
	</div>
	<br>
	<div class="importb1">
		<!--<a href="" class="add_message1" id="click_mes_form1">-->
			<h3 class="heding" title="Жмякни, чтобы скрыть для удобства">Импорт таблицы обмена</h3>
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
					<td>Перед обновлением таблицы в базе необходимо сделать следующее:
						<br>
						<br>1. Каждый новый месяц экспортируем таблицу, сохраняем csv файл и очищаем таблицу.
						<br>2. Очистить таблицу (Иначе при импорте строки добавятся к уже существуюущим строкам в базе, а не заменят их.)
						<br>3. После уже можно импортировать с уже посчитанными баллами (только csv! файлы. Скрипт конечно не станет обрабатывать файлы с другим расширением, например txt, но все же не стоит рисковать )
						<br>4. Чем больше строк - тем дольше импорт (НЕ обновлять страницу, пока скрипт работает!). По завершению загрузки выйдет сообщение, что загрузка завершена. Зайти на сайт с баллами (менюшка слева) и убедиться что все строки есть (пролистать в самый конец).
					</td>
				</tr>
				<tr>
					<td>
						Экспорт таблицы
						<?php
						include_once '../script/exporttablspisok.php';
						?>
						<form method="POST" action="../script/exporttablspisok.php">
							<input class="button10" type="submit" name="export1" value="CSV Export">
						</form>
					</td>
				</tr>
				<tr>
					<td>
						<div class="button js-button-campaign"><span>Очистить таблицу</span></div>
						<div class="overlay js-overlay-campaign">
							<div class="popup js-popup-campaign">
								<h2>Внимание!</h2>
								Очистить таблицу?<br>
								Данные нельзя будет восстановить. Экспортируйте таблицу перед очисткой.
								<br><form id="delresults" action="../script/deltablspisok.php" method="POST">
									<input class="button10" type="hidden" name="truncate1" value="1">
									<input class="button10" type="submit" value="ОЧИСТИТЬ">
								</form>
								<div class="close-popup js-close-campaign"></div>
								<div id="resultdiv10"></div>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<br>
						Выбираем файл импорта:
						<?php
						include_once '../script/importspisok.php';
						?>
						<div class="popup_import">
							<form method="post" action="" enctype="multipart/form-data" id="import_form">
								<input type='file' name="importfile" id="importfile">
								<input class="button10" type="submit" id="but_import" name="but_import" value="Импорт">
							</form>
						</div>
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