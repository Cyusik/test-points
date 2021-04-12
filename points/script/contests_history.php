<?php
if(isset($_GET['page'])) {
	$page = intval($_GET['page']);
	$page = abs($page);
	if($page == 0) {
		$page = intval(1);
	}
}
else {
	$page = intval(1);
}
$notesOnPage = 50;
$id = 0;
$from = ($page - 1) * $notesOnPage;
if($from >= 0) {
	if($role !=1) {
		$wereDB = " login_ad ='$names' ";
	} else {
		$wereDB = " id > $id ";
	}
	$sql_contests_hist = "SELECT * FROM contests_log WHERE $wereDB ORDER BY dates DESC LIMIT $from, $notesOnPage";
	$result_sql = mysqli_query($link, $sql_contests_hist) or die ('Error '.mysqli_error($link));
	if($result_sql) {
		$rows = mysqli_num_rows($result_sql);
		if($rows > 0) {
			echo '<table class="table_history">
						<tr>
							<th>Дата</th>
							<th>Юзер</th>
							<th>Никнейм</th>
							<th>Начислено</th>
							<th>Доп. информация</th>
						</tr>';
			for($i = 0; $i < $rows; ++$i) {
				$row = mysqli_fetch_row($result_sql);
				echo '<tr>';
				for($j = 1; $j < count($row); ++$j) {
					echo nl2br("<td>$row[$j]</td>");
				}
				echo '</tr>';
			}
			echo '</table>';
		}
		else {
			echo '<table class="table_history">
						<tr><th>Ошибка</th></tr>
						<tr><td>Ничего не найдено</td></tr>
					</table>';
		}
	}
}
else {
	echo '<table class="table_history">
						<tr><th>Ошибка поиска</th></tr>
						<tr><td>Неизвестная ошибка</td></tr>
					</table>';
}
include_once '../script/contests_history_page.php'; // тут на пагинацию наводка
?>