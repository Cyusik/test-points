<?php
if($_SESSION['names']) {
	if($_SESSION['role'] == 1) {
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
	<h1>- Логи. Просмотр, экспорт и очистка -</h1>
</div>
<div class="inner-content clearfix">
	<div class="accrual-content clearfix">
		<p style="text-indent:0">Собственно должна быть некие параметры поиска. Выбор лога обязателен. Дату выбирать не обязательно.</p>
		<div class="param-search-logs">
		<form id="search_log" method="GET" action="<?php $_GET['action']?>">
			<input name="action" value="viewing_logs.php" style="display:none;">
			<select form="search_log" name="log_bd" class="input in-select in_block" style="width:280px;" required>
				<option value=""></option>
				<option value="contests_log">Раздел конкурсы</option>
				<option value="add_line_log">Раздел добавление</option>
				<option value="changes_log">Раздел редактирование</option>
				<option value="tbl_exim_log">Раздел Экс&Имп/подсчет/обмен</option>
				<option value="ign_log">Раздел игнор лист</option>
				<option value="control_log">Раздел управления</option>
				<option value="auth_adm_log">Лог авторизаций в админку</option>
				<option value="swap_log">Лог заявок на обмен</option>
				<option value="srh_usr_log">Лог запросов от юзеров</option>
			</select>
			<input type="datetime-local" class="input in-dates in_block" name="dt_st" id="dt_st" style="width:256px;">
			<input type="datetime-local" class="input in-dates in_block" name="dt_en" id="dt_en" style="width:256px;">
		</form>
		<button form="search_log" id="srh_lg_but" class="button" type="submit" style="vertical-align:middle;">Поиск</button>
		</div>
		<p style="text-indent:0">Тут можно экспортировать или очистить лог</p>
		<div class='mainwindow'>
			<div class='openwindow'>
				<h3 class='modal' id='heading'></h3>
				<span id='spanwidow'></span><br><br>
				<div class='button' id='closewidow'>Очистить</div>
				<div class='button' id='canceling'>Отмена</div></div></div>
		<div id='hideME_log' class='modal_div_interior' style='display:none'>
			<div id='div_result_log' class='modal_div_external'></div></div>
		<form id="act_log" method="POST" action="../script/exp_lg.php">
			<select form="act_log" name="act_log_bd" class="input in-select" required>
				<option value=""></option>
				<option value="contests_log">Раздел конкурсы</option>
				<option value="add_line_log">Раздел добавление</option>
				<option value="changes_log">Раздел редактирование</option>
				<option value="tbl_exim_log">Раздел Экс&Имп/подсчет/обмен</option>
				<option value="ign_log">Раздел игнор лист</option>
				<option value="control_log">Раздел управления</option>
				<option value="auth_adm_log">Лог авторизаций в админку</option>
				<option value="swap_log">Лог заявок на обмен</option>
				<option value="srh_usr_log">Лог запросов от юзеров</option>
			</select>
			<button id="ex_log" class="button" type="submit" style="vertical-align:middle">Экспорт</button>
			<span id="trn_log" class="button btn-span" type="submit" style="vertical-align:middle">Очистить</span>
		</form>
		<?php
		include_once '../script/exp_lg.php';
		?>
	</div>
	<script type="text/javascript" src="jsadmin/log-bd.js"></script>
	<script type="text/javascript" src="jsadmin/modaldiv.js"></script>
	<script type="text/javascript" src="jsadmin/modal_clear.js"></script>
	<div class="space"></div>
	<div class="history-content clearfix">
		<?php
		$tableBD = 'control_log';
		$section = 'none';
		$line_page = 'action=viewing_logs.php';
		include_once '../script/log_db.php'
		?>
	</div>
</div>
