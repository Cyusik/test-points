<?php
if($_SESSION['names']) {
	if(($_SESSION['role'] == 1) || ($_SESSION['role'] == 2)) {
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
	<h1>- Добавление строк в заявки на призы -</h1>
</div>
<div class="inner-content clearfix">
	<div class="accrual-content clearfix">
		<p style="text-indent:0">Добавляем строки в заявки на призы, пишем сколько баллов требуется для обмена. Всё просто.</p>
		<br>
		<script type="text/javascript" src="jsadmin/contests_form.js"></script>
		<div id="result_contests" class="div-result" style="display:none"></div>
		<form id="contests_form" method="POST" action="../script/new_line_swap.php">
			<input minlength="3" maxlength="21" placeholder="Введите никнейм" class="input" type="text" name="nickname_swap" id="nickname_swap" required>
			<input minlength="3" placeholder="Введите логин" class="input" type="text" name="login_swap" id="login_swap" required>
			<textarea placeholder="Список призов" style="width: 380px;" class="input textarea" id="history_swap" rows="1" cols="50" name="history_swap" required></textarea>
			<input class="input" id="points_swap" name="points_swap" type="number" placeholder="Баллы" required>
		</form>
		<button type="submit" form="contests_form" id="send" class="button">Занести в БД</button>
		<script type="text/javascript" src="jsadmin/textarea.js"></script>
	</div>
	<div class="space"></div>
	<h3>- История добавления -</h3>
	<div class="history-content clearfix">
		<?php
		$th = 'add_line_swap';
		$tableBD = 'add_line_log';
		$section = 'swap';
		$line_page = 'action=add_line_swap.php';
		include_once '../script/line_history.php'
		?>
	</div>
</div>