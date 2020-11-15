<?php
include_once '../../script/connect.php';
$file_login = "../../logfiles/exchange_log.log";
$fw = fopen($file_login, "a+");
$date = date('Y-m-d h:i:s');
$newdate = date('Y-m-d h:i:s A', strtotime($date));
$recording = 2;
$id = 1;
$query ="UPDATE formobmen SET `open`= '$recording' WHERE id='$id'";
$result = mysqli_query($link, $query) or die('Error: '.mysqli_error($link));
if($result){
	fwrite($fw, $newdate.' CRON close swap => true'."\r\n");
}
$link ->close();
fclose($fw);
?>