<?php
if (isset($_POST['st_ignore']) && isset($_POST['search_ignore'])) {
	include_once '../script/connect.php';
	$st_ignore = trim(htmlspecialchars(mysqli_real_escape_string($link, $_POST['st_ignore'])));
	$search_ignore = trim(htmlspecialchars(mysqli_real_escape_string($link, $_POST['search_ignore'])));
	if ($st_ignore == 'add_ignore') {
		$action = 'Добавил в ЧС';
		$new_ig = 1;
	} elseif($st_ignore == 'del_ignore') {
		$action = 'Убрал из ЧС';
		$new_ig = 0;
	} else {
		echo 'Неверный параметр';
		$link->close();
		exit();
	}
	//--------------------------------
	session_start();
	$names = $_SESSION['names'];
	//---------valid------------------
	$sql_sch_ig = "SELECT nickname, exclude FROM tablballs WHERE nickname ='%s'";
	$query = sprintf($sql_sch_ig, mysqli_real_escape_string($link, $search_ignore));
	$res_sql_ig = mysqli_query($link, $query) or die('Error :'.mysqli_error($link));
	if($res_sql_ig) {
		$rows = mysqli_num_rows($res_sql_ig);
		if($rows > 0) {
			for($i = 0; $i < $rows; ++$i) {
				$st_ig = mysqli_fetch_row($res_sql_ig);
				$st_ig = $st_ig[1];
			}
		}
		else {
			echo "Никнейм не найден";
		}
	} else {
		echo "empty result";
	}
	//--------------------------------
	if($st_ig != "") {
		if($st_ig != $new_ig) {
			$upd_ig = "UPDATE `tablballs` SET `exclude` = '$new_ig' WHERE `nickname` = '$search_ignore'";
			$res_upd = mysqli_query($link, $upd_ig) or die ('Error :'.mysqli_error($link));
			if($res_upd) {
				$ins_ig_log = "INSERT INTO ign_log(login_ad,action,ig_nickname,f_time) VALUES ('$names', '$action', '$search_ignore', '')";
				$res_log = mysqli_query($link, $ins_ig_log) or die('Error :'.mysqli_error($link));
				if($res_log) {
					$echo = 'Запись добавлена. ';
				}
				echo $echo.$action;
			}
		} else {
			echo 'Неверный параметр';
		}
	} else {
		echo 'Проверьте правильность введенных данных';
	}
	//$res_log->free();
	$link->close();
} else {
	echo 'Не все параметры в _POST';
}
?>