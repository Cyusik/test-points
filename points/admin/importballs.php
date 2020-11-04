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
	fwrite($fw, $newdate.' '.$login.' Вошел importballs.php'.' Логин: '. $login."\r\n");
	fclose($fw);
}
else {
	header("Location: ../admin/index.php");
	exit;
}
?>
<!DOCTYPE html>
<html lang="ru" xmlns="http://www.w3.org/1999/html">
<head>
	<meta charset="UTF-8">
	<title>Админка баллы</title>
	<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
	<meta name="description" content="Описание страницы">
	<meta name="keywords" content="Ключевые слова через запятую">
	<link href="../normalize.css" rel="stylesheet">
	<link href="../admin/Styleimportballs.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="../jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="jsadmin/forrmadmin.js"></script>
	<script src="jsadmin/modaldiv.js"></script>
</head>
<body>
<div class="fon">
	<header>
		Управление баллами/общая таблица
	</header>
	<hr>
	<br>
	<div>
		<nav>
			<ul class="menu">
				<li><a href="../" class="button15" target="_blank">Общая таблица баллов</a></li>
				<li><a href="../admin/importspisok.php" class="button15">Управление обменом</a></li>
				<li><a href="../admin/formobmen.php" class="button15">Заявки на призы</a></li>
				<li><a href="../admin/mainballs.php" class="button15">Назад</a></li>
				<li><a href="../admin/importballs.php?do=logout" class="button15">Выйти</a></li>
			</ul>
		</nav>
	</div>
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
						<b>Добавить строку</b><br>
						Перед добавлением новой строки, убедиться что строки с таким никнеймом в таблице нет.
						Добавить строку в таблицу (если истроии нет, оставляем поле пустым. Окно можно расширить, правый нижний угол, клавиша Enter - перевод на новую строку): <br><br>
						<form id="zapvis" method="POST" action="../script/zapisstrokballs.php">
						<table class="table_dark2">
							<tr>
								<th>Никнейм</th>
								<th>Баллы</th>
								<th>История</th>
							</tr>
								<tr>
									<td>
										<input class="input" id="zapisnick" name="nickname" type="text" size="20"/>
									</td>
									<td>
										<input class="input" id="zapisball" name="balls" type="text" size="20"/>
									</td>
									<td>
										<textarea class="textarea" id="history" rows="1" cols="50" name="history"></textarea>
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
						<b>Редактирование/удаление</b><br>
						Можно редактировать одновременно никнейм, баллы и историю.<br><br>
						<form id="poisknick" method="GET" action="importballs.php">
						<table class="table_dark2" style="width:250px;">
							<tr>
								<th colspan="2">
									Найти игрока
								</th>
							</tr>
							<tr>
								<td>
									<input class="input" id="nickpoisk" name="names" type="text" placeholder="Введите ник" size="30"/>
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
						if (isset($_GET['names'])) {
							$names = $_GET['names'];
							if($names == false) {
								echo "<table class='table_dark2'>
												<tr>
													<th>Ошибка</th>
												</tr>
												<tr>
													<td>Введите никнейм</td>
												</tr>
												</table>";
							}
							else {
								$file_login = "../logfiles/points_log.log";
								$fw = fopen($file_login, "a+");
								$date = date('Y-m-d h:i:s');
								$newdate = date('Y-m-d h:i:s A', strtotime($date));
								mysqli_query($link, "SET NAMES 'utf8'");
								$query = "SELECT * FROM tablballs WHERE nickname='$names'";
								$result = mysqli_query($link, $query) or die(fwrite($fw, $newdate.' Ошибка importballs.php(146): '.mysqli_error($link)."\n"));
								if($result) {
									$rows = mysqli_num_rows($result);
									if ($rows > 0) {
										echo "<table class='table_dark2'><tr>
									<th style='padding:0; width:0'></th>
									<th style='width:30px'>id</th>
									<th style='width:150px'>Никнейм</th>
									<th style='width:30px'>Баллы</th>
									<th style='width:0'>История обмена баллов</th>
									<th style='width:150px'>Действие</th>
									</tr>";
						for($i = 0; $i < $rows; ++$i) {
						$row = mysqli_fetch_row($result);
							$id_button_save = 'save_click1'.$i;
							$id_button_delet = 'delet_click1'.$i;
							$div_result = 'result_div1'.$i;
							$hideME = 'hide_Me1'.$i;
							$id_form = 'form'.$i;
							$id_tr = 'tr1'.$i;
							fwrite($fw, $newdate.' '.$login.' Поиск ника=>'.$names.' id=>'.$row[0].' true'."\r\n");
							fwrite($fw, $newdate.' '.$login.' Запись баллов=>'.$names.' id=>'.$row[0].' nick=>'.$row[1].' points=>'.$row[2].' true'."\r\n");
						echo "<tr id='$id_tr'>";
							echo "<form id='$id_form' name='form' method='POST' action=''>";
							echo "<td style='padding:0; width:0'><div id='$hideME' class='modal_div_interior' style='display:none'>
								<div id='$div_result' class='modal_div_external' ></div>
							</div></td>";
							echo nl2br("<td style='width:30px'><input id='id_test' class='input' name='id_user' value='$row[0]' readonly='readonly'></td>");
							echo nl2br("<td style='width:150px'><input id='nick_test' class='input' name='nick_user' value='$row[1]'></td>");
							echo nl2br("<td style='width:30px'><input id='point_test' class='input' name='point_user' value='$row[2]'></td>");
							echo "<td style='width:0'><textarea id='history_test' class='textarea' name='history_user'>$row[3]</textarea>";
							echo "<td style='width: 150px;'>";
							echo "<button id='$id_button_save' type='submit' class='button10'>Сохранить</button>";
							?>
							<script>
								$(document).ready(function() {
									$('#<?=$id_button_save?>').click(function() {
										$('#<?=$hideME?>').fadeIn(800);
										function Out() {
											$('#<?=$hideME?>').fadeOut(800);
										}
										setTimeout(Out, 5000);
										$.ajax({
											type: "POST",
											url: "../../points/script/save_changes.php",
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
								$(document).ready(function() {
									$('#<?=$id_button_delet?>').click(function () {
										$(this).attr('disabled', true);
										$('#<?=$hideME?>').fadeIn(800);
										$.ajax({
											type: "POST",
											url: "../../points/script/delet_user.php",
											data: $("#<?=$id_form?>").serialize(),
											success: function (result) {
												$().html(result);
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
							echo "</form></td>";
						echo "</tr>";}
						echo "</table><br>";
								} else {
										fwrite($fw, $newdate.' '.$login.' Поиск ника=>'.$names.' false'."\r\n");
										echo "<table class='table_dark2'>
												<tr>
													<th>Ошибка</th>
												</tr>
												<tr>
													<td>Такого никнейма нет в таблице</td>
												</tr>
												</table>";
									}
								}
								fclose($fw);
							}
						}
						?>
					</td>
				</tr>
			</table>
		</div>
	</div>
		<div class="importb1">
			<!--<a href="" class="add_message1" id="click_mes_form1">-->
				<h3 class="heding" title="Жмякни, чтобы скрыть для удобства">Импорт таблицы баллов</h3>
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
						<td><form id="updatedates" method="post" action="../script/date.php">
							<table class="table_dark2" style="width:auto">
								<tr>
								<?php
								$query = "SELECT * FROM formobmen WHERE id=2";
								$result = mysqli_query($link, $query) or die('Ошибка importballs.php(277): '.mysqli_error($link));
								$row = mysqli_fetch_row($result);
								$dates = $row [1];
								echo "<th>Дата последнего обновления:</th><th>$dates</th>";
								$result->free();
								?>
								</tr>
								<tr>
									<td><input class="input" id="update" type="text" name="update_date" placeholder="дд.мм.гггг"></td>
									<td><div class="block_button" style="margin-top:0px">
									<button class="button10" type="submit">Обновить дату</button>
									</div></td>
								</tr>
								<tr>
									<td colspan="2">
									<div id="resultdate"></div>
									</td>
								</tr>
							</table>
							</form>
						</td>
					</tr>
					<tr>
						<td><b>Подсчет баллов:</b></td>
					</tr>
					<tr>
						<td>
							<div class="upload_count">
								<form method="POST" action="../script/count_points.php" id="count_points">
									<input type="file" name="countfile" id="countfile" class="countfile">
									<label id="countfileON" for="countfile" class="button10">Выберите файл</label>
									<button id="buttonfile" class="button10" type="submit">Отправить</button>
									<img src="../object1/load.gif" alt="load_gif" class="load_gif" id="loadgif" style="display:none">
								</form>
							</div>
							<div id="uploadfile"></div>
							<div id="resultcount"></div>
						</td>
					</tr>
					<tr>
						<td>Перед обновлением таблицы в базе необходимо сделать следующее:
							<br>
							<br>1. Экспортировать таблицу (кнопка экспорта). И считаем балллы.
							<br>2. Очистить таблицу (ОБЯЗАТЕЛЬНО! Иначе при импорте строки добавятся к уже существуюущим строкам в базе, а не заменят их.)
							<br>3. После уже можно импортировать с уже посчитанными баллами (только csv! файлы. Скрипт конечно не станет обрабатывать файлы с другим расширением, например txt, но все же не стоит рисковать )
							<br>4. Чем больше строк - тем дольше импорт (НЕ обновлять страницу, пока скрипт работает!). По завершению загрузки выйдет сообщение, что загрузка завершена. Зайти на сайт с баллами (менюшка слева) и убедиться что все строки есть (пролистать в самый конец).
						</td>
					</tr>
					<tr>
						<td>
							<b>Экспорт таблицы</b>
							<?php
							include_once '../script/exporttablballs.php';
							?>
							<form method="POST" action="../script/exporttablballs.php">
								<button class="button10" type="submit" name="export">CVS Экспорт</button>
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
							<br><form id="delpoints"  action="../script/deltablballs.php" method="POST">
										<input class="button10" type="hidden" name="truncate" value="1">
						<input class="button10" type="submit" value="ОЧИСТИТЬ">
						</form>
									<div class="close-popup js-close-campaign"></div>
									<div id="resultdiv11"></div>
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<?php
							$query = ("SELECT COUNT(*) as count FROM tablballs WHERE id > 0");
							$result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));
							if($result){
								$strokballs = $result->fetch_assoc();
								$nb = $strokballs['count'];
								echo 'Строк в таблице баллов: <b style="color:green">'.$nb.'</b>';
								echo '<br><br>';
							}
							include_once '../script/importtabl.php';
							?>
							<b>Выбираем файл импорта:</b>
							<div class="popup_import">
								<form method="post" action="" enctype="multipart/form-data" id="import_form">
									<input type="file" name="importfile" id="importfile">
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

