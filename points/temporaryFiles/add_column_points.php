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
</div>
<?php
if (isset($_POST['addColumn'])) {
	include_once '../script/connect.php';
	$link->query("ALTER TABLE `zapisform` ADD `points` INT(10) NOT NULL AFTER `priz`");
	$result = mysqli_query($link, "SHOW COLUMNS FROM `zapisform`");
	if (mysqli_num_rows($result) > 0) {
		while ($row = $result->fetch_assoc()) {
			echo '<pre>';
			print_r($row);
		}
	} $link->close();
	$result->free();
}
if (isset($_POST['delfile'])) {
	//include_once 'connect.php';
	unlink('add_column_points.php');
	echo 'файл удален';
}
?>

