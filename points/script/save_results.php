<?php
if (isset($_POST['id_results']) && isset($_POST['dates_results']) && isset($_POST['nick_results']) && isset($_POST['result_results']) && isset($_POST['cause_results'])) {
	include_once 'connect.php';
	$id_results = $_POST['id_results'];
	$dates_results = $_POST['dates_results'];
	$nick_results = $_POST['nick_results'];
	$result_results = $_POST['result_results'];
	$cause_results = $_POST['cause_results'];
	if($nick_results == true) {
		if($result_results == true) {
			$query = "UPDATE itogobmen SET nickname='$nick_results', itog='$result_results', prichina='$cause_results' WHERE id='$id_results'";
			$result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));
			if($result) {
				echo "<div class='modal_div_content' data-title='Результат выдачи у игрока $nick_results ($id_results) обновлен'></div>";
			}
		}
		else {
			echo "<div style='color:#ff0505' class='modal_div_content' data-title='Поле выдачи нельзя оставлять пустым!'></div>";
		}
	} else {
		echo "<div style='color:#ff0505' class='modal_div_content' data-title='Никнейм нельзя оставлять пустым!'></div>";
	}
}
?>
