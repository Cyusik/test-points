<?php
include_once __DIR__ . '/../connect.php';
$query ="UPDATE `formobmen` SET `open`= 1 WHERE `id`=1";
$result = mysqli_query($link, $query) or die('Error: '.mysqli_error($link));
if($result){
	$cron_sw = "INSERT INTO tbl_exim_log(login_ad,section,field_one,field_two,field_three) VALUES ('CRON', 'exchanging', 'CRON', 'Открыл опрос', '')";
	$res_cron = mysqli_query($link, $cron_sw) or die ('Error '.mysqli_error($link));
}
$link ->close();