<?php
header("Content-type: text/html; Charset=utf-8");
?>
	<div style="margin-top:100px; margin-left:100px">
		<form method="post" action="">
			<input type="hidden" name="addColumn" value="addColumn">
			<input type="submit" name="add" value="Добавить столбец">
		</form>
	</div><br><br>
	<div style="margin-left:100px">
		<form method="post" action="">
			<input type="hidden" name="delfile" value="delfile">
			<input type="submit" name="del" value="Удалить скрипт">
		</form>
	</div><br><br>
	<div style="margin-left:100px">
		<form method="post" action="">
			<input type="hidden" name="adduser" value="adduser">
			<input type="submit" name="addusers" value="Добавить админа">
		</form>
	</div>
<?php
if (isset($_POST['addColumn'])) {
	include_once '../script/connect.php';
	$link->query("ALTER TABLE `users` ADD `role` INT(2) NOT NULL AFTER `password_user`");
	$result = mysqli_query($link, "SHOW COLUMNS FROM `users`");
	if (mysqli_num_rows($result) > 0) {
		while ($row = $result->fetch_assoc()) {
			echo '<pre>';
			print_r($row);
		}
	} $link->close();
	$result->free();
}
if (isset($_POST['adduser'])) {
	include_once '../script/connect.php';
	$link->query("INSERT INTO `users` (`id`, `login_user`, `password_user`, `role`) VALUES (NULL, 'login_cyusik', MD5('cm2a0ms4'), '1')");
	$result = mysqli_query($link, "SELECT * FROM users WHERE login_user='login_cyusik'");
	if($result) {
		$rows = mysqli_num_rows($result);
		$row = mysqli_fetch_row($result);
			echo '<pre>';
			print_r($row);
		}
	$link->close();
	$result->free();
	}
if (isset($_POST['delfile'])) {
	unlink('add_column_points.php');
	echo 'файл удален';
}
?>