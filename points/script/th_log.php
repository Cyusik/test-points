<?php
if($lg_srh['log_bd'] == 'contests_log') {
	echo '<h3>- Лог раздела Конкурсы -</h3>
		<th>Дата</th>
		<th>Юзер</th>
		<th>Никнейм</th>
		<th>Баллы</th>
		<th>Описание</th>';
}
if($lg_srh['log_bd'] == 'add_line_log') {
	echo '<h3>- Лог раздела Добавление -</h3>
		<th>Дата</th>
		<th>Юзер</th>
		<th>Таблица</th>
		<th>Pr_1</th>
		<th>Pr_2</th>
		<th>Pr_3</th>
		<th>Pr_4</th>';
}
if($lg_srh['log_bd'] == 'changes_log') {
	echo '<h3>- Лог раздела Редактирование -</h3>
		<th>Дата</th>
		<th>Юзер</th>
		<th>Таблица</th>
		<th>Pr_1</th>
		<th>Pr_2</th>
		<th>Pr_3</th>
		<th>Pr_4</th>';
}
if($lg_srh['log_bd'] == 'tbl_exim_log') {
	echo '<h3>- Лог раздела Экс&Имп/подсчет/обмен -</h3>
		<th>Дата</th>
		<th>Юзер</th>
		<th>Таблица</th>
		<th>Pr_1</th>
		<th>Pr_2</th>
		<th>Pr_3</th>';
}
if($lg_srh['log_bd'] == 'ign_log') {
	echo '<h3>- Лог раздела Игнора -</h3>
		<th>Дата</th>
		<th>Юзер</th>
		<th>Действие</th>
		<th>Никнейм</th>
		<th>Период времени</th>';
}
if($lg_srh['log_bd'] == 'control_log') {
	echo '<h3>- Лог раздела Управления -</h3>
		<th>Дата</th>
		<th>Юзер</th>
		<th>Действие</th>
		<th>Pr_1</th>
		<th>Pr_2</th>
		<th>Pr_3</th>';
}
if($lg_srh['log_bd'] == 'auth_adm_log') {
	echo '<h3>- Лог авторизации в админку -</h3>
		<th>Дата</th>
		<th>Ip</th>
		<th>Логин</th>
		<th>Пароль</th>
		<th>Результат</th>';
}
if($lg_srh['log_bd'] == 'swap_log') {
	echo '<h3>- Лог заполнения заявок -</h3>
		<th>Дата</th>
		<th>Ip</th>
		<th>Никнейм</th>
		<th>Логин</th>
		<th>Есть</th>
		<th>Нужно</th>
		<th>Призы</th>
		<th>Итог</th>
		<th>Статус</th>';
}
if($lg_srh['log_bd'] == 'srh_usr_log') {
	echo '<h3>- Лог поиска игроками по таблицам -</h3>
		<th>Дата</th>
		<th>Никнейм искомый</th>
		<th>IP</th>
		<th>Таблица</th>
		<th>Итог</th>';
}
?>