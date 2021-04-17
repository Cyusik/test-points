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
$str_lg = $lg_srh['log_bd'];
$wereDB = array();
$line_page = array("action=viewing_logs.php&log_bd=$str_lg");
if($lg_srh['log_bd'] == 'srh_usr_log') {
	if($lg_srh['section']) {
		$lg_srh['usertable'] = $lg_srh['section'];
		unset($lg_srh['section']);
	}
}
if(($dataFr !="") && ($dataBf !="")) {
	$dataFr = $dataFr.':00';
	$dataBf = $dataBf.':59';
	$wereDB[] = " dates BETWEEN '".$dataFr."' AND '".$dataBf."'";
	$line_page[] = 'dt_st='.$dataFr.'&dt_en='.$dataBf;
}
foreach($lg_srh as $k=>$data) {
	if($k == 'usertable') {
		$wereDB[] = " usertable='".$data."'";
		$line_page[] = "usertable=".$data;
	}
	if($k == 'section') {
		$wereDB[] = " section='".$data."'";
		$line_page[] = "section=".$data;
	}
}
$wereDB = implode(" AND", $wereDB);
$line_page = implode("&", $line_page);
if($wereDB == "") {
	$tableBD = str_replace("WHERE", " ", $tableBD);
}
$notesOnPage = 50;
$id = 0;
$from = ($page - 1) * $notesOnPage;
if($from >= 0) {
	$sql_line_log = "SELECT * FROM $tableBD $wereDB ORDER BY dates DESC LIMIT $from, $notesOnPage";
	$result_log = mysqli_query($link, $sql_line_log) or die ('Error(log_line_history 46) '.mysqli_error($link));
	if($result_log) {
		$rows = mysqli_num_rows($result_log);
		if($rows > 0) {
			echo '<table class="table_history">
						<tr>';
			include_once '../script/th_log.php';
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