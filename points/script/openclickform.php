<?php
if(isset($_POST['open'])){
	include_once '../script/connect.php';
	session_start();
	$login = $_SESSION['login'];
	$file_login = $_SERVER["DOCUMENT_ROOT"] . "/points/logfiles/exchange_log.log";
	$fw = fopen($file_login, "a+");
	$date = date('Y-m-d h:i:s');
	$newdate = date('Y-m-d h:i:s A', strtotime($date));
	$zapis = 1;
	$stroka = 1;
	$query ="UPDATE formobmen SET `open`= '$zapis' WHERE id='$stroka'";
	$result = mysqli_query($link, $query) or die(fwrite($fw, $newdate.' Ошибка openclickform.php(12): '.mysqli_error($link)."\n"));
	if($result){
		fwrite($fw, $newdate.' '.$login.' Открыл опрос=>true'."\r\n");
	}
	$link ->close();
	fclose($fw);
	header('location: ../admin/formobmen.php');
}
if(isset($_POST['close'])){
	include_once '../script/connect.php';
	session_start();
	$login = $_SESSION['login'];
	$file_login = "../logfiles/exchange_log.log";
	$fw = fopen($file_login, "a+");
	$date = date('Y-m-d h:i:s');
	$newdate = date('Y-m-d h:i:s A', strtotime($date));
	$zapis = 2;
	$stroka = 1;
	$query ="UPDATE formobmen SET `open`= '$zapis' WHERE id='$stroka'";
	$result = mysqli_query($link, $query) or die(fwrite($fw, $newdate.' Ошибка openclickform.php(26): '.mysqli_error($link)."\n"));
	if($result){
		fwrite($fw, $newdate.' '.$login.' Закрыл опрос=>true'."\r\n");
	}
	$link ->close();
	fclose($fw);
	header('location: ../admin/formobmen.php');
}
?>