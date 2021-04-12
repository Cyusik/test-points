<?php
if($_SESSION['names']) {
	if($_SESSION['role'] == 1) {
		$names = $_SESSION['names'];
		$role = $_SESSION['role'];
	} else {
		echo "Access is denied";
		exit;
	}
} else {
	header("Location: ../admin/index.php");
	exit;
}
?>
<div class="content-heading">
	<h1>- Управление доступом, выдача прав и прочее.. -</h1>
</div>
<div class="inner-content clearfix">
	<div class="accrual-content clearfix">
		<h3>- Список пользователей -</h3>
		<p style="text-indent:0">Где роль 1 = полный доступ, 2 = всё, кроме управления, 3 = только "Конкурсы".</p>
		<?
		include_once '../script/list_user.php'
		?>
		<p style="text-indent:0">Добавить нового пользователя. Имя и логин не должны совпадать с уже существующими.</p>
		<script type="text/javascript" src="jsadmin/contests_form.js"></script>
		<div id="result_contests" class="div-result" style="display:none"></div>
		<form id="contests_form" method="POST" action="../script/add_control_user.php">
			<input minlength="3" maxlength="21" placeholder="Имя юзера" class="input" type="text" name="add_name" id="add_name" required>
			<input minlength="3" maxlength="30" placeholder="Логин юзера" class="input" type="text" name="add_login" id="add_login" required>
			<input minlength="5" maxlength="30" placeholder="Пароль" class="input" type="text" name="add_password" id="add_password" required>
			<input placeholder="Роль" class="input" type="text" name="add_priorty" id="add_priorty" required>
			<button type="submit" class="button" style="vertical-align:middle">Добавить</button>
		</form>
		<br>
		<p style="text-indent:0">Смена роли и обновление пароля.</p>
		<div id="resultdiv11" class="div-result" style="display:none"></div>
		<form id="delpoints" method="POST" action="../script/editing_control.php">
			<input minlength="3" maxlength="21" placeholder="Логин юзера" class="input" type="text" name="new_login" id="new_login" required>
			<input minlength="5" maxlength="30" placeholder="Новый пароль" class="input" type="text" name="new_password" id="new_password">
			<input placeholder="Сменить роль" class="input" type="text" name="new_priorty" id="new_priorty">
			<button type="submit" class="button" style="vertical-align:middle">Изменить</button>
		</form>
		<br>
		<p style="text-indent:0">Удалить юзера.</p>
		<div id="res_del" class="div-result" style="display:none"></div>
		<form id="del_user" method="POST" action="../script/delet_control.php">
			<input minlength="3" maxlength="21" placeholder="Логин юзера" class="input" type="text" name="del_login" id="del_login" required>
			<button class="button" type="submit" style="vertical-align:middle">Удалить</button>
		</form>
	</div>
	<script type="text/javascript" src="jsadmin/modaldiv.js"></script>
	<script type="text/javascript" src="jsadmin/modal_clear.js"></script>
	<div class="space"></div>
	<h3>- История действий -</h3>
	<div class="history-content clearfix">
		<?php
		$tableBD = 'control_log';
		$section = 'none';
		$th = 'control_log';
		$line_page = 'action=control_user.php';
		include_once '../script/line_history.php'
		?>
	</div>
</div>
