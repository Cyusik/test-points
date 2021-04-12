<?php
if(isset($_POST['nickname_swap']) && isset($_POST['login_swap']) && isset($_POST['history_swap']) && isset($_POST['points_swap'])){
	include_once '../script/connect.php';
	$nicknames = trim(htmlspecialchars(mysqli_real_escape_string($link, $_POST['nickname_swap'])));
	$login = trim(htmlspecialchars(mysqli_real_escape_string($link, $_POST['login_swap'])));
	$prizes = htmlspecialchars(mysqli_real_escape_string($link, $_POST['history_swap']));
	//$new_prizes = preg_replace("~\s*[\r\n]+~", '/ ', $prizes);
	$points = trim(intval($_POST['points_swap']));
	//---------------------------------------
	session_start();
	$names = $_SESSION['names'];
	//---------------------------------------
	if($nicknames) {
		if($login) {
			$write_swap = "INSERT INTO zapisform (nickname, account, priz, points, status) VALUES ('$nicknames', '$login', '$prizes', '$points', 'manually')";
			$result_swap = mysqli_query($link, $write_swap) or die('Error: '.mysqli_error($link));
			if($result_swap) {
				$add_line_swap = "INSERT INTO add_line_log (login_ad,section,field_one,field_two,field_three,field_four) VALUES ('$names', 'swap', '$nicknames', '$login', '$prizes', '$points')";
				$result_line_swap = mysqli_query($link, $add_line_swap) or die('Error: '.mysqli_error($link));
				if($result_line_swap) {
					echo "Запись добавлена. ";
				}
				echo "Строка добавлена.";
			} else {
				echo "no result from database";
			}
		} else {
			echo "Укажите логин";
		}
	} else {
		echo "Укажите никнейм";
	}
} else {
	echo "Не все данные в _POST";
}
?>