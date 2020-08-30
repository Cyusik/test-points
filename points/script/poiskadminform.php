<?php
if (isset($_POST['names2'])) {
	$names2 = $_POST['names2'];
	if($names2 == false) {
		echo "<br><b style='color:red'>Введи никнейм</b>";
	}
	else {
		include_once '../script/connect.php';
		mysqli_query($link, "SET NAMES 'utf8'");
		if(isset($_GET['page'])) {
			$page = $_GET['page'];
		}
		else {
			$page = 1;
		}
		$notesOnPage = 20;
		$from = ($page - 1) * $notesOnPage;
		$query = "SELECT * FROM zapisform WHERE nickname='$names2' ORDER BY dates DESC LIMIT $from,$notesOnPage";
		$result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));
		if($result) {
			$rows = mysqli_num_rows($result);
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
		}$link->close();
	}
	echo "</table>";
}
?>
