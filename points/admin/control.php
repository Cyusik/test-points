<?php
include_once '../script/login.php';
session_start();
if($_GET['do'] == 'logout'){
	unset($_SESSION['login']);
	unset($_SESSION['role']);
	session_destroy();
}
if($_SESSION['login'] && $_SESSION['role'] == 1){
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
	<link href="../admin/Stylecontrol.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="text/javascript" src="../jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="jsadmin/control.js"></script>
	<script type="text/javascript" src="jsadmin/modaldiv.js"></script>
</head>
<body>
<div class="fon">
	<header>
		Управление
	</header>
	<hr>
	<br>
	<div>
		<nav>
			<ul class="menu">
				<li><a href="../admin/mainballs.php" class="button15">Назад</a></li>
				<li><a href="../admin/importballs.php?do=logout" class="button15">Выйти</a></li>
			</ul>
		</nav>
	</div>
	<div class="importb1">
		<h3>Управление</h3>
			<table class="table_import1">
				<tr>
					<td>
						<b>Запрос списка пользователей</b><br>
						Просмотр пользователей, дать права к управлению, где 0 = пользователь, 1 = админ: <br><br>
						<a href="" class="add_message2" id="click_mes_form2">
							<button class="button10">Показать/Скрыть</button>
						</a>
						<script type="text/javascript">
							$(document).ready(function(){
								$(".add_message2").click(function(){
									$("#popup_message_form2").slideToggle("slow");
									$(this).toggleClass("active"); return false;
								});
							});
						</script>
						<div class="importb2" id="popup_message_form2" style="display:none;">
							<br><br>
							<?php
								include_once '../script/connect.php';
								mysqli_query($link, "SET NAMES 'utf8'");
								$query = "SELECT * FROM users WHERE id > 0";
								$result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));
							if($result) {
								$rows = mysqli_num_rows($result);
								if($rows > 0) {
									echo "<table class='table_dark2'><tr>
									<th style='padding:0; width:0'></th>
									<th style='width:30px'>id</th>
									<th style='width:200px'>Логин</th>
									<th style='width:250px'>Новый пароль</th>
									<th style='width:0'>Приоритет</th>
									<th style='width: 150px;'>Действие</th>
									</tr>";
									for($i = 0; $i < $rows; ++$i) {
										$row = mysqli_fetch_row($result);
										$id_button_save = 'save_click1'.$i;
										$id_button_delet = 'delet_click1'.$i;
										$div_result = 'result_div1'.$i;
										$hideME = 'hide_Me1'.$i;
										$id_form = 'form1'.$i;
										$id_tr = 'tr1'.$i;
										echo "<tr id='$id_tr'>";
										echo "<form id='$id_form' name='form' method='POST' action=''>";
										echo "<td style='padding:0; width:0'><div id='$hideME' class='modal_div_interior' style='display:none'>
								<div id='$div_result' class='modal_div_external'></div>
							</div></td>";
										echo nl2br("<td style='width:30px'><input id='id_test' class='input' name='id_user' value='$row[0]' readonly='readonly'></td>");
										echo nl2br("<td style='width:150px'><input id='login_test' class='input' name='login_user' value='$row[1]' readonly='readonly'></td>");
										echo nl2br("<td style='width:30px'><input id='password_test' class='input' name='password_user' placeholder='введите пароль'></td>");
										echo nl2br("<td style='width:0'><input id='priority_user' name='priority_user' class='input' value='$row[3]'>");
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
											url: "../../points/script/save_control.php",
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
											url: "../../points/script/delet_control.php",
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
							<?
									 echo '</form></td></tr>';
									} echo '</table>';
								}
							}
							?>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<b>Добавить пользователя</b><br><br>
						<form id="form_add_user" method="POST" action="../script/add_control_user.php">
							<table class="table_dark2">
								<tr>
									<th>Логин</th>
									<th>Пароль</th>
									<th>Приоритет</th>
								</tr>
								<tr>
									<td><input id="add_login" type="text" class="input" name="add_login" required></td>
									<td><input id="add_password" type="text" class="input" name="add_password" required></td>
									<td><select style="text-align:center; text-align-last:center" class="input" name="add_priorty" required>
											<option value="0">0</option>
											<option value="1">1</option>
										</select></td>
								</tr>
							</table>
							<div id="hideMe" class="modal_div_interior">
								<div id="result_add" class="modal_div_external"></div>
							</div>
							<br>
							<div class="block_button">
								<button id="addclick" class="button10" type="submit">Добавить</button>
							</div>
						</form>
					</td>
				</tr>
			</table>
	</div>
</div>
</body>
<footer>
	<br>
	author by <a href="http://mwogame.com/forum/user/17146-cyusik-c%d1%8e%d1%81%d0%b8%d0%ba/" target="_blank">Cyusik</a>
	<br>
</footer>
</html>
