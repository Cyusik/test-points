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
$wereDB = array();
$notesOnPage = 50;
$id = 0;
$from = ($page - 1) * $notesOnPage;
if($from >= 0) {
	if($role !=1) {
		$wereDB[] = " login_ad ='$names' ";
	}
	if($section != 'none') {
		$wereDB[] = " section = '$section' ";
	}
	if(!empty($wereDB)) {
		$wereDB = " WHERE ".implode("AND", $wereDB);
	} else {
		$wereDB = "";
	}
	$sql_line_log = "SELECT * FROM $tableBD $wereDB ORDER BY dates DESC LIMIT $from, $notesOnPage";
	$result_log = mysqli_query($link, $sql_line_log) or die ('Error '.mysqli_error($link));
	if($result_log) {
		$rows = mysqli_num_rows($result_log);
		if($rows > 0) {
			echo '<table class="table_history">
						<tr>';
			include_once '../script/th_view_hist.php';
			echo '</tr>';
			for($i = 0; $i < $rows; ++$i) {
				$row = mysqli_fetch_row($result_log);
				echo '<tr>';
				for($j = 1; $j < count($row); ++$j) {
					if($row[$j]) {
						echo nl2br("<td>$row[$j]</td>");
					}
					else {
						echo nl2br("<td style='width:auto'>$row[$j]</td>");
					}
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
include_once '../script/line_history_page.php'; // тут на пагинацию наводка
?>