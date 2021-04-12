<?php
if($_SESSION['names']) {
	if(($_SESSION['role'] == 1) || ($_SESSION['role'] == 2) || ($_SESSION['role'] == 3)) {
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
	<h1>- Баллы за конкурсы -</h1>
</div>
<div class="inner-content clearfix">
	<div class="accrual-content clearfix">
		<p style="text-indent:0">Тут начисляем баллы за конкурсы Вк и Эрудит. Добавляем никнейм, если стоит галочка, то никнейм есть в таблице. Если крест - то нет. Можно начислять нескольким игрокам сразу.</p>
		<p style="text-indent:0">В Доп. информации указываем:</p>
		<p>1. Для Vk - ссылку на пост и ссылку на результаты (ссылка_1; ссылка_2)</p>
		<p>1. Для Эрудита - ссылку на форму и ссылку на результаты (ссылка_1; ссылка_2)</p>
		<br>
		<script type="text/javascript" src="jsadmin/contests_form.js"></script>
		<div id="result_contests" class="div-result" style="display:none"></div>
		<form id="contests_form" method="POST" action="../script/contests_points.php">
		</form>
		<div id="add" class="button" style="width:80px">Добавить</div>
		<div id="del" class="button" style="width:80px">Удалить</div>
		<button type="submit" form="contests_form" id="send" class="button" style="display:none">Начислить</button>
	<script type="text/javascript" src="jsadmin/button_input_contests.js"></script>
	</div>
	<div class="space"></div>
	<h3>- История начислений -</h3>
	<div class="history-content clearfix">
		<?include_once '../script/contests_history.php'?>
	</div>
</div>