<?php
if(isset($_POST['truncate1'])){
	include_once '../script/connect.php';
	//------------------------------
	session_start();
	$login = $_SESSION['login'];
	$file_login = "../logfiles/results_log.log";
	$fw = fopen($file_login, "a+");
	include_once '../script/datetime.php';
	//-------------------------------
	$query = "TRUNCATE TABLE itogobmen";
	$result = mysqli_query($link, $query) or die(fwrite($fw, $newdate.' Ошибка delrablspisok.php(13): '.mysqli_error($link)."\n"));
	if($result){
		fwrite($fw, $newdate.' '.$login.' Очистил таблицу results(itogobmen)'."\r\n");
		echo "<b style='color:red'>Таблица очищена, проверь</b><br />";
	}
	fclose($fw);
	mysqli_close($link);
}
?>
