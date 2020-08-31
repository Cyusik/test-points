<?php
if (!empty($_POST['names2']) && !empty($_POST['monthFrom']) && !empty($_POST['monthTo'])) {
		include_once '../script/connect.php';
		$names2 =trim(mysqli_real_escape_string($link, $_POST['names2']));
		$monthFrom = trim(mysqli_real_escape_string($link, $_POST['monthFrom']));
		$monthTo = trim(mysqli_real_escape_string($link, $_POST['monthTo']));
		if ($monthFrom < $monthTo) {
		mysqli_query($link, "SET NAMES 'utf8'");
		$query = "SELECT * FROM zapisform WHERE dates BETWEEN '$monthFrom%' AND '$monthTo%' AND nickname='$names2' ORDER BY dates DESC LIMIT 500";
		$result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));
		if($result) {
			$rows = mysqli_num_rows($result);
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
					<td>Ничего не найдено</td>
				</tr>";
			}
		}$link->close();
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
					<td>Необходимо указать даты и никнейм</td>
				</tr>";
}
?>
