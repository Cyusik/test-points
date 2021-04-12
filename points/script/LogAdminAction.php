<?php
//$logarr
// общая таблица - добавить игрока - дата, раздел(Баллы), функция(Добавить игрока), админ, ник игрока, баллы, история, игнор, результат.
// общая таблица - поиск игрока - дата, раздел(Баллы), функция(поиск игрока), админ, ид_игрока, ник игрока, баллы, результат.
// общая таблица - сохранить изменение - дата, раздел(Баллы),  функция(сохранить), админ, ид_игрока, ник игрока, что изменилось:
//---------------------------------------------------------------------------------новый ник, баллы, история, игнор, логин 1,2,3
// общая таблица - начислить игнорщику - дата, раздел(Баллы), функция(нач.игнор), админ, периоддата, ник игрока, баллы, результат
// общая таблица - удалить игнорщика - дата, раздел(Баллы), функция(удалить.игнор), админ, периоддата, ник игрока, баллы, результат
// общая таблица - подсчет баллов - дата, раздел (баллы), функция(подсчет), админ, и действие1, и действие2, и действие3....
//
if (!empty($logarr)) {
	$insertlogarr = array();
	foreach($logarr as $data) {
		$insertlogarr[] = "'".$data."'";
	}
	$countarr = count($insertlogarr);
	if ($countarr < 11) {
		for($i = $countarr;$i < 11; $i++) {
			$insertlogarr[] = "'".''."'";
		}
	}
	$insertlogarr = implode(", ", $insertlogarr);
	//echo '<pre>';
	//print_r($insertlogarr);
	//echo '</pre>';
	$logadmininsert = "INSERT INTO logactionadmin(sections,function,login_admin,column_one,column_two,column_three,column_four,column_five,column_six,column_seven,column_eight) VALUES ($insertlogarr)";
	$logresult = mysqli_query($link, $logadmininsert) or die ('Error ' .mysqli_error($link));
	if ($logresult) {
		//print_r('успех');
	}
}
?>