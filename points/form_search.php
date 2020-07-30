<?php
include_once 'script/connect.php';
if (isset($_POST['nick1'])) {
	$output = $_POST['nick1'];
	$sql = "SELECT * FROM tablballs WHERE nickname=$output";
	$result = mysqli_query($link, $sql) or die("Ошибка ".mysqli_error($link));
	if($result) {
		$rows = mysqli_num_rows($result);
		for($i = 0; $i < $rows; ++$i) {
			$row = mysqli_fetch_row($result);
			echo "баллы равны ".$row[2];
		}
	}
	else {
		echo "Нет такого ника в таблице";
	}
}
?>
