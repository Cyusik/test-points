<?php
if(isset($_POST['nickname']) && isset($_POST['balls']) && isset($_POST['history']) && isset($_POST['ignory'])) {
		include_once '../script/connect.php';
		$db_table = "tablballs";
		$nickname = trim($_POST['nickname']);
		$balls = trim($_POST['balls']);
		$history = $_POST ['history'];
		$ignory = $_POST['ignory'];
		if($ignory != 0) {
			if($ignory != 1) {
				echo "<div class='modal_div_content' data-title='ignory is only 0 or 1'></div>";
				exit;
			}
		}
		$fwhistory = preg_replace("~\s*[\r\n]+~", '/ ', $history);
	//---------------------------------------
	session_start();
	$login = $_SESSION['login'];
	$logarr = array('points', 'add nickname', $login);
	$valueslog = array($nickname, $balls, $history, $ignory);
	$logarr = array_merge($logarr, $valueslog);
	$file_login = "../logfiles/points_log.log";
	$fw = fopen($file_login, "a+");
	include_once '../script/datetime.php';
	//---------------------------------------
		if($nickname != "") {
				$write_player = "INSERT INTO tablballs (nickname,balls,history,exclude,login_one,login_two,login_three) VALUES ('$nickname','$balls','$history','$ignory', '', '', '')";
				$result = mysqli_query($link, $write_player) or die(fwrite($fw, $newdate.' add nickname => '.$nickname.' = Error: '.mysqli_error($link)."\r\n"));
				if($result) {
					$logarr[] = 'true';
					echo "<div class='modal_div_content' data-title='Строка добавлена...'></div>";
				}
				else {
					fwrite($fw, $newdate.' '.$result."\r\n");
					echo "<div class='modal_div_content' data-title='no result from database'></div>";
				}
		}
		else {
			echo "<div class='modal_div_content' data-title='Никнейм обязателен'></div>";
		}
		require_once 'LogAdminAction.php';
		fclose($fw);
		$link->close();
}
?>