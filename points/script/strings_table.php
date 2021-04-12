<?php
include_once '../script/connect.php';
$strings_table = ("SELECT COUNT(*) as count FROM $tableBD_string");
$result_str = mysqli_query($link, $strings_table) or die("Ошибка ".mysqli_error($link));
if($result_str){
	$strings = $result_str->fetch_assoc();
	$strings = $strings['count'];
	echo 'Строк в таблице: <b style="color:green">'.$strings.'</b>';
	echo '<br><br>';
}
?>