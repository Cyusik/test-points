<?php
include_once '../../script/connect.php';
$file_login = "../../logfiles/exchange_log.log";
$fw = fopen($file_login, "a+");
$date = date('Y-m-d h:i:s');
$new_date = date('Y-m-d h:i:s A', strtotime($date));

$query ="UPDATE `formobmen` SET `open`= 1 WHERE `id`=1";
$result = mysqli_query($link, $query) or die('Error: '.mysqli_error($link));

if($result){
	fwrite($fw, $new_date.' CRON open swap => true'."\r\n");
}
$link ->close();
fclose($fw);
