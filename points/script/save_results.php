<?php
if (isset($_POST['id_results']) && isset($_POST['dates_results']) && isset($_POST['nick_results']) && isset($_POST['result_results']) && isset($_POST['cause_results'])) {
	include_once 'connect.php';
	$id_results = trim(htmlspecialchars(mysqli_real_escape_string($link, $_POST['id_results'])));
	$dates_results = trim(htmlspecialchars(mysqli_real_escape_string($link, $_POST['dates_results'])));
	$nick_results = trim(htmlspecialchars(mysqli_real_escape_string($link, $_POST['nick_results'])));
	$result_results = trim(htmlspecialchars(mysqli_real_escape_string($link, $_POST['result_results'])));
	$cause_results = trim(htmlspecialchars(mysqli_real_escape_string($link, $_POST['cause_results'])));
	$update_array = array('id' => $id_results, 'dates' => $dates_results, 'nickname' => $nick_results, 'itog' => $result_results, 'prichina' => $cause_results);
	//-------------------------------------------------------
	session_start();
	$names = $_SESSION['names'];
	$logarr = array($names, 'results');
	//-------------------------------------------
	if($nick_results != "") {
		if($result_results != "") {
			$select_user = "SELECT * FROM itogobmen WHERE id = '$id_results'";
			$resultSelect = mysqli_query($link, $select_user) or die('Error '.mysqli_error($link));
			$logarrres = mysqli_fetch_assoc($resultSelect);
			//------для лога изменений ника---------
			if($logarrres['nickname'] != $nick_results) {
				$lognickname = 'old-> '.$logarrres['nickname']."\n".'new-> '.$nick_results."\n";
				$logarr[] = $lognickname;
			} else {
				$lognickname = $logarrres['nickname'];
				$logarr[] = $lognickname;
			}
			//-----для лога изменений выдачи----------
			if($logarrres['itog'] != $result_results) {
				$logresult = 'old-> '.$logarrres['itog']."\n".'new-> '.$result_results."\n";
				$logarr[] = $logresult;
			}
			//----для лога изменений причины-----------
			if($logarrres['prichina'] != $cause_results) {
				$logcause = 'old-> '.$logarrres['prichina']."\n".'new-> '.$cause_results."\n";
				$logarr[] = $logcause;
			}
			//--------------- end
			$itogarr = array_diff_assoc($update_array, $logarrres); // ---поиск изменений для обновления
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
			$query = "UPDATE itogobmen SET $update_sql WHERE id='$id_results'";
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
				$save_res_sql = "INSERT INTO changes_log(login_ad,section,field_one,field_two,field_three,field_four) VALUES ($insertlogarr)";
				$res_sql = mysqli_query($link, $save_res_sql) or die('Error :'.mysqli_error($link));
				if($res_sql) {
					$echo = 'Запись добавлена. ';
				}
				echo "<div class='modal_div_content' data-title='".$echo."Результат $nick_results обновлен'></div>";
			}
		}
		else {
			echo "<div style='color:#ff0505' class='modal_div_content' data-title='Поле выдачи нельзя оставлять пустым!'></div>";
		}
	} else {
		echo "<div style='color:#ff0505' class='modal_div_content' data-title='Никнейм нельзя оставлять пустым!'></div>";
	}
	unset($update_array);
	unset($logarrres);
	unset($itogarr);
} else {
	echo "<div class='modal_div_content' data-title='_POST none..'></div>";
}
?>
