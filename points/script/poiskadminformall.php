<?php
if (isset($_POST['output1']) && !empty($_POST['monthFromAll']) && !empty($_POST['monthToAll'])) {
	include_once '../script/connect.php';
	$output1 = $_POST['output1'];
	$monthFromAll = trim(mysqli_real_escape_string($link, $_POST['monthFromAll']));
	$monthToAll = trim(mysqli_real_escape_string($link, $_POST['monthToAll']));
	if($monthFromAll < $monthToAll) {
		mysqli_query($link, "SET NAMES 'utf8'");
		$query = "SELECT * FROM zapisform WHERE dates BETWEEN '$monthFromAll%' AND '$monthToAll%' ORDER BY dates DESC LIMIT 500";
		$result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));
		if($result) {
			$rows = mysqli_num_rows($result);// количество полученных строк
			if ($rows > 0) {
			echo "<table class='table_dark2'><tr>
			<th>id</th>
			<th>Дата заявки</th>
			<th>Никнейм</th>
			<th>Логин</th>
			<th>Приз</th>
			<th>Баллы</th>
				</tr>";
			for($i = 0; $i < $rows; ++$i) {
				$row = mysqli_fetch_row($result);
				echo "<tr>";
				for($j = 0; $j < 6; ++$j)
					echo nl2br("<td style='border-bottom:1px solid white;'>$row[$j]</td>");
				echo "</tr>";
			}
			} else {
				echo "<table class='table_dark2'>
				<tr>
					<th>Ошибка</th>
				</tr>
				<tr>
					<td>Нет заявок за выбранный период</td>
				</tr>";
			}
		}
		$link->close();
	echo "</table>";
	} else {
		echo "<table class='table_dark2'>
				<tr>
					<th>Ошибка</th>
				</tr>
				<tr>
					<td>Дата ОТ не может быть больше ДО</td>
				</tr>";
	}
} else {
	echo "<table class='table_dark2'>
				<tr>
					<th>Ошибка</th>
				</tr>
				<tr>
					<td>Необходимо указать даты</td>
				</tr>";
}
?>