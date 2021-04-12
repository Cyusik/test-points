<?php
if(isset($_POST['truncateBD'])){
	include_once '../script/connect.php';
	$tableBD_string = trim(htmlspecialchars(mysqli_real_escape_string($link, $_POST['truncateBD'])));
	if($tableBD_string == 'itogobmen') {
		$section = 'results';
	} elseif($tableBD_string == 'tablballs') {
		$section = 'points';
	}elseif($tableBD_string == 'zapisform') {
		$section = 'exchanging';
	} else {
		echo 'error name table db';
		$link->close();
		exit();
	}
	//------------------------------
	session_start();
	$names = $_SESSION['names'];
	//-------------------------------
	echo "<b style='color:red'>Таблица очищена, проверь</b><br><br>";
	$query = "TRUNCATE TABLE $tableBD_string";
	$result = mysqli_query($link, $query) or die('Error: '.mysqli_error($link));
	if($result){
		$trn_log = "INSERT INTO tbl_exim_log(login_ad,section,field_one,field_two,field_three) VALUES ('$names', '$section', 'Очистка таблицы', '', '')";
		$res_trn = mysqli_query($link, $trn_log) or die ('Error '.mysqli_error($link));
		echo "<b style='color:red'>Таблица очищена, проверь</b><br><br>";
	}
	$link->close();
}
?>
