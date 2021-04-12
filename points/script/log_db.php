<?php
if(isset($_GET)) {
	include_once '../script/connect.php';
	$lg_srh = array();
	foreach($_GET as $k => $data) {
		if($data != "") {
			$lg_srh[$k] = trim(htmlspecialchars(mysqli_real_escape_string($link, $data)));
		}
	}
	if((($lg_srh['dt_st'] != '') && ($lg_srh['dt_en'] == '')) || (($lg_srh['dt_st'] == '') && ($lg_srh['dt_en'] != ''))) {
		echo "<div class='div-result'>Укажи обе даты</div>";
		$link->close();
		exit();
	}
	if(($lg_srh['dt_st'] != '') && ($lg_srh['dt_en'] != '')) {
		if($lg_srh['dt_st'] < $lg_srh['dt_en']) {
				$dataFr = $lg_srh['dt_st'];
				$dataBf = $lg_srh['dt_en'];
		} else {
			echo "<div class='div-result'>Дата ОТ не может быть больше ДО</div>";
			$link->close();
			exit();
		}
	}
	$num = count($lg_srh);
	if($num == 1) {
		if($lg_srh['action'] == 'viewing_logs.php') {
			echo '<h3>- Лог раздел Управление -</h3>';
			include_once '../script/line_history.php';
		}
	}
	else {
		if($lg_srh['log_bd']) {
			unset($lg_srh['action']);
			if(count($lg_srh) > 1) {
				$tableBD = $lg_srh['log_bd'].' WHERE';
			} else {
				$tableBD = $lg_srh['log_bd'];
			}
			include_once '../script/log_line_history.php';
		}
	}
}
?>