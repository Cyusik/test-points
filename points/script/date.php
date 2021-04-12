<?php
if(isset($_POST['date_pnt'])) {
	include_once '../script/connect.php';
	//---------------------------------
	session_start();
	$names = $_SESSION['names'];
	//---------------------------------
	$dates = trim(htmlspecialchars(mysqli_real_escape_string($link, $_POST['date_pnt'])));
	$update_dt_pn = "UPDATE formobmen SET `open`='$dates' WHERE id=2";
	$res_up_dt = mysqli_query($link, $update_dt_pn) or die('Error :'.mysqli_error($link));
	if($res_up_dt) {
		$log_date = "INSERT INTO tbl_exim_log(login_ad,section,field_one,field_two,field_three) VALUES ('$names', 'points', 'Смена поля даты на', '$dates', '')";
		$res_dt_log = mysqli_query($link, $log_date) or die ('Error :'.mysqli_error($link));
		if($res_dt_log) {
			$echo = 'Запись добавлена. ';
		}
		echo "<b style='color:red'>".$echo."Дата изменена на $dates</b>";
	}
	$link->close();
} else {
	echo "не все данные в _POST";
}
?>