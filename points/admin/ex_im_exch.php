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
	<h1>- Экспорт и очистка заявок, опрос -</h1>
</div>
<div class="inner-content clearfix">
	<div class="accrual-content clearfix">
		<h3>- Открыть и закрыть опрос на обмен баллов -</h3>
		<script type="text/javascript" src="jsadmin/contests_form.js"></script>
		<?
		$section = 'exchanging';
		$tableBD_string = 'zapisform';
		include_once '../script/strings_table.php'
		?>
		<?php
		include_once '../script/stat_swap.php'
		?>
		<form method="POST" action="../script/openclickform.php">
			<input class="button" type="submit" name="open" value="Открыть опрос">
			<input class="button" type="submit" name="close" value="Закрыть опрос">
		</form>
		<br>
		<h3>- Экспорт и очистка заявок на обмен баллов -</h3>
		<p style="text-indent:0">Очищаем заявки только в случае крайней необходимости.</p>
		<p>Предварительно экспортировать и обсудить необходимость очистки.</p>
		<?php
		include_once '../script/ex_tb_exch.php';
		?>
		<form method="POST" action="../script/ex_tb_exch.php">
			<button class="button" type="submit" name="export"><i class="fa fa-download"></i> Экспорт</button>
		</form>
		<div class="button_clear js-button-campaign"><span><i class="fa fa-eraser"></i>Очистить таблицу</span></div>
		<div class="overlay js-overlay-campaign">
			<div class="popup js-popup-campaign">
				<h3 class="modal">Внимание</h3>
				Очистить таблицу?<br>
				Данные нельзя будет восстановить<br>
				<br>
				<form id="delpoints" action="../script/truncate_table.php" method="POST">
					<input class="button" type="hidden" name="truncateBD" value="zapisform">
					<div id="resultdiv11"></div>
					<input class="button" type="submit" value="ОЧИСТИТЬ">
				</form>
				<div class="close-popup js-close-campaign"></div>
			</div>
		</div>
		<h3>- Просмотр заявок на обмен баллов -</h3>
		<p style="text-indent:0">Ставится дата ОТ и дата ДО. Никнейм и сортировка строк не обязательна. Нельзя вывести более 500 строк. Параметр "Все" выводит все строки за период, но не более 500.</p>
		<form id="contests_form" method="POST" action="../script/search_exchanging.php">
			<input class="input in-dates" name="monthFrom" type="date" min="2000-01" max="2099-12" placeholder="Дата ОТ" required>
			<input class="input in-dates" name="monthTo" type="date" min="2000-01" max="2099-12" placeholder="Дата ДО" required>
			<input placeholder="Введите ник" class="input" id="obmennick" name="nickname_swap" type="text" minlength="3" maxlength="21">
			<select class="input in-select" form="contests_form" name="limit_swap" required>
				<option value="500">Все</option>
				<option value="50">50</option>
				<option value="100">100</option>
				<option value="150">150</option>
				<option value="250">250</option>
				<option value="350">350</option>
			</select>
			<select form="contests_form" class="input in-select" name="sorting">
				<option></option>
				<option value="dates" style="color:white">Дата</option>
				<option value="nickname" style="color:white">Никнейм</option>
				<option value="account" style="color:white">Логин</option>
				<option value="status" style="color:white">Статус</option>
			</select>
			<button class="button" type="submit" style="vertical-align:middle">Найти</button>
		</form>
		<div id="result_contests"></div>
	</div>
	<script type="text/javascript" src="jsadmin/modaldiv.js"></script>
	<script type="text/javascript" src="jsadmin/modal_clear.js"></script>
	<div class="space"></div>
	<h3>- История действий -</h3>
	<div class="history-content clearfix">
		<?php
		$tableBD = 'tbl_exim_log';
		$section = 'exchanging';
		$th = 'ex_im';
		$line_page = 'action=ex_im_exch.php';
		include_once '../script/line_history.php'
		?>
	</div>
</div>
