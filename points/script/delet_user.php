<?php
if (isset($_POST['id_user']) && isset($_POST['nick_user'])) {
	include_once '../script/connect.php';
	$id_user = trim(htmlspecialchars(mysqli_real_escape_string($link, $_POST['id_user'])));
	$nick_user = trim(htmlspecialchars(mysqli_real_escape_string($link, $_POST['nick_user'])));
	//-------------------------------------------
	session_start();
	$names = $_SESSION['names'];
	//-------------------------------------------
	if($nick_user == true) {
		$query = "DELETE FROM tablballs WHERE id = '$id_user'";
		$result = mysqli_query($link, $query) or die('Error: '.mysqli_error($link));
		if($result) {
			$del_pnt_sql = "INSERT INTO changes_log(login_ad,section,field_one,field_two,field_three,field_four) VALUES ('$names', 'points', '$nick_user', 'row_deleted', '', '')";
			$res_del = mysqli_query($link, $del_pnt_sql) or die('Error :'.mysqli_error($link));
			if($res_del) {
				$echo = 'Запись добавлена. ';
			}
			echo "<div class='modal_div_content' data-title='".$echo."Результат $nick_user удален'></div>";
		}
	} else {
		echo "<div class='modal_div_content' data-title='Никнейм не может быть пустой'></div>";
	}
}  else {
	echo "<div class='modal_div_content' data-title='Не все данные в _POST'></div>";
}
?>