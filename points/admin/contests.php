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
		<p style="text-indent:0">Тут начисляем баллы за конкурсы Вк и Эрудит. Нажимаем "Добавить" -> пишем никнейм. Если никнейм есть в таблице, то появится галочка и дополнительные поля. Пишем баллы (сколько необходимо начислить) и доп. информацию. Если же появился крестик, то такого никнейма нет в таблице или введен не верно. В этом случае не найденный никнейм передаем руководству и выдаем остальным. Так же можно начислять нескольким игрокам сразу (несколько раз нажать кнопку "Добавить").</p>
		<p style="text-indent:0">В Доп. информации указываем:</p>
		<p>1. Для Vk - ссылку на пост и ссылку на результаты (ссылка_1; ссылка_2)</p>
		<p>1. Для Эрудита - ссылка скрин на результаты ответов в гугл доке и ссылка  скрин результат конкурса на форуме (ссылка_1; ссылка_2)</p>
		<br>
		<div id="result_contests">
			<div id='hideME' class='modal_div_interior' style='display:none'>
				<div id='div_result' class='modal_div_external' style='margin-top:40px;'></div>
			</div>
		</div>
		<form id="contests_form" method="POST" action="../script/contests_points.php">
		</form>
		<div id="add" class="button" style="width:80px">Добавить</div>
		<div id="del" class="button" style="width:80px">Удалить</div>
		<button type="submit" form="contests_form" id="send" class="button" style="display:none">Начислить</button>
		<script type="text/javascript">
			var isMobile = false;
			$(document).ready( function() {
				if ($('body').width() <= 460) {
					isMobile = true; //mobile
				}
				if (!isMobile) { //desctop
					$('body').append('<script type="text/javascript" src="jsadmin/button_input_contests.js"></scr' + 'ipt>');
				} else {
					$('body').append('<script type="text/javascript" src="jsadmin/button_input_contests_mb.js"></scr' + 'ipt>');
				}
			});
		</script>
	</div>
	<div class="space"></div>
	<h3>- История начислений -</h3>
	<div class="history-content clearfix">
		<?include_once '../script/contests_history.php'?>
	</div>
</div>