<?php
if(isset($_POST['nicknames']) && isset($_POST['login']) && isset($_POST['prizes']) && isset($_POST['points'])){
	include_once '../script/connect.php';
	$nicknames = trim(mysqli_real_escape_string($link, $_POST['nicknames']));
	$login = trim(mysqli_real_escape_string($link, $_POST['login']));
	$prizes = trim(mysqli_real_escape_string($link, $_POST['prizes']));
	$points = trim(intval($_POST['points']));
	$query = "INSERT INTO zapisform (nickname, account, priz, points) VALUES ('$nicknames', '$login', '$prizes', '$points')";
	$result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));
	if ($result) {
		echo "<div class='modal_div_content' data-title='Строка добавлена...'></div>";
	} else {
		echo "<div class='modal_div_content' data-title='Ошибка добавления...'></div>";
	}
	$link->close();
} else {
	echo "<div class='modal_div_content' data-title='Введите все данные...'></div>";
}
?>
