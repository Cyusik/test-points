<?php
if(isset($_POST['truncate2'])){
	include_once '../script/connect.php';
	//------------------------------
	session_start();
	$login = $_SESSION['login'];
	$file_login = "../logfiles/exchange_log.log";
	$fw = fopen($file_login, "a+");
	$date = date('Y-m-d h:i:s');
	$newdate = date('Y-m-d h:i:s A', strtotime($date));
	//-------------------------------
	$query = "TRUNCATE TABLE zapisform";
	$result = mysqli_query($link, $query) or die(fwrite($fw, $newdate.' Ошибка deltablform.php(13): '.mysqli_error($link)."\n"));
	if($result) {
		fwrite($fw, $newdate.' '.$login.' Очистил таблицу exchange(zapisform)'."\r\n");
		echo "<br><b style='color:red'>Таблица очищена, проверь</b><br>";
	}
	fclose($fw);
	mysqli_close($link);
}
?>

