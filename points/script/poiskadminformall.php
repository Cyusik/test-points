<?php
if (isset($_POST['output1']) && !empty($_POST['monthFromAll']) && !empty($_POST['monthToAll'])) {
	include_once '../script/connect.php';
	//---------------------------------------------------
	session_start();
	$login = $_SESSION['login'];
	$file_login = "../logfiles/exchange_log.log";
	$fw = fopen($file_login, "a+");
	$date = date('Y-m-d h:i:s');
	$newdate = date('Y-m-d h:i:s A', strtotime($date));
	fwrite($fw, $newdate.' '.$login.' Вывод всех заявок'."\r\n");
	//---------------------------------------------------
	$output1 = $_POST['output1'];
	$monthFromAll = trim(mysqli_real_escape_string($link, $_POST['monthFromAll']));
	$monthToAll = trim(mysqli_real_escape_string($link, $_POST['monthToAll']));
	if($monthFromAll <= $monthToAll) {
		$datesfrom = $monthFromAll.' 00:00:00';
		$datesbefore = $monthToAll.' 23:59:59';
		mysqli_query($link, "SET NAMES 'utf8'");
		$query = "SELECT * FROM zapisform WHERE dates BETWEEN '$datesfrom' AND '$datesbefore' ORDER BY dates DESC LIMIT 500";
		$result = mysqli_query($link, $query) or die(fwrite($fw, $newdate.' Ошибка poiskadminformall.php(19): '.mysqli_error($link)."\n"));
		if($result) {
			$rows = mysqli_num_rows($result);// количество полученных строк
			if ($rows > 0) {
				fwrite($fw, $newdate.' result=>true'."\r\n");
				echo "<div id='allapplications'>";
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
			} echo "</table>
						<br>
					<button style='float:right' class='button10' type='submit' id='closeallapplications'>Закрыть</button> 
					</div>
					<script type='text/javascript'>
					$('#closeallapplications').click(function(){
					  $('#allapplications').remove();
					})
					</script>";
			} else {
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
					<td>Необходимо указать даты</td>
				</tr>";
}
?>