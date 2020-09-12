<?php
	include_once 'connect.php';
	session_start();
	$login = $_SESSION['login'];
	$file_login = "../logfiles/points_log.log";
	$fw = fopen($file_login, "a+");
	$date = date('Y-m-d h:i:s');
	$newdate = date('Y-m-d h:i:s A', strtotime($date));
	$query = "SELECT * FROM formobmen WHERE id=2";
	$result = mysqli_query($link, $query) or die(fwrite($fw, $newdate.'Ошибка date.php(10): '.mysqli_error($link)."\n"));
	$row = mysqli_fetch_row($result);
	$date = $row[0];
	if ($date == false){
		if (isset($_POST['update_date'])) {
			$update_date =$_POST['update_date'];
			$result = $link->query("INSERT INTO formobmen (`open`) VALUES ('$update_date')");
			echo "Строка добавлена, перезапусти страницу";
		}
	} else {
		$update_date =$_POST['update_date'];
		$result = $link->query("UPDATE formobmen SET `open`='$update_date' WHERE id=2");
		fwrite($fw, $newdate.' '.$login.' Изменил дату на: '.$update_date."\r\n");
		echo "<b style='color:red'>Дата изменена на $update_date</b>";
	}
fclose($fw);
?>