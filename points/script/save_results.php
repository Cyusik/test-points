<?php
if (isset($_POST['id_results']) && isset($_POST['dates_results']) && isset($_POST['nick_results']) && isset($_POST['result_results']) && isset($_POST['cause_results'])) {
	include_once 'connect.php';
	$id_results = $_POST['id_results'];
	$dates_results = $_POST['dates_results'];
	$nick_results = trim($_POST['nick_results']);
	$result_results = trim($_POST['result_results']);
	$cause_results = $_POST['cause_results'];
	//-------------------------------------------------------
	session_start();
	$login = $_SESSION['login'];
	$file_login = "../logfiles/results_log.log";
	$fw = fopen($file_login, "a+");
	$date = date('Y-m-d h:i:s');
	$newdate = date('Y-m-d h:i:s A', strtotime($date));
	fwrite($fw, $newdate.' '.$login.' Отредактировал: '.'id=>'.$id_results.'; nick=>'.$nick_results.'; results=>'.$result_results.' cause=>'.$cause_results."\r\n");
	//-------------------------------------------
	if($nick_results != "") {
		if($result_results != "") {
			$query = "UPDATE itogobmen SET nickname='$nick_results', itog='$result_results', prichina='$cause_results' WHERE id='$id_results'";
			$result = mysqli_query($link, $query) or die(fwrite($fw, $newdate.' Ошибка save_results.php(20): '.mysqli_error($link)."\n"));
			if($result) {
				fwrite($fw, $newdate.' save result=>true'."\r\n");
				echo "<div class='modal_div_content' data-title='Результат выдачи у игрока $nick_results ($id_results) обновлен'></div>";
			}
		}
		else {
			echo "<div style='color:#ff0505' class='modal_div_content' data-title='Поле выдачи нельзя оставлять пустым!'></div>";
		}
	} else {
		echo "<div style='color:#ff0505' class='modal_div_content' data-title='Никнейм нельзя оставлять пустым!'></div>";
	}
	fclose($fw);
}
?>
