<?php
if(isset($_POST['truncate'])){
	include_once '../script/connect.php';
	//------------------------------
	//session_start();
	//$login = $_SESSION['login'];
	//$file_login = "../logfiles/points_log.log";
	//$fw = fopen($file_login, "a+");
	//$logarr = array('points', 'truncate table', $login);
	//include_once '../script/datetime.php';
	//-------------------------------
	$clear_logactionadmin = "TRUNCATE TABLE logactionadmin";
	$result = mysqli_query($link, $clear_logactionadmin) or die('Error: '.mysqli_error($link));
	if($result){
		echo "<b style='color:red'>Лог админки очищен</b><br>";
	}
	$clear_logadmin = "TRUNCATE TABLE logadmin";
	$result = mysqli_query($link, $clear_logadmin) or die('Error: '.mysqli_error($link));
	if($result){
		echo "<b style='color:red'>Лог посещений очищен</b><br>";
	}
	$claer_logswap = "TRUNCATE TABLE logswap";
	$result = mysqli_query($link, $claer_logswap) or die('Error: '.mysqli_error($link));
	if($result){
		echo "<b style='color:red'>Лог заявок на призы очищен</b><br>";
	}
	$clear_logtablesearch = "TRUNCATE TABLE logtablesearch";
	$result = mysqli_query($link, $clear_logtablesearch) or die('Error: '.mysqli_error($link));
	if($result){
		echo "<b style='color:red'>Лог запросов по таблицам очищен</b><br>";
	}
	mysqli_close($link);
}
?>