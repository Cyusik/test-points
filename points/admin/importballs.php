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
	<link rel="shortcut icon" href="http://mwogame.com/forum/favicon.ico" type="image/x-icon">
	<meta name="description" content="Описание страницы">
	<meta name="keywords" content="Ключевые слова через запятую">
	<link href="../css/normalize.css" rel="stylesheet">
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
			<h3 class="heding" title="Жмякни, чтобы скрыть для удобства">Добавить/удалить/редактировать строки</h3>
		<div class="importb2" id="popup_message_form2" style="display:block;">
			<table class="table_import1">
				<tr>
					<td>
						<b>Добавить строку</b><br>
						Перед добавлением новой строки, убедиться что строки с таким никнеймом в таблице нет.
						Добавить строку в таблицу (если истроии нет, оставляем поле пустым. Окно можно расширить, правый нижний угол, клавиша Enter - перевод на новую строку): <br><br>
						<form id="zapvis" method="POST" action="../script/zapisstrokballs.php">
						<table class="table_dark2 widthIg">
							<tr>
								<th>Никнейм</th>
								<th>Баллы</th>
								<th>История</th>
								<th>Игнор</th>
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
									<td>
										<input class="input" id="ignory" name="ignory" type="text" size="20" value="0"/>
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
							$names = trim($_GET['names']);
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
									<th style='width:5%'>id</th>
									<th style='width:30%'>Никнейм</th>
									<th style='width:10%'>Баллы</th>
									<th style='width:50%'>История обмена баллов</th>
									<th style='width:5%'>Игнор</th>
								<!--	<th style='width:150px'>Действие</th> -->
									</tr>";
						for($i = 0; $i < $rows; ++$i) {
						$row = mysqli_fetch_row($result);
							$id_button_save = 'save_click1'.$i;
							$id_button_delet = 'delet_click1'.$i;
							$div_result = 'result_div1'.$i;
							$hideME = 'hide_Me1'.$i;
							$id_form = 'form'.$i;
							$id_tr = 'tr1'.$i;
						//	$id_log1 = 'log1'.$i;
						//	$id_log2 = 'log2'.$i;
						//	$id_log3 = 'log3'.$i;
							fwrite($fw, $newdate.' '.$login.' Поиск ника=>'.$names.' id=>'.$row[0].' true'."\r\n");
							fwrite($fw, $newdate.' '.$login.' Запись баллов=>'.$names.' id=>'.$row[0].' nick=>'.$row[1].' points=>'.$row[2].' true'."\r\n");
						echo "<tr id='$id_tr'>";
							echo "<form id='$id_form' name='form' method='POST' action=''>";
							echo "<td style='padding:0; width:0'><div id='$hideME' class='modal_div_interior' style='display:none'>
								<div id='$div_result' class='modal_div_external' ></div>
							</div></td>";
							echo nl2br("<td style='width:5%'><input id='id_test' class='input' name='id_user' value='$row[0]' readonly='readonly'></td>");
							echo nl2br("<td style='width:30%'><input id='nick_test' class='input' name='nick_user' value='$row[1]'></td>");
							echo nl2br("<td style='width:10%'><input id='point_test' class='input' name='point_user' value='$row[2]'></td>");
							echo "<td style='width:50%'><textarea id='history_test' class='textarea' name='history_user'>$row[3]</textarea>";
							echo nl2br("<td style='width:5%'><input id='ignor_test' class='input' name='ignor_user' value='$row[4]'></td>");
							echo "</tr>
								  <tr>
								  		<th style='padding:0; width:0'></th>
								  		<th colspan='5'></th>
								  </tr>
								  <tr id='$id_tr'>
								  		<td style='padding:0; width:0'></td>
								  		<td>login_one</td>
								  		<td colspan='2'><input class='input' id='login_one' name='login_one' value='$row[5]'></td>
								  		<td>login_two</td>
								  		<td colspan='2'><input class='input' id='login_two' name='login_two' value='$row[6]'></td>
								  		<td>login_three</td>
								  		<td colspan='2'><input class='input' id='login_three' name='login_three' value='$row[7]'></td>";
							echo "<td rowspan='3' style='text-align:right'>";
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
							echo "<span id='$id_button_delet' class='button10'>Удалить</span>";
							?>
							<script>
								$(document).ready(function() {
									$('#<?=$id_button_delet?>').click(function () {
										var nick = $('#nick_test').val();
										$('.mainwindow').fadeIn();
										$('.mainwindow').addClass('disabled');
										$('#heading').html('Внимание');
										$('#spanwidow').html('Удалить строку ' + nick + ' из БД ?');
										$('#closewidow').click(function() {
											$('.mainwindow').fadeOut();
											$('#heading').html('');
											$('#spanwidow').html('');
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
										$('#canceling').click(function() {
											$('.mainwindow').fadeOut();
											$('#heading').html('');
											$('#spanwidow').html('');
										});
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
								<div>
									<?php
									$ignore_check = "SELECT nickname, exclude FROM tablballs WHERE exclude = '1'";
									$result = mysqli_query($link, $ignore_check) or die ('Error: '.mysqli_error($link));
									$counts = mysqli_num_rows($result);
									if ($counts > 0) {
										$list = array();
										for($q = 0; $q < $counts; ++$q) {
											$list_ignor = mysqli_fetch_row($result);
											$list[] = $list_ignor[0];
										}
										echo '<div class="input listIg">Начисляется всем, кроме: '.implode("; ", $list).'</div><br>';
									} else {
										echo '<div class="input listIg">Начисляется всем игрокам</div><br>';
									}
									?>
								</div>
								<form method="POST" action="../script/count_points.php" id="count_points">
									<input type="file" name="countfile" id="countfile" class="countfile">
									<label id="countfileON" for="countfile" class="button10">Выберите файл</label>
									<button id="buttonfile" class="button10" type="submit">Отправить</button>
									<img src="/points/admin/load.gif" alt="load_gif" class="load_gif" id="loadgif" style="display:none">
								</form>
							</div>
							<div id="uploadfile"></div>
							<div id="resultcount"></div>
						</td>
					</tr>
					<tr>
						<td>
							<b>Просмотр начислений в игнор листе (limit 100)</b><br><br>
							<form id="poiskall" method="GET" action="">
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
											<button class="button10" type="submit" name="output">Просмотр</button>
										</td>
									</tr>
								</table>
							</form><br>
							<?php
							echo "<div class='mainwindow'>
					<div class='openwindow'>
						<h3 id='heading'></h3>
						<span id='spanwidow'></span><br><br>
						<div class='button10' id='closewidow'>Удалить</div>
						<div class='button10' id='canceling'>Отмена</div>
						</div>
					    </div>";
							if(!empty($_GET['monthFromAll']) && !empty($_GET['monthToAll'])) {
								$monthFromAll = trim(mysqli_real_escape_string($link, $_GET['monthFromAll']));
								$monthToAll = trim(mysqli_real_escape_string($link, $_GET['monthToAll']));
								if($monthFromAll <= $monthToAll) {
									$datesfrom = $monthFromAll.' 00:00:00';
									$datesbefore = $monthToAll.' 23:59:59';
									$file_login = "../logfiles/points_log.log";
									$fw = fopen($file_login, "a+");
									$date = date('Y-m-d h:i:s');
									$newdate = date('Y-m-d h:i:s A', strtotime($date));
									fwrite($fw, $newdate.' '.$login.' Вывод истории игнор листа. Период '.$datesfrom.' - '.$datesbefore."\r\n");
									mysqli_query($link, "SET NAMES 'utf8'");
									$get_ignory = "SELECT * FROM ignoresstory WHERE date BETWEEN '$datesfrom' AND '$datesbefore' ORDER BY `date` DESC LIMIT 100";
									$result = mysqli_query($link, $get_ignory) or die(fwrite($fw, $newdate.' Ошибка importballs.php (374): '.mysqli_error($link)."\n"));
									$rows = mysqli_num_rows($result);// количество полученных строк
									if ($rows > 0) {
										fwrite($fw, $newdate.' result=>true'."\r\n");
										echo "<div id='allapplications'>";
										echo "<table class='table_dark2'><tr>
												<th style='padding:0; width:0'></th>
												<th style='width:10%'>id</th>
												<th style='width:21%'>Дата</th>
												<th style='width:30%'>Никнейм</th>
												<th style='width:18%'>Баллы</th>
												<th style='width:21%'>Действие</th></tr>";
										for($i = 0; $i < $rows; ++$i) {
											$row = mysqli_fetch_row($result);
											$id_ignore_tr = 'ignore_tr'.$i;
											$id_button_accrued = 'save_accrued'.$i;
											$id_button_deletIg = 'delet_Ig'.$i;
											$div_result_ignore = 'result_div1_Ig'.$i;
											$hideME = 'hide_Me1'.$i;
											$id_form_ignore = 'formIg'.$i;
											$nick_ignore = 'nick_ignore'.$i;
											echo "<tr id='$id_ignore_tr'>";
											echo "<form id='$id_form_ignore' name='form' method='POST' action=''>";
											echo "<td style='padding:0; width:0'><div id='$hideME' class='modal_div_interior' style='display:none'>
													<div id='$div_result_ignore' class='modal_div_external' ></div>
													</div></td>";
												echo "<td style='width:10%'><input id='' class='input disable' type='text' name='id_ignore' value='$row[0]' readonly></td>
													  <td style='width:21%'><input id='' class='input disable' type='text' name='date_ignore' value='$row[1]' readonly></td>
													  <td style='width:30%'><input id='$nick_ignore' class='input disable' type='text' name='nick_ignore' value='$row[2]' readonly></td>
													  <td style='width:18%'><input id='' class='input disable' type='text' name='points_ignore' value='$row[3]' readonly></td>";
							echo "<td style='width:21%'><button id='$id_button_accrued' type='submit' class='button10'>Начислить</button>";
							?>
							<script>
								$(document).ready(function() {
									if (<?=$row[4]?> === 1) {
										$('#<?=$id_button_accrued?>').addClass('butnone');
										$('#<?=$id_button_accrued?>').prop("disabled", true);
									} else
									{
										$('#<?=$id_button_accrued?>').click(function () {
											$('#<?=$hideME?>').fadeIn(800);
											function Out() {
												$('#<?=$hideME?>').fadeOut(800);
											}
											setTimeout(Out, 5000);
											$.ajax({
												type: "POST",
												url: "../../points/script/accrued_ignore.php",
												data: $("#<?=$id_form_ignore?>").serialize(),
												success: function (result) {
													$("#<?=$div_result_ignore?>").html(result);
													$('#<?=$id_button_accrued?>').addClass('butnone');
													$('#<?=$id_button_accrued?>').prop("disabled", true);
												},
											});
											return false;
										});
									}
									});
							</script>
							<?php
							echo "<span id='$id_button_deletIg' class='button10'>Удалить</span>";
							?>
							<script>
								$(document).ready(function() {
									$('#<?=$id_button_deletIg?>').click(function () {
										$('.mainwindow').fadeIn();
										$('.mainwindow').addClass('disabled');
										$('#heading').html('Внимание');
										$('#spanwidow').html('Удалить строку ' + $('#<?=$nick_ignore?>').val() + ' из БД ?');
										$('#closewidow').click(function() {
											$('.mainwindow').fadeOut();
											$('#heading').html('');
											$('#spanwidow').html('');
											$(this).attr('disabled', true);
											$('#<?=$hideME?>').fadeIn(800);
											$.ajax({
												type: "POST",
												url: "../../points/script/delet_listIg.php",
												data: $("#<?=$id_form_ignore?>").serialize(),
												success: function (result) {
													$().html(result);
												},
											});
											$("#<?=$id_ignore_tr?>").empty();
											$("#<?=$id_ignore_tr?>").stop().animate({
													height: "0px",
													opacity: 0,
												}, 800, function() {
													$(this).remove();
												}
											);
											return false;
										});
										$('#canceling').click(function() {
											$('.mainwindow').fadeOut();
											$('#heading').html('');
											$('#spanwidow').html('');
										});
									});
								});
							</script>
										<?php	echo "</td></form></tr>";
										}
										echo "</table>";
									} else {
										echo "<table class='table_dark2'>
										<tr>
											<th>Ошибка</th>
										</tr>
										<tr>
											<td>За выбранный период ничего нет</td>
										</tr></table>";
									} fclose($fw);
								} else {
									echo "<table class='table_dark2'>
										<tr>
											<th>Ошибка</th>
										</tr>
										<tr>
											<td>Дата ОТ не может быть больше ДО</td>
										</tr></table>";
								}
							}
							?>
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