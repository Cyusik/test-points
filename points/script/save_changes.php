<?php
if (isset($_POST['id_user']) && isset($_POST['nick_user']) && isset($_POST['point_user']) && isset($_POST['history_user'])) {
	include_once 'connect.php';
	$id_user = $_POST['id_user'];
	$nick_user = trim($_POST['nick_user']);
	$point_user = trim($_POST['point_user']);
	$history_user = $_POST['history_user'];
	$ignor_user = $_POST['ignor_user'];
	$fwhistory = preg_replace("~\s*[\r\n]+~", '/ ', $history_user);
	//------------------------------------------
	session_start();
	$login = $_SESSION['login'];
	$file_login = "../logfiles/points_log.log";
	$fw = fopen($file_login, "a+");
	$date = date('Y-m-d h:i:s');
	$newdate = date('Y-m-d h:i:s A', strtotime($date));
	fwrite($fw, $newdate.' '.$login.' Отредактировал: '.'id=>'.$id_user.'; nick=>'.$nick_user.'; point=>'.$point_user.' history=>'.$fwhistory."\r\n");
	fwrite($fw, $newdate.' save '.$ignor_user."\r\n");
	//-------------------------------------------
if(($ignor_user == 1) || ($ignor_user == 0)) {
	if($nick_user != "") {
		if($point_user != "") {
			$query = "UPDATE tablballs SET nickname='$nick_user', balls='$point_user', history='$history_user', exclude='$ignor_user' WHERE id='$id_user'";
			$result = mysqli_query($link, $query) or die(fwrite($fw, $newdate.' Ошибка save_changes.php(21): '.mysqli_error($link)."\n"));
			if($result) {
				fwrite($fw, $newdate.' save result=>true'."\r\n");
				echo "<div class='modal_div_content' data-title='Данные игрока $nick_user ($id_user) обновлены...'></div>";
			}
		}
		else {
			echo "<div style='color:#ff0505' class='modal_div_content' data-title='Баллы нельзя оставлять пустыми!'></div>";
		}
	} else {
		echo "<div style='color:#ff0505' class='modal_div_content' data-title='Никнейм нельзя оставлять пустым!'></div>";
	}
	} else {
		echo "<div style='color:#ff0505' class='modal_div_content' data-title='Игнор только 0 или 1'></div>";
	}
	fclose($fw);
} else {
	echo "<div class='modal_div_content' data-title='_POST none..'></div>";
}
?>