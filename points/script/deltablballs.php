<?php
if(isset($_POST['truncate'])){
	include_once '../script/connect.php';
	//------------------------------
	session_start();
	$login = $_SESSION['login'];
	$file_login = "../logfiles/points_log.log";
	$fw = fopen($file_login, "a+");
	include_once '../script/datetime.php';
	//-------------------------------
	$query = "TRUNCATE TABLE tablballs";
	$result = mysqli_query($link, $query) or die(fwrite($fw, $newdate.' Ошибка deltablballs.php(13): '.mysqli_error($link)."\n"));
	if($result){
		fwrite($fw, $newdate.' '.$login.' Очистил таблицу points(tablballs)'."\r\n");
		echo "<b style='color:red'>Таблица очищена, проверь</b><br />";
	}
	fclose($fw);
	mysqli_close($link);
}
?>
