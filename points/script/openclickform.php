<?php
if(isset($_POST['open'])){
	include_once '../script/connect.php';
	$zapis = 1;
	$stroka = 1;
	$query ="UPDATE formobmen SET `open`= '$zapis' WHERE id='$stroka'";
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
	$link ->close();
	header('location: ../admin/formobmen.php');
}
if(isset($_POST['close'])){
	include_once '../script/connect.php';
	$zapis = 2;
	$stroka = 1;
	$query ="UPDATE formobmen SET `open`= '$zapis' WHERE id='$stroka'";
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
	$link ->close();
	header('location: ../admin/formobmen.php');
}
?>