<?php
if(isset($_POST['nickname']) && isset($_POST['balls']) && isset($_POST['history'])) {
		include_once '../script/connect.php';
		$db_table = "tablballs";
		$nickname = trim($_POST['nickname']);
		$balls = trim($_POST['balls']);
		$history = $_POST ['history'];
		$fwhistory = preg_replace("~\s*[\r\n]+~", '/ ', $history);
	//---------------------------------------
	session_start();
	$login = $_SESSION['login'];
	$file_login = "../logfiles/points_log.log";
	$fw = fopen($file_login, "a+");
	$date = date('Y-m-d h:i:s');
	$newdate = date('Y-m-d h:i:s A', strtotime($date));
	fwrite($fw, $newdate.' '.$login.' Добавил: '.'nick=>'.$nickname.'; point=>'.$balls.'; history=>'.$fwhistory."\r\n");
	//---------------------------------------
		if($nickname != "") {
			if($balls != "") {
				$result = $link->query("INSERT INTO ".$db_table." (nickname,balls,history,exclude) VALUES ('$nickname','$balls','$history', 0)");
				if($result) {
					fwrite($fw, $newdate.' result=>true'."\r\n");
					echo "<div class='modal_div_content' data-title='Строка добавлена...'></div>";
				}
				else {
					echo "<div class='modal_div_content' data-title='no result from database'></div>";
					$result = mysqli_query($link, $query) or die(fwrite($fw, $newdate.' add nickname => '.$nickname.' = Error: '.mysqli_error($link)."\r\n"));
				}
			}
			else {
				echo "<div class='modal_div_content' data-title='Заполни никнейм/баллы'></div>";
			}
		}
		else {
			echo "<div class='modal_div_content' data-title='Заполни никнейм/баллы'></div>";
		}
		fclose($fw);
		$link->close();
}
?>