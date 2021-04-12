<?php
if($_SESSION['names']) {
	if(($_SESSION['role'] == 1) || ($_SESSION['role'] == 2)) {
		$names = $_SESSION['names'];
		$role = $_SESSION['role'];
	} else {
		echo "Access is denied";
		exit;
	}
}
else {
	header("Location: ../admin/index.php");
	exit;
}
?>
<div class="content-heading">
	<h1>- Игнор лист, добавить, начислить -</h1>
</div>
<div class="inner-content clearfix">
	<div class="accrual-content clearfix">
		<?
		include_once '../script/check_ignore.php'
		?>
		<h3>- Добавить или убрать с игнор листа -</h3>
		<script type="text/javascript" src="jsadmin/contests_form.js"></script>
		<p style="text-indent:0">Галочка есть - значит есть ник такой.</p>
		<div id="result_contests" class="div-result" style="display:none"></div>
		<form id="contests_form" method="POST" action="../script/ignore_change.php">
			<input minlength="3" maxlength="21" placeholder="Введите никнейм" class="input" type="text" name="search_ignore" id="search_ignore" required>
			<i class="fa-position" id="image_status" style="font-size:25px; color:white"></i>
			<span style="display:none" id="stat_ignore"></span>
		</form>
		<br>
		<h3>- Просмотр начислений. Начислить баллы -</h3>
		<p style="text-indent:0">Просмотр ник/баллы удержанные при обновлении таблицы. Можно начислить баллы. Выводим за месяц.</p>
		<form id="delpoints" method="POST" action="../script/charge_ig.php">
			<input type="month" class="input in-dates" name="period_time" required>
			<button class="button" type="submit" style="vertical-align:middle">Просмотр</button>
		</form>
		<div id="resultdiv11"></div>
		<script type="text/javascript" src="jsadmin/ignore.js"></script>
	</div>
	<script type="text/javascript" src="jsadmin/modaldiv.js"></script>
	<script type="text/javascript" src="jsadmin/modal_clear.js"></script>
	<div class="space"></div>
	<h3>- История действий -</h3>
	<div class="history-content clearfix">
		<?php
		$tableBD = 'ign_log';
		$section = 'none';
		$th = 'ignore_list';
		$line_page = 'action=ignore_list.php';
		include_once '../script/line_history.php'
		?>
	</div>
</div>
