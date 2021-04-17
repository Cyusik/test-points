<?php
if(isset($_POST['nickname']) && isset($_POST['points']) && isset($_POST['history'])) {
	include_once '../script/connect.php';
	$nickname = trim(htmlspecialchars(mysqli_real_escape_string($link,$_POST['nickname'])));
	$balls = trim(htmlspecialchars(mysqli_real_escape_string($link,$_POST['points'])));
	$history = htmlspecialchars(mysqli_real_escape_string($link,$_POST['history']));
	$fwhistory = preg_replace("~\s*[\r\n]+~", '/ ', $history);
	//---------------------------------------
	session_start();
	$names = $_SESSION['names'];
	//---------------------------------------
	if($nickname != "") {
		$select_nickname = "SELECT nickname FROM tablballs WHERE nickname = '$nickname'";
		$rs_sl_nck = mysqli_query($link, $select_nickname) or die ('Error: '.mysqli_error($link));
		if($rs_sl_nck){
			$res_nick = mysqli_fetch_assoc($rs_sl_nck);
			if($res_nick) {
				echo "Такой никнейм есть в таблице";
				$link->close();
				exit();
			}
		}
		$write_player = "INSERT INTO tablballs (nickname,balls,history,exclude,login_one,login_two,login_three) VALUES ('$nickname','$balls','$history','0', '', '', '')";
		$result_write_player = mysqli_query($link, $write_player) or die('Error: '.mysqli_error($link));
		if($result_write_player) {
			$add_line_points = "INSERT INTO add_line_log (login_ad,section,field_one,field_two,field_three) VALUES ('$names', 'points', '$nickname', '$balls', '$history')";
			$add_line_result = mysqli_query($link, $add_line_points) or die('Error: '.mysqli_error($link));
			if($add_line_result) {
				echo "Запись добавлена. ";
			}
			echo "Строка добавлена.";
		}
		else {
			echo "no result from database";
		}
	}
	else {
		echo "Никнейм обязателен";
	}
	$link->close();
} else {
	echo "Не все данные в _POST";
}
?>
