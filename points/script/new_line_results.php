<?php
if (isset($_POST['dates_results']) && isset($_POST['nickname_results'])  && isset($_POST['option_results']) && isset($_POST['cause_results'])) {
	include_once '../script/connect.php';
	$dates = trim(htmlspecialchars(mysqli_real_escape_string($link, $_POST['dates_results'])));
	$dates = str_replace("T", " ", $dates);
	function validateDate($date, $format = 'Y-m-d H:i:s')
	{
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}
	if(validateDate($dates, 'Y-m-d H:i:s') == false) {
		echo "Некорректная дата";
		$link->close();
		exit();
	}
	$nickname = trim(htmlspecialchars(mysqli_real_escape_string($link, $_POST['nickname_results'])));
	$results = trim(htmlspecialchars(mysqli_real_escape_string($link, $_POST['option_results'])));
	$cause = trim(htmlspecialchars(mysqli_real_escape_string($link, $_POST['cause_results'])));
	//---------------------------------------
	session_start();
	$names = $_SESSION['names'];
	//---------------------------------------
	if($nickname != "") {
		if($results != "") {
			$write_results = "INSERT INTO itogobmen (dates,nickname,itog,prichina) VALUES ('$dates', '$nickname', '$results', '$cause')";
			$result_write = mysqli_query($link, $write_results) or die ('Error: '.mysqli_error($link));
			if($result_write) {
				$all_line_results = "INSERT INTO add_line_log (login_ad,section,field_one,field_two,field_three,field_four) VALUES ('$names', 'results', '$dates', '$nickname', '$results', '$cause')";
				$add_line_result = mysqli_query($link, $all_line_results) or die('Error: '.mysqli_error($link));
				if($add_line_result) {
					echo "Запись добавлена. ";
				}
				echo "Строка добавлена.";
			}
			else {
				echo "no result from database";
			}
		}else {
			echo "Выбери итог выдачи";
		}
	}else {
		echo "Никнейм обязателен";
	}
	$link->close();
} else {
	echo "Не все данные в _POST";
}
?>