<?php
if(isset($_POST['output1']) && !empty($_POST['monthFromAll']) && !empty($_POST['monthToAll']) && isset($_POST['sorting'])) {
	include_once '../script/connect.php';
	//---------------------------------------------------
	session_start();
	$login = $_SESSION['login'];
	$file_login = "../logfiles/exchange_log.log";
	$fw = fopen($file_login, "a+");
	include_once '../script/datetime.php';
	fwrite($fw, $newdate.' '.$login.' Вывод всех заявок'."\r\n");
	//---------------------------------------------------
	$sorting = $_POST['sorting'];
	if($sorting == '') {
		$sorting = 'dates';
	}
	$output1 = $_POST['output1'];
	$monthFromAll = trim(mysqli_real_escape_string($link, $_POST['monthFromAll']));
	$monthToAll = trim(mysqli_real_escape_string($link, $_POST['monthToAll']));
	if($monthFromAll <= $monthToAll) {
		$datesfrom = $monthFromAll.' 00:00:00';
		$datesbefore = $monthToAll.' 23:59:59';
		mysqli_query($link, "SET NAMES 'utf8'");
		$query = "SELECT * FROM zapisform WHERE dates BETWEEN '$datesfrom' AND '$datesbefore' ORDER BY $sorting DESC LIMIT 500";
		$result = mysqli_query($link, $query) or die(fwrite($fw, $newdate.' Ошибка poiskadminformall.php(19): '.mysqli_error($link)."\n"));
		if($result) {
			$rows = mysqli_num_rows($result);// количество полученных строк
			if($rows > 0) {
				fwrite($fw, $newdate.' result=>true'."\r\n");
				echo "<div id='allapplications'>";
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
					<button style='float:right' class='button10' type='submit' id='closeallapplications'>Закрыть</button> 
					</div>
					<script type='text/javascript'>
					$('#closeallapplications').click(function(){
					  $('#allapplications').remove();
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
					<td>Нет заявок за выбранный период</td>
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
					<td>Необходимо указать даты</td>
				</tr>";
}
?>