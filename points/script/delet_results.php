<?php
if (isset($_POST['id_results']) && isset($_POST['nick_results'])) {
	include_once 'connect.php';
	$id_results = $_POST['id_results'];
	$nick_results = $_POST['nick_results'];
	//-------------------------------------------
	session_start();
	$login = $_SESSION['login'];
	$file_login = "../logfiles/results_log.log";
	$fw = fopen($file_login, "a+");
	include_once 'datetime.php';
	fwrite($fw, $newdate.' '.$login.' Удалил: '.'id=>'.$id_results.'; nick=>'.$nick_results."\r\n");
	//-------------------------------------------
	if($nick_results == true) {
		$query = "DELETE FROM itogobmen WHERE id = '$id_results'";
		$result = mysqli_query($link, $query) or die(fwrite($fw, $newdate.'Ошибка delet_results.php(17): '.mysqli_error($link)."\n"));
		if($result) {
			fwrite($fw, $newdate.' delet result=>true'."\r\n");
		}
		//echo "<div class='modal_div_content' data-title='Итог выдачи $nick_results ($id_results) удален'></div>";
	} else {
		echo "<div class='modal_div_content' data-title='Никнейм($id_results) не может быть пустой'></div>";
	}
	fclose($fw);
}
?>
