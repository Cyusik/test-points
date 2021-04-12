<?php
if(isset($_POST['act_log_bd'])) {
	include_once '../script/connect.php';
	session_start();
	$names = $_SESSION['names'];
	$table_log = trim(htmlspecialchars(mysqli_real_escape_string($link, $_POST['act_log_bd'])));
	$src_log = array('contests_log', 'add_line_log', 'changes_log', 'tbl_exim_log', 'ign_log', 'control_log', 'auth_adm_log', 'swap_log', 'srh_usr_log');
	if(in_array($table_log, $src_log)) {
		if($table_log == 'control_log') {
			echo "Этот лог нельзя чистить";
			$link->close();
		} else {
			$clear_lg = "TRUNCATE TABLE $table_log";
			$res_cl = mysqli_query($link, $clear_lg) or die('Error: '.mysqli_error($link));
			if($res_cl) {
				$ins_tr_lg = "INSERT INTO control_log(login_ad,action,field_one,field_two,field_three) VALUES ('$names','truncate','$table_log','','')";
				$res_ins = mysqli_query($link,$ins_tr_lg) or die('Error: '.mysqli_error($link));
				if($res_ins) {
					echo "Лог очищен";
				}
			}
		}
	} else {
		echo "Такого лога не существует";
		$link->close();
	}
	$link->close();
} else {
	echo "Не все данные в _POST";
}
?>