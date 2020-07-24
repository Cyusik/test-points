<?php
	include_once 'connect.php';
	$query = "SELECT * FROM formobmen WHERE id=2";
	$result = mysqli_query($link, $query);
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
		echo "<b style='color:red'>Дата изменена на $update_date</b>";
	}
//}

?>