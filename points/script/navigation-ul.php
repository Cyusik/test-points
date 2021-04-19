<?php
if($_SESSION['names'] && $_SESSION['role']) {
	echo '
<div class="hide_menu"><h3>Menu</h3></div>
<ul id="accordion" class="accordion">';
	if(($_SESSION['role'] == 1) || ($_SESSION['role'] == 2) || ($_SESSION['role'] == 3)) {
		echo '<li class="hide">
		<div class="link no-li">'.$names.'<i class="fa fa-user"></i></div>
	</li>
	<li class="hide">
		<div class="link"><a href="../admin/description.php">Описание</a><i class="fa fa-clipboard"></i></div>
	</li>
	<li class="hide">
		<div class="link"><a href="../admin/description.php?action=contests.php">Конурсы</a></div>
	</li>
	<li class="hide">
		<div class="link">Таблицы<i class="fa fa-chevron-down"></i></div>
		<ul class="submenu">
			<li><a href="../index.php" target="_blank">Таблица с баллами</a></li>
			<li><a href="../results.php" target="_blank">Итоги выдачи призов</a></li>
		</ul>
	</li>';
	}
	if(($_SESSION['role'] == 1) || ($_SESSION['role'] == 2)) {
		echo '<li class="hide">
		<div class="link">Добавление<i class="fa fa-chevron-down"></i></div>
		<ul class="submenu">
			<li><a href="../admin/description.php?action=add_line_points.php">Строка в баллы</a></li>
			<li><a href="../admin/description.php?action=add_line_results.php">Строка в итоги</a></li>
			<li><a href="../admin/description.php?action=add_line_swap.php">Строка в заявки</a></li>
		</ul>
	</li>
	<li class="hide">
		<div class="link">Редактирование<i class="fa fa-chevron-down"></i></div>
		<ul class="submenu">
			<li><a href="../admin/description.php?action=editing_points.php">Таблица баллов</a></li>
			<li><a href="../admin/description.php?action=editing_results.php"">Таблица итогов</a></li>
		</ul>
	</li>
	<li class="hide">
		<div class="link">Экс&Имп/подсчет/обмен<i class="fa fa-chevron-down"></i></div>
		<ul class="submenu">
			<li><a href="../admin/description.php?action=ex_im_points.php">Баллы</a></li>
			<li><a href="../admin/description.php?action=ex_im_results.php">Итоги</a></li>
			<li><a href="../admin/description.php?action=ex_im_exch.php">Опрос и обмен</a></li>
		</ul>
	</li>
	<li class="hide">
		<div class="link"><a href="../admin/description.php?action=ignore_list.php">Игнор лист</a></div>
	</li>';
	}
	if($_SESSION['role'] == 1) {
		echo '<li class="hide">
		<div class="link">Управление<i class="fa fa-chevron-down"></i></div>
		<ul class="submenu">
			<li><a href="../admin/description.php?action=control_user.php">Управление доступом</a></li>
			<li><a href="../admin/description.php?action=viewing_logs.php">Просмотр логов</a></li>
		</ul>
	</li>';
	}
	echo '
	<li class="hide">
		<div class="link"><a href="../admin/description.php?action=logout">Выйти</a></div>
	</li>
</ul>';
}
?>