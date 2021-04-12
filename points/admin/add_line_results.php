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
	<h1>- Добавление строк в таблицу итогов -</h1>
</div>
<div class="inner-content clearfix">
	<div class="accrual-content clearfix">
		<p style="text-indent:0">Добавляем строки в итоги, всё просто.</p>
		<br>
		<script type="text/javascript" src="jsadmin/contests_form.js"></script>
		<div id="result_contests" class="div-result" style="display:none"></div>
		<form id="contests_form" method="POST" action="../script/new_line_results.php">
			<input class="input in-dates" id="dates_results" name="dates_results" type="datetime-local" step="1" placeholder="дд.мм.гг чч:мм" required>
			<input minlength="3" maxlength="21" placeholder="Введите никнейм" class="input" type="text" name="nickname_results" id="nickname_results" required>
			<select form="contests_form" class="input in-select" id="option_results" name="option_results" type="text" required>
				<option value="" selected="selected"></option>
				<option>Выдано</option>
				<option>Не выдано</option>
			</select>
			<input class="input" id="cause_results" name="cause_results" type="text" placeholder="Причина">
		</form>
		<button type="submit" form="contests_form" id="send" class="button">Занести в БД</button>
	</div>
	<div class="space"></div>
	<h3>- История добавления -</h3>
	<div class="history-content clearfix">
		<?php
		$th = 'add_line_results';
		$tableBD = 'add_line_log';
		$section = 'results';
		$line_page = 'action=add_line_results.php';
		include_once '../script/line_history.php'
		?>
	</div>
</div>