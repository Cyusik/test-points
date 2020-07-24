<?php
if (isset($_POST['id_user']) && isset($_POST['nick_user'])) {
	include_once 'connect.php';
	$id_user = $_POST['id_user'];
	$nick_user = $_POST['nick_user'];
	if($nick_user == true) {
		$query = "DELETE FROM tablballs WHERE id = '$id_user'";
		$result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));
		echo "<div class='modal_div_content' data-title='Игрок $nick_user (id $id_user) удален из таблицы'></div>";
	} else {
		echo "<div class='modal_div_content' data-title='Никнейм(id $id_user) не может быть пустой'></div>";
	}
}
?>