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
	<h1>- Добавление строк в общую таблицу -</h1>
</div>
<div class="inner-content clearfix">
	<div class="accrual-content clearfix">
		<p style="text-indent:0">Пишем никнейм. Если стоит галочка, то всё ок, добавляем. Если крест - то такой никнейм уже есть в таблице. Если истроии нет, оставляем поле пустым. Окно можно расширить, правый нижний угол, клавиша Enter - перевод на новую строку.</p>
		<br>
		<script type="text/javascript" src="jsadmin/contests_form.js"></script>
		<div id="result_contests" class="div-result" style="display:none"></div>
		<form id="contests_form" method="POST" action="../script/new_line_points.php">
			<input minlength="3" maxlength="21" placeholder="Введите никнейм" class="input" type="text" name="nickname" id="nickname" required>
			<i class="fa-position" id="image_status" style="font-size:25px; color:white"></i>
			<span style="display:none" id="points_span"></span>
			<input style="width:100px;" placeholder="Баллы" class="input no-nick" type="text" name="points" id="points" required>
			<textarea placeholder="История" style="width:500px; display:none" class="input textarea" id="history" rows="1" cols="50" name="history"></textarea>
		</form>
		<button type="submit" form="contests_form" id="send" class="button" style="display:none">Занести в БД</button>
		<script type="text/javascript" src="jsadmin/button_input_points.js"></script>
		<script type="text/javascript" src="jsadmin/textarea.js"></script>
	</div>
	<div class="space"></div>
	<h3>- История добавления -</h3>
	<div class="history-content clearfix">
		<?php
		$th = 'add_line_points';
		$tableBD = 'add_line_log';
		$section = 'points';
		$line_page = 'action=add_line_points.php';
		include_once '../script/line_history.php'
		?>
	</div>
</div>