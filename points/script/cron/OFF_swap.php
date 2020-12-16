<?php
include_once __DIR__ . '/../connect.php';
include_once __DIR__ . '/../datetime.php';
$file_login = __DIR__ . "/../../logfiles/exchange_log.log";

$fw = fopen($file_login, "a+");

$query ="UPDATE `formobmen` SET `open`= 2 WHERE `id`=1";
$result = mysqli_query($link, $query) or die('Error: '.mysqli_error($link));

if($result){
	fwrite($fw, $newdate.' CRON close swap => true'."\r\n");
}
$link ->close();
fclose($fw);
