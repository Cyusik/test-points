<?php
if(isset($_POST['act_log_bd'])) {
	include_once '../script/connect.php';
	session_start();
	$names = $_SESSION['names'];
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=data.csv');
	$output = fopen("php://output", "w");
	$delimiter = ";";
	$table_log = trim(htmlspecialchars(mysqli_real_escape_string($link, $_POST['act_log_bd'])));
	$src_log = array('contests_log', 'add_line_log', 'changes_log', 'tbl_exim_log', 'ign_log', 'control_log', 'auth_adm_log', 'swap_log', 'srh_usr_log');
	if(in_array($table_log, $src_log)) {
		$ex_q = "SELECT  * FROM $table_log ORDER BY id";
		$result_ex = mysqli_query($link, $ex_q);
		if($result_ex) {
			while($row = mysqli_fetch_assoc($result_ex))
			{
				fputcsv($output, $row, ";");
			}
			fclose($output);
			$ex_tb_lg = "INSERT INTO control_log(login_ad,action,field_one,field_two,field_three) VALUES ('$names','export','$table_log','','')";
			$res_ex = mysqli_query($link, $ex_tb_lg) or die ('Error '.mysqli_error($link));
		}
	} else {
		echo "Такого лога не существует";
		$link->close();
	}
	$link->close();
}
?>