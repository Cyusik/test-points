<?php
if(isset($_POST['id_user']) && isset($_POST['nick_user']) && isset($_POST['point_user']) && isset($_POST['history_user']) && isset($_POST['login_one']) && isset($_POST['login_two']) && isset($_POST['login_three'])) {
	include_once 'connect.php';
	$id_user = $_POST['id_user'];
	$nick_user = trim($_POST['nick_user']);
	$point_user = trim($_POST['point_user']);
	$history_user = $_POST['history_user'];
	$ignor_user = $_POST['ignor_user'];
	$login_one = strtolower(trim($_POST['login_one']));
	$login_two = strtolower(trim($_POST['login_two']));
	$login_three = strtolower(trim($_POST['login_three']));
	$update_array = array('id' => $id_user, 'nickname' => $nick_user, 'balls' => $point_user, 'history' => $history_user, 'exclude' => $ignor_user, 'login_one' => $login_one, 'login_two' => $login_two, 'login_three' => $login_three);
	//------------------------------------------
	session_start();
	$login = $_SESSION['login'];
	$file_login = "../logfiles/points_log.log";
	$fw = fopen($file_login, "a+");
	include_once 'datetime.php';
	//-------------------------------------------
	if(($ignor_user == 1) || ($ignor_user == 0)) {
		if($nick_user != "") {
			$select_user = "SELECT * FROM tablballs WHERE id = '$id_user'";
			$resultSelect = mysqli_query($link, $select_user) or die('Error '.mysqli_error($link));
			$logarrres = mysqli_fetch_assoc($resultSelect);
			//---------для лога истории
				$history_user_admin = explode("\n", $history_user);
				$history_log = explode("\n", $logarrres['history']);
				$addhist = array_diff($history_user_admin, $history_log);
				$delhist = array_diff($history_log, $history_user_admin);
				if(!empty($addhist)) {
					$addhist = 'new-> '.implode("new-> ", $addhist);
				} else {
					unset($addhist);
				}
				if(!empty($delhist)) {
					$delhist = 'del-> '.implode("del-> ", $delhist); // Пишет в лог ArrayArray... исправить
				} else {
					unset($delhist);
				}
				$history_log = $addhist.$delhist;
			//-----------------
			//--------для лога баллов
				if($point_user != $logarrres['balls']) {
					$points_log = 'before-> '.$logarrres['balls']."\n".'after-> '.$point_user."\n";
				}
			//-----------------------
			//--------для лога ников
				if($nick_user != $logarrres['nickname']) {
					$nickname_log = 'before-> '.$logarrres['nickname']."\n".'after-> '.$nick_user."\n";
				} else {
					$nickname_log = $logarrres['nickname'];
				}
			//----------------------
			$itogarr = array_diff_assoc($update_array, $logarrres);
			if(!empty($itogarr)) {
				foreach($itogarr as $tbcolumn => $data) {
						$update_sql[] = $tbcolumn."="."'".$data."'";
				}
			}
			else {
				echo "<div class='modal_div_content' data-title='Нет изменений для обновления...'></div>";
				exit();
			}
			$update_sql = implode(", ", $update_sql);
			$query = "UPDATE tablballs SET $update_sql WHERE id='$id_user'";
			$result = mysqli_query($link, $query) or die(fwrite($fw, $newdate.' Ошибка save_changes.php(21): '.mysqli_error($link)."\n"));
			if($result) {
				$logarr = array('points', 'save changes', $login, $logarrres['id'], $nickname_log);
				unset($itogarr['nickname']);
				$itogarr['balls'] = $points_log;
				$itogarr['history'] = $history_log;
				if (empty($itogarr['history'])) {
					unset($itogarr['history']);
				}
				if(empty($itogarr['balls'])) {
					unset($itogarr['balls']);
				}
				$logarr = array_merge($logarr, $itogarr);
				echo '<pre>';
				print_r($logarr);
				echo '</pre>';
				echo "<div class='modal_div_content' data-title='Данные игрока $nick_user ($id_user) обновлены...'></div>";
			}
		}
		else {
			echo "<div style='color:#ff0505' class='modal_div_content' data-title='Никнейм нельзя оставлять пустым!'></div>";
		}
	}
	else {
		echo "<div style='color:#ff0505' class='modal_div_content' data-title='Игнор только 0 или 1'></div>";
	}
	require_once 'LogAdminAction.php';
	fclose($fw);
	unset($update_array);
	unset($logarrres);
	unset($itogarr);
	unset($logResultSave);
}
else {
	echo "<div class='modal_div_content' data-title='_POST none..'></div>";
}
?>