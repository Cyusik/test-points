<?php
if (isset($_POST['id_results']) && isset($_POST['nick_results'])) {
	include_once 'connect.php';
	$id_results = $_POST['id_results'];
	$nick_results = $_POST['nick_results'];
	if($nick_results == true) {
		$query = "DELETE FROM itogobmen WHERE id = '$id_results'";
		$result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));
		echo "<div class='modal_div_content' data-title='Итог выдачи $nick_results ($id_results) удален'></div>";
	} else {
		echo "<div class='modal_div_content' data-title='Никнейм($id_results) не может быть пустой'></div>";
	}
}
?>
