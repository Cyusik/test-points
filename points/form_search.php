<?php
include_once 'script/connect.php';
$output = '';
$sql = "SELECT * FROM tablballs WHERE nickname LIKE '".$_POST['search']."' ";
$result = mysqli_query($link, $sql) or die("Ошибка ".mysqli_error($link));
if($result) {
	$rows = mysqli_num_rows($result);
	for($i = 0; $i < $rows; ++$i) {
						$row = mysqli_fetch_row($result);
		$output .='"баллы равны "'.$row[2];
	}
	echo $output;
} else {
	echo "Нет такого ника в таблице";
}
?>
