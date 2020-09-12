<?php
if(isset($_POST['nicknames']) && isset($_POST['login']) && isset($_POST['prizes']) && isset($_POST['points'])){
	include_once '../script/connect.php';
	$nicknames = trim(mysqli_real_escape_string($link, $_POST['nicknames']));
	$login = trim(mysqli_real_escape_string($link, $_POST['login']));
	$prizes = $_POST['prizes'];
	$new_prizes = preg_replace("~\s*[\r\n]+~", '/ ', $prizes);
	$points = trim(intval($_POST['points']));
	//---------------------------------------
	session_start();
	$login = $_SESSION['login'];
	$file_login = "../logfiles/exchange_log.log";
	$fw = fopen($file_login, "a+");
	$date = date('Y-m-d h:i:s');
	$newdate = date('Y-m-d h:i:s A', strtotime($date));
	fwrite($fw, $newdate.' '.$login.' Добавил: '.'nick=>'.$nicknames.'; login=>'.$login.' points=>'.$points.' prizes=>'.$new_prizes."\r\n");
	//---------------------------------------
	$query = "INSERT INTO zapisform (nickname, account, priz, points) VALUES ('$nicknames', '$login', '$prizes', '$points')";
	$result = mysqli_query($link, $query) or die(fwrite($fw, $newdate.' Ошибка add_string_exchange.php(19): '.mysqli_error($link)."\n"));
	if ($result) {
		fwrite($fw, $newdate.' result=>true'."\r\n");
		echo "<div class='modal_div_content' data-title='Строка добавлена...'></div>";
	} else {
		echo "<div class='modal_div_content' data-title='Ошибка добавления...'></div>";
	}
	fclose($fw);
	$link->close();
} else {
	echo "<div class='modal_div_content' data-title='Введите все данные...'></div>";
}
?>
