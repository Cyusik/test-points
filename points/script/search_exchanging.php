<?php
if(isset($_POST['monthFrom']) && isset($_POST['monthTo']) && isset($_POST['nickname_swap']) && isset($_POST['limit_swap']) && isset($_POST['sorting'])) {
	include_once '../script/connect.php';
	//---------------------------------------------------
	session_start();
	$names = $_SESSION['names'];
	//---------------------------------------------------
	$arr_dat = array();
	foreach($_POST as $k => $date) {
		if($_POST[$k] != "") {
			$arr_dat[$k] = trim(htmlspecialchars(mysqli_real_escape_string($link, $date)));
		}
	}
	$whereDB = array();
	if($arr_dat['monthFrom'] && $arr_dat['monthTo']) {
		if($arr_dat['monthFrom'] <= $arr_dat['monthTo']) {
			$datesfrom = $arr_dat['monthFrom'].' 00:00:00';
			$datesbefore = $arr_dat['monthTo'].' 23:59:59';
			$whereDB[] = " dates BETWEEN '".$datesfrom."' AND '".$datesbefore."'";
			if($arr_dat['nickname_swap']) {
				$nickname = $arr_dat['nickname_swap'];
				$whereDB[] = " AND nickname='".$nickname."'";
			}
			if($arr_dat['sorting']) {
				$sorting = $arr_dat['sorting'];
				$whereDB[] = " ORDER BY ".$sorting." DESC";
			}
			else {
				$whereDB[] = " ORDER BY dates DESC";
			}
			if($arr_dat['limit_swap']) {
				if($arr_dat['limit_swap'] <= 500) {
					$limit = $arr_dat['limit_swap'];
					$whereDB[] = " LIMIT ".$limit."";
					$whereDB = implode("", $whereDB);
					$select_swap = "SELECT * FROM zapisform WHERE $whereDB";
					$res_sel = mysqli_query($link, $select_swap) or die('Error: '.mysqli_error($link));
					if($res_sel) {
						$rows = mysqli_num_rows($res_sel);
						if($rows > 0) {
							echo "<div id='applications'>";
							echo "<table class='table_history'><tr>
									<th style='width:20%'>Дата заявки</th>
									<th style='width:15%'>Никнейм</th>
									<th style='width:25%'>Логин</th>
									<th style='width:25%'>Приз</th>
									<th style='width:5%'>Баллы</th>
									<th style='width:10%'>Статус</th></tr>";
							for($i = 0; $i < $rows; ++$i) {
								$row = mysqli_fetch_row($res_sel);
								echo "<tr>";
								for($j = 1; $j < 7; ++$j)
									echo nl2br("<td style='font-size:13px'>$row[$j]</td>");
								echo "</tr>";
							}
							echo "</table><div class='ul-pagination'><ul class='pagination'></ul></div><br>
								<button style='float:right' class='button' type='submit' id='closeapplications'>Закрыть</button></div>
									<script type='text/javascript'>
										$('#closeapplications').click(function(){
					 					 $('#applications').remove();
										});
									</script>";
						}
						else {
							echo "<table class='table_history'>
									<tr><th>Ошибка</th></tr>
									<tr><td>Ничего не найдено</td></tr></table>";
						}
					}
					$link->close();
				}
				else {
					echo "<table class='table_history'>
							<tr><th>Ошибка</th></tr>
							<tr><td>Лимит не более 500</td></tr></table>";
				}
			}
			else {
				echo "<table class='table_history'>
				<tr><th>Ошибка</th></tr>
				<tr><td>Ошибка лимита</td></tr></table>";
			}
		}
		else {
			echo "<table class='table_history'>
				<tr><th>Ошибка</th></tr>
				<tr><td>Дата ОТ не может быть больше ДО</td></tr></table>";
		}
	}
	else {
		echo "<table class='table_history'>
				<tr><th>Ошибка</th></tr>
				<tr><td>Необходимо указать даты</td></tr></table>";
	}
}
else {
	echo "<table class='table_history'>
			<tr><th>Ошибка</th></tr>
			<tr><td>Не все данные в _POST</td></tr></table>";
}
?>
