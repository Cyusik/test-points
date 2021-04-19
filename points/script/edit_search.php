<?php
if(!empty($_POST)) {
	include_once '../script/connect.php';
	$arrS = array();
	foreach($_POST as $date) {
			$arrS[] = trim(htmlspecialchars(mysqli_real_escape_string($link, $date)));
	}
	$num = count($arrS);
	if($num == 2) {
		$tableDB = 'itogobmen';
		$whereDB = "dates LIKE '$arrS[0]%' AND nickname='".$arrS[1]."' ORDER by dates DESC";
	} else if($num == 1) {
		$tableDB = 'tablballs';
		$whereDB = "nickname='$arrS[0]'";
	} else {
		echo "Недопустимое значение элементов _POST";
		$link->close();
		exit();
	}
	$search_sql = "SELECT * FROM $tableDB WHERE $whereDB";
	$result_sql = mysqli_query($link, $search_sql) or die ('Error: '.mysqli_error($link));
	if($result_sql) {
		$assoc = mysqli_num_rows($result_sql);
		if($assoc > 0) {
			echo "<div class='mainwindow'>
						<div class='openwindow'>
						<h3 class='modal' id='heading'></h3>
						<span id='spanwidow'></span><br><br>
						<div class='button btn-div' id='closewidow'>Удалить</div>
						<div class='button btn-div' id='canceling'>Отмена</div></div></div>";
				if($num == 2) {
					for($i = 0; $i < $assoc; ++$i) {
						include '../script/edit_srh_rslt.php';
					}
				} else if($num == 1) {
					for($i = 0; $i < $assoc; ++$i) {
						include '../script/edit_srh_pnts.php';
					}
				}
		} else {
			echo '<table class="table_history">
						<tr><th>Ошибка</th></tr>
						<tr><td>Ничего не найдено</td></tr>
					</table>';
		}
	} else {
		echo 'error bd..';
	}
} else {
	echo "Не все данные в _POST";
}
?>