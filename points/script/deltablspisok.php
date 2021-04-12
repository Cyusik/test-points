<?php
if(isset($_POST['truncate1'])){
	include_once '../script/connect.php';
	//------------------------------
	session_start();
	$login = $_SESSION['login'];
	$file_login = "../logfiles/results_log.log";
	$fw = fopen($file_login, "a+");
	$logarr = array('exchange', 'truncate table', $login);
	include_once '../script/datetime.php';
	//-------------------------------
	$query = "TRUNCATE TABLE itogobmen";
	$result = mysqli_query($link, $query) or die(fwrite($fw, $newdate.' Ошибка delrablspisok.php(13): '.mysqli_error($link)."\n"));
	if($result){
		$logarr[] = 'truncate -> true';
		echo "<b style='color:red'>Таблица очищена, проверь</b><br />";
	}
	require_once 'LogAdminAction.php';
	fclose($fw);
	mysqli_close($link);
}
?>
