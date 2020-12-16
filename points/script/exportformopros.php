<?php
if(isset($_POST["export2"])) {
	include_once '../script/connect.php';
	//------------------------------
	session_start();
	$login = $_SESSION['login'];
	$file_login = "../logfiles/exchange_log.log";
	$fw = fopen($file_login, "a+");
	include_once '../script/datetime.php';
	fwrite($fw, $newdate.' '.$login.' Экспортировал csv exchange'."\r\n");
	fclose($fw);
	//-------------------------------
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=data.csv');
	$output = fopen("php://output", "w");
	$delimiter = ";";
	fputcsv($output, array('id','dates','nickname','account','priz', 'points', 'status'), ";");
	$query = "SELECT  * FROM zapisform ORDER BY id";
	$result = mysqli_query($link, $query);
	while($row = mysqli_fetch_assoc($result))
	{
		fputcsv($output, $row, ";");
	}
	fclose($output);
	$link->close();
}
?>