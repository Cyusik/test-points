<?php
if(isset($_POST["export"])) {
	include_once '../script/connect.php';
	//------------------------------
	session_start();
	$login = $_SESSION['login'];
	$file_login = "../logfiles/points_log.log";
	$fw = fopen($file_login, "a+");
	include_once '../script/datetime.php';
	fwrite($fw, $newdate.' '.$login.' Экспортировал csv points'."\r\n");
	fclose($fw);
	//-------------------------------
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=data.csv');
	$output = fopen("php://output", "w");
	$delimiter = ";";
	fputcsv($output, array('id','nickname','balls','history', 'exclude', 'login_one', 'login_two', 'login_three'), ";");
	$query = "SELECT  * FROM tablballs ORDER BY id";
	$result = mysqli_query($link, $query);
	while($row = mysqli_fetch_assoc($result))
	{
		fputcsv($output, $row, ";");
	}
	fclose($output);
	$link->close();
}
?>
