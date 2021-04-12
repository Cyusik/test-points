<?php
if(isset($_POST['open'])){
	include_once '../script/connect.php';
	session_start();
	$names = $_SESSION['names'];
	$stat = 1;
	$id = 1;
	$query ="UPDATE formobmen SET `open`= '$stat' WHERE id='$id'";
	$result = mysqli_query($link, $query) or die('Error: '.mysqli_error($link));
	if($result){
		$ex_tb_pn = "INSERT INTO tbl_exim_log(login_ad,section,field_one,field_two,field_three) VALUES ('$names', 'exchanging', 'Открыл опрос', '', '')";
		$res_ex = mysqli_query($link, $ex_tb_pn) or die ('Error '.mysqli_error($link));
	}
	$link ->close();
	header('location: ../admin/description.php?action=ex_im_exch.php');
}
if(isset($_POST['close'])){
	include_once '../script/connect.php';
	session_start();
	$names = $_SESSION['names'];
	$stat = 2;
	$id = 1;
	$query ="UPDATE formobmen SET `open`= '$stat' WHERE id='$id'";
	$result = mysqli_query($link, $query) or die('Error: '.mysqli_error($link));
	if($result){
		$ex_tb_pn = "INSERT INTO tbl_exim_log(login_ad,section,field_one,field_two,field_three) VALUES ('$names', 'exchanging', 'Закрыл опрос', '', '')";
		$res_ex = mysqli_query($link, $ex_tb_pn) or die ('Error '.mysqli_error($link));
	}
	$link ->close();
	header('location: ../admin/description.php?action=ex_im_exch.php');
}
?>