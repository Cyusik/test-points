<?php
if (isset($_POST['admin_clear_log'])) {
	session_start();
	$login = $_SESSION['login'];
	include_once 'datetime.php';
	file_put_contents('../logfiles/login_to_admin.log', null);
	$fw = fopen("../logfiles/login_to_admin.log", "a+" );
	fwrite($fw, $newdate.' '.$login.' =>clear_log...'."\r\n");
	fclose($fw);
	echo '<b style="color:red">лог перемещений очищен</b>';
}
if (isset($_POST['search_clear_log'])) {
	session_start();
	$login = $_SESSION['login'];
	$date = date('Y-m-d h:i:s');
	$newdate = date('Y-m-d h:i:s A', strtotime($date));
	file_put_contents('../logfiles/search_log.log', null);
	$fw = fopen("../logfiles/search_log.log", "a+" );
	fwrite($fw, $newdate.' '.$login.' =>clear_log...'."\r\n");
	fclose($fw);
	echo '<b style="color:red">лог поиска по таблицам очищен</b>';
}
if (isset($_POST['swap_clear_log'])) {
	session_start();
	$login = $_SESSION['login'];
	$date = date('Y-m-d h:i:s');
	$newdate = date('Y-m-d h:i:s A', strtotime($date));
	file_put_contents('../logfiles/swap_log.log', null);
	$fw = fopen("../logfiles/swap_log.log", "a+" );
	fwrite($fw, $newdate.' '.$login.' =>clear_log...'."\r\n");
	fclose($fw);
	echo '<b style="color:red">лог формы для обмена очищен</b>';
}
if (isset($_POST['points_clear_log'])) {
	session_start();
	$login = $_SESSION['login'];
	$date = date('Y-m-d h:i:s');
	$newdate = date('Y-m-d h:i:s A', strtotime($date));
	file_put_contents('../logfiles/points_log.log', null);
	$fw = fopen("../logfiles/points_log.log", "a+" );
	fwrite($fw, $newdate.' '.$login.' =>clear_log...'."\r\n");
	fclose($fw);
	echo '<b style="color:red">лог управления баллами очищен</b>';
}
if (isset($_POST['results_clear_log'])) {
	session_start();
	$login = $_SESSION['login'];
	$date = date('Y-m-d h:i:s');
	$newdate = date('Y-m-d h:i:s A', strtotime($date));
	file_put_contents('../logfiles/results_log.log', null);
	$fw = fopen("../logfiles/results_log.log", "a+" );
	fwrite($fw, $newdate.' '.$login.' =>clear_log...'."\r\n");
	fclose($fw);
	echo '<b style="color:red">лог управления итогами очищен</b>';
}
if (isset($_POST['exchange_clear_log'])) {
	session_start();
	$login = $_SESSION['login'];
	$date = date('Y-m-d h:i:s');
	$newdate = date('Y-m-d h:i:s A', strtotime($date));
	file_put_contents('../logfiles/exchange_log.log', null);
	$fw = fopen("../logfiles/exchange_log.log", "a+" );
	fwrite($fw, $newdate.' '.$login.' =>clear_log...'."\r\n");
	fclose($fw);
	echo '<b style="color:red">лог управления заявок очищен</b>';
}
?>
