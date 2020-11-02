<?php
set_time_limit(380);
ini_set('memory_limit', '128M');

if (!empty($_FILES['countfile'])) {
	echo '<pre>';
	print_r($_FILES);
	$whiteformat = '.csv';
	$whitetype = array('text/csv', 'application/vnd.ms-excel');

//	$target_file = $target_dir . basename($_FILES["countfile"]["name"]);
//	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	//echo '<pre>';
	//echo $_FILES['countfile']['tmp_name'].'<br>';
	//echo $_FILES['countfile']['type'].'<br>';
	//print_r($_FILES);
} else
{
	echo 'Fail...';
}
?>
