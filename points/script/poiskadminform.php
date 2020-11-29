<?php
if(!empty($_POST['names2']) && !empty($_POST['monthFrom']) && !empty($_POST['monthTo']) && isset($_POST['sorting'])) {
	include_once '../script/connect.php';
	$sorting = $_POST['sorting'];
	if($sorting == '') {
		$sorting = 'dates';
	}
	$names2 = trim(mysqli_real_escape_string($link, $_POST['names2']));
	$monthFrom = trim(mysqli_real_escape_string($link, $_POST['monthFrom']));
	$monthTo = trim(mysqli_real_escape_string($link, $_POST['monthTo']));
	//---------------------------------------------------
	session_start();
	$login = $_SESSION['login'];
	$file_login = "../logfiles/exchange_log.log";
	$fw = fopen($file_login, "a+");
	$date = date('Y-m-d h:i:s');
	$newdate = date('Y-m-d h:i:s A', strtotime($date));
	fwrite($fw, $newdate.' '.$login.' Вывод заявок по нику: '.$names2."\r\n");
	//---------------------------------------------------
	if($monthFrom <= $monthTo) {
		$datesfrom = $monthFrom.' 00:00:00';
		$datesbefore = $monthTo.' 23:59:59';
		$query = "SELECT * FROM zapisform WHERE dates BETWEEN '$datesfrom' AND '$datesbefore' AND nickname='$names2' ORDER BY $sorting DESC LIMIT 500";
		$result = mysqli_query($link, $query) or die(fwrite($fw, $newdate.' Ошибка poiskadminform.php(19): '.mysqli_error($link)."\n"));
		if($result) {
			$rows = mysqli_num_rows($result);
			if($rows > 0) {
				fwrite($fw, $newdate.' result=>true'."\r\n");
				echo "<div id='applications'>";
				echo "<table class='table_dark2'><tr>
			<th style='width:20%'>Дата заявки</th>
			<th style='width:15%'>Никнейм</th>
			<th style='width:25%'>Логин</th>
			<th style='width:25%'>Приз</th>
			<th style='width:5%;'>Баллы</th>
			<th style='width:10%'>Статус</th>
				</tr>";
				for($i = 0; $i < $rows; ++$i) {
					$row = mysqli_fetch_row($result);
					echo "<tr>";
					for($j = 1; $j < 7; ++$j)
						echo nl2br("<td style='border-bottom:1px solid white;'>$row[$j]</td>");
					echo "</tr>";
				}
				echo "</table>
						<br>
					<button style='float:right' class='button10' type='submit' id='closeapplications'>Закрыть</button> 
					</div>
					<script type='text/javascript'>
					$('#closeapplications').click(function(){
					  $('#applications').remove();
					})
					</script>";
			}
			else {
				fwrite($fw, $newdate.' result=>false'."\r\n");
				echo "<table class='table_dark2'>
				<tr>
					<th>Ошибка</th>
				</tr>
				<tr>
					<td>Ничего не найдено</td>
				</tr>";
			}
		}
		fclose($fw);
		$link->close();
	}
	else {
		echo "<table class='table_dark2'>
				<tr>
					<th>Ошибка</th>
				</tr>
				<tr>
					<td>Дата ОТ не может быть больше ДО</td>
				</tr>";
	}
}
else {
	echo "<table class='table_dark2'>
				<tr>
					<th>Ошибка</th>
				</tr>
				<tr>
					<td>Необходимо указать даты и никнейм</td>
				</tr>";
}
?>
