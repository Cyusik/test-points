<?php
if(isset($_POST['id_user']) && isset($_POST['nick_user']) && isset($_POST['point_user']) && isset($_POST['history_user']) && isset($_POST['login_one']) && isset($_POST['login_two']) && isset($_POST['login_three'])) {
	include_once 'connect.php';
	$id_user = $_POST['id_user'];
	$nick_user = trim($_POST['nick_user']);
	$point_user = trim($_POST['point_user']);
	$history_user = $_POST['history_user'];
	$history_user = str_replace("\r", "", $history_user);
	$login_one = strtolower(trim($_POST['login_one']));
	$login_two = strtolower(trim($_POST['login_two']));
	$login_three = strtolower(trim($_POST['login_three']));
	$update_array = array('id' => $id_user, 'nickname' => $nick_user, 'balls' => $point_user, 'history' => $history_user, 'login_one' => $login_one, 'login_two' => $login_two, 'login_three' => $login_three);
	//------------------------------------------
	session_start();
	$names = $_SESSION['names'];
	$logarr = array($names, 'points');
	//-------------------------------------------
		if($nick_user != "" && $id_user != "") {
			$select_user = "SELECT id,nickname,balls,history,login_one,login_two,login_three FROM tablballs WHERE id = '$id_user'";
			$resultSelect = mysqli_query($link, $select_user) or die('Error '.mysqli_error($link));
			$logarrres = mysqli_fetch_assoc($resultSelect);
			//--------для лога ников
				if($nick_user != $logarrres['nickname']) {
					$nickname_log = 'old-> '.$logarrres['nickname']."\n".'new-> '.$nick_user;
					$logarr[] = $nickname_log;
				} else {
					$nickname_log = $logarrres['nickname'];
					$logarr[] = $logarrres['nickname'];
				}
			//----------------------
			//--------для лога баллов
			if($point_user != $logarrres['balls']) {
				$points_log = 'old-> '.$logarrres['balls']."\n".'new-> '.$point_user;
				$logarr[] = $points_log;
			}
			//-----------------------
			//---------для лога истории
			$history_user_admin = explode("\n", $history_user);
			$history_log = explode("\n", $logarrres['history']);
			$addhist = array_diff($history_user_admin, $history_log);
			$delhist = array_diff($history_log, $history_user_admin);
			if(!empty($addhist)) {
				$addhist = 'new-> '.implode("\n", $addhist);
			} else {
				unset($addhist);
			}
			if(!empty($delhist)) {
				$delhist = 'old-> '.implode("\n", $delhist);
			} else {
				unset($delhist);
			}
			if(($addhist != "") && ($delhist != "")) {
				$history_log = $addhist."\n".$delhist;
			} else {
				$history_log = $addhist.$delhist;
			}
			if($history_log) {
				$logarr[] = $history_log;
			}
			//-----------------
			//---------для лога логинов------------
			$arr_login = array();
				if($login_one != $logarrres['login_one']) {
					$arr_login[] = 'old-> '.$logarrres['login_one']."\n".'new-> '.$login_one;
				}
				if($login_two != $logarrres['login_two']) {
					$arr_login[] = 'old-> '.$logarrres['login_two']."\n".'new-> '.$login_two;
				}
			if($login_three != $logarrres['login_three']) {
				$arr_login[] = 'old-> '.$logarrres['login_three']."\n".'new-> '.$login_three;
			}
			if($arr_login) {
				$logarr[] = implode("\n", $arr_login);
			}
			//-------------------------------------
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
			$result = mysqli_query($link, $query) or die('Error: '.mysqli_error($link));
			if($result) {
				$insertlogarr = array();
				foreach($logarr as $data) {
					$insertlogarr[] = "'".$data."'";
				}
				$countarr = count($insertlogarr);
				if ($countarr < 6) {
					for($i = $countarr;$i < 6; $i++) {
						$insertlogarr[] = "'".''."'";
					}
				}
				$insertlogarr = implode(", ", $insertlogarr);
				$save_pnt_sql = "INSERT INTO changes_log(login_ad,section,field_one,field_two,field_three,field_four) VALUES ($insertlogarr)";
				$res_sql = mysqli_query($link, $save_pnt_sql) or die('Error :'.mysqli_error($link));
				if($res_sql) {
					$echo = 'Запись добавлена. ';
				}
				echo "<div class='modal_div_content' data-title='".$echo."Данные $nick_user обновлены.'></div>";
			}
		}
		else {
			echo "<div style='color:#ff0505' class='modal_div_content' data-title='Неверные данные'></div>";
		}
	unset($update_array);
	unset($logarrres);
	unset($itogarr);
	unset($logResultSave);
}
else {
	echo "<div class='modal_div_content' data-title='_POST none..'></div>";
}
?>