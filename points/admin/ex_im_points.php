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
	<h1>- Экспорт, импорт, подсчет баллов -</h1>
</div>
<div class="inner-content clearfix">
	<div class="accrual-content clearfix">
		<h3>- Подсчет баллов -</h3>
		<?
		$section = 'points';
		$tableBD_string = 'tablballs';
		include_once '../script/strings_table.php'
		?>
		<div class="upload_count">
		<p style="text-indent:0">Перед загрузкой <b>.csv</b> таблицы для подсчета баллов обязательно экспортируйте всю таблицу, т.к. после загрузки изменения нельзя будет отменить.</p>
		<br>
		<script type="text/javascript" src="jsadmin/contests_form.js"></script>
		<form id="count_points" method="POST" action="../script/count_points.php">
			<label for="date_check" class="button"><input type="checkbox" name="date_check" id="date_check" class="date_check"> Обновить дату</label>
			<input type="file" name="countfile" id="countfile" class="countfile">
			<label id="countfileON" for="countfile" class="button">Выберите файл</label>
			<button id="buttonfile" class="button" type="submit">Отправить</button>
			<img src="/points/admin/img/spinner.gif" alt="load_gif" class="load_gif" id="loadgif" style="display:none">
		</form>
		<div id="uploadfile"></div>
		<div id="resultcount"></div>
		</div>
		<br>
		<h3>- Экспорт и Импорт -</h3>
		<p style="text-indent:0">Перед обновлением таблицы в базе необходимо сделать следующее:</p>
		<p>1. Экспортировать таблицу (кнопка экспорта);</p>
		<p>2. Очистить таблицу (ОБЯЗАТЕЛЬНО! Иначе при импорте строки добавятся к уже существуюущим строкам в базе, а не заменят их);</p>
		<p>3. После уже можно импортировать таблицу (только <b>.csv</b> файлы);</p>
		<p>4. Чем больше строк - тем дольше импорт (НЕ обновлять страницу, пока скрипт работает!). По завершению загрузки выйдет сообщение, что загрузка завершена. Зайти на сайт с баллами (менюшка слева 'Таблицы -> таблица с баллами') и убедиться что все строки есть (пролистать в самый конец).</p>
		<?php
			include_once '../script/ex_tb_pnt.php';
		?>
		<form method="POST" action="../script/ex_tb_pnt.php">
			<button class="button" type="submit" name="export"><i class="fa fa-download"></i> Экспорт</button>
		</form>
		<div class="button_clear js-button-campaign"><span><i class="fa fa-eraser"></i>Очистить таблицу</span></div>
		<div class="overlay js-overlay-campaign">
			<div class="popup js-popup-campaign">
				<h3 class="modal">Внимание</h3>
				Очистить таблицу?<br>
				Данные нельзя будет восстановить<br>
				<br><form id="delpoints" action="../script/truncate_table.php" method="POST">
					<input class="button" type="hidden" name="truncateBD" value="tablballs">
					<div id="resultdiv11"></div>
					<input class="button" type="submit" value="ОЧИСТИТЬ">
				</form>
				<div class="close-popup js-close-campaign"></div>
			</div>
		</div>
		<form id="imp_points" method="POST" action="../script/imp_tb_pn.php">
			<input type="file" name="imp_file" id="imp_file" class="countfile">
			<label id="imp_fileON" for="imp_file" class="button">Выберите файл</label>
			<button id="but_import" class="button" type="submit"><i class="fa fa-upload"></i> Импорт</button>
			<img src="/points/admin/img/spinner.gif" alt="load_gif" class="load_gif" id="loadgif_ipm" style="display:none">
		</form>
		<div id="result_imp"></div>
		<br>
		<h3>- Обновить дату вручную -</h3>
		<p style="text-indent:0">Вообще тут не только дату можно но и просто слово любое написать.. так, на всякий. И оно будет там же где и дата в общей таблице.</p>
		<form id="update_date" method="POST" action="../script/date.php">
			<input id="update_date_in" maxlength="10" name="date_pnt" class="input" placeholder="дд.мм.гг" type="text">
			<button type="submit" class="button" style="vertical-align:middle">Обновить</button>
		</form>
		<div id="resultdate"></div>
	</div>
			<script type="text/javascript" src="jsadmin/modaldiv.js"></script>
			<script type="text/javascript" src="jsadmin/modal_clear.js"></script>
	<div class="space"></div>
	<h3>- История действий -</h3>
	<div class="history-content clearfix">
		<?php
		$tableBD = 'tbl_exim_log';
		$section = 'points';
		$th = 'ex_im_points';
		$line_page = 'action=ex_im_points.php';
		include_once '../script/line_history.php'
		?>
	</div>
</div>
