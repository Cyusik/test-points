<?php
if(isset($_POST["export"])) {
	include_once '../script/connect.php';
	//------------------------------
	session_start();
	$names = $_SESSION['names'];
	//-------------------------------
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=data.csv');
	$output = fopen("php://output", "w");
	$delimiter = ";";
	fputcsv($output, array('id','dates','nickname','account','priz', 'points', 'status'), ";");
	$query = "SELECT  * FROM zapisform ORDER BY id";
	$result = mysqli_query($link, $query);
	if($result) {
		while($row = mysqli_fetch_assoc($result))
		{
			fputcsv($output, $row, ";");
		}
		fclose($output);
		$ex_tb_pn = "INSERT INTO tbl_exim_log(login_ad,section,field_one,field_two,field_three) VALUES ('$names', 'exchanging', 'Экспорт таблицы', '', '')";
		$res_ex = mysqli_query($link, $ex_tb_pn) or die ('Error '.mysqli_error($link));

	}
	$link->close();
}
?>