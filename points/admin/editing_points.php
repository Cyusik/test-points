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
	<h1>- Редактирование таблицы баллов -</h1>
</div>
<div class="inner-content clearfix">
	<div class="accrual-content clearfix">
		<p style="text-indent:0">Ищем никнейм, редактируем. Всё просто.</p>
		<br>
		<script type="text/javascript" src="jsadmin/contests_form.js"></script>
		<form id="contests_form" method="POST" action="../script/edit_search.php">
			<input minlength="3" maxlength="21" placeholder="Введите никнейм" class="input" type="text" name="nickname" id="nickname_editing_table" required>
			<button type="submit" form="contests_form" id="send" class="button" style="vertical-align:middle">Найти</button>
		</form>
		<div id="result_contests"></div>
		<script type="text/javascript" src="jsadmin/modaldiv.js"></script>
	<!--	<script type="text/javascript" src="jsadmin/button_input_points.js"></script> -->
		<script type="text/javascript" src="jsadmin/textarea.js"></script>
	</div>
	<div class="space"></div>
	<h3>- История изменений -</h3>
	<div class="history-content clearfix">
		<?php
		$th = 'editing_points';
		$tableBD = 'changes_log';
		$section = 'points';
		$line_page = 'action=editing_points.php';
		include_once '../script/line_history.php'
		?>
	</div>
</div>