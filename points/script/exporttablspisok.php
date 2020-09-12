<?php
if(isset($_POST["export1"])) {
	include_once '../script/connect.php';
	//------------------------------
	session_start();
	$login = $_SESSION['login'];
	$file_login = "../logfiles/results_log.log";
	$fw = fopen($file_login, "a+");
	$date = date('Y-m-d h:i:s');
	$newdate = date('Y-m-d h:i:s A', strtotime($date));
	fwrite($fw, $newdate.' '.$login.' Экспортировал csv results'."\r\n");
	fclose($fw);
	//-------------------------------
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=data.csv');
	$output = fopen("php://output", "w");
	$delimiter = ";";
	fputcsv($output, array('id','dates','nickname','itog','prichina'), ";");
	$query = "SELECT  * FROM itogobmen ORDER BY id";
	$result = mysqli_query($link, $query);
	while($row = mysqli_fetch_assoc($result))
	{
		fputcsv($output, $row, ";");
	}
	fclose($output);
	$link->close();
}
?>
