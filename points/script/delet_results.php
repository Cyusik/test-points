<?php
if (isset($_POST['id_results']) && isset($_POST['nick_results'])) {
	include_once '../script/connect.php';
	$id_results = trim(htmlspecialchars(mysqli_real_escape_string($link, $_POST['id_results'])));
	$nick_results = trim(htmlspecialchars(mysqli_real_escape_string($link, $_POST['nick_results'])));
	//-------------------------------------------
	session_start();
	$names = $_SESSION['names'];
	//-------------------------------------------
	if($nick_results == true) {
		$query = "DELETE FROM itogobmen WHERE id = '$id_results'";
		$result = mysqli_query($link, $query) or die('Error: '.mysqli_error($link));
		if($result) {
			$del_res_sql = "INSERT INTO changes_log(login_ad,section,field_one,field_two,field_three,field_four) VALUES ('$names', 'results', '$nick_results', 'row_deleted', '', '')";
			$res_del = mysqli_query($link, $del_res_sql) or die('Error :'.mysqli_error($link));
			if($res_del) {
				$echo = 'Запись добавлена. ';
			}
			echo "<div class='modal_div_content' data-title='".$echo."Результат $nick_results удален'></div>";
		}
	} else {
		echo "<div class='modal_div_content' data-title='Никнейм не может быть пустой'></div>";
	}
} else {
	echo "<div class='modal_div_content' data-title='Не все данные в _POST'></div>";
}
?>
