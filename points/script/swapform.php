<?php
include_once 'connect.php';
$query = "SELECT * FROM formobmen WHERE `open`";
$link->set_charset("utf8");
$result = mysqli_query($link, $query);
if (isset($_POST['nicknames5']) && isset($_POST['login5'])  && isset($_POST['priz5']) && isset($_POST['points_search']) && isset($_POST['points_required'])){
	//echo $a.' :переменная: '.$b;
	while($row = $result->fetch_assoc()) {
		$open = $row['open'];
		if($open == '1') {
			//-----------фильтрация баллов игрока--------------------
			$points_search = strip_tags($_POST['points_search']);
			$points_search = htmlspecialchars($points_search);
			$points_search = mysqli_real_escape_string($link, $points_search);
			//--------------фильтрация призов--------------------------
			$points_required = intval(trim(mysqli_real_escape_string($link, $_POST['points_required'])));
			//-------------фильтрация ника и логина----------------------
			$nicknames5 = trim(stripcslashes(mysqli_real_escape_string($link, $_POST['nicknames5'])));
			$login5 = trim(stripcslashes(mysqli_real_escape_string($link, $_POST['login5'])));
			//-----------разница баллы игрока и призы------------------------
			if (strpos($points_search, 'Никнейм не найден')!== false) {
				echo 'не найден - результат нет';// вот тут окно с тем что ника нет в таблице или введен не корректно
			} else if (is_numeric($points_search) !== false) { //-----если это число, то ищем по бд--------
				//--------даем запрос в бд на поиск по нику-------------------
				$sql = "SELECT * FROM tablballs WHERE nickname='%s'";
				$query = sprintf($sql, mysqli_real_escape_string($link, $nicknames5));
				$result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));
				if($result) {
					$rows = mysqli_num_rows($result);
					if($rows > 0) {
						for($i = 0; $i < $rows; ++$i) {
							$row = mysqli_fetch_row($result);
							$points_bd = $row[2];
							$points_nickname = $row[1];
							if (($points_bd == $points_search) AND ($points_nickname == $nicknames5)) { //----сравниваем баллы из бд с баллами искомого---------
								if ($points_search >= $points_required) { // -------если баллов больше или равно то одобрено------
									// ------обработка массива-------------
									foreach($_POST['priz5'] as $k=>$m) {
										if (!empty($m)) {
											$mass[$k] = $m;
										}
									}
									$priz5 = implode("\r",$mass);
									//-------конец обработки---------------
									$link->query("INSERT INTO zapisform (nickname,account,priz) VALUES ('$nicknames5','$login5','$priz5')");
									if($result) {
										echo "<table class='table_dark2'>
						<tr>
						<td>
						<b style='color:red; text-align:center; display:block;'>Заявка успешно отправлена!</b>
						</td>
						</tr>
						</table>";
									} else {
										echo "<div class='block'><b style='color:red;'>Упс! К сожалению опрос уже закрыт.</b></div>";
									}
								} else {
									echo 'баллов меньше = не одобрено';
								}
								//echo 'тут число'; //а число и сравнить с баллами
							} else {
								echo 'Error(1)...'; //------баллы из бд не совпадают с баллами в таблице--------
							}
							}
						} else {
						echo "Error(2)...";//-------изменил ник и баллы---------
					}
					}
					else {
						echo "Not bd..."; //------нет результата-------
					}
				} else {
				echo "Error(3)...";// ---"не найдено" изменено на муть---------
			}
		}
		else if($open == '2') {

			echo "<table class='table_dark2'>
						<tr>
						<td>
						<b style='color:red; text-align:center; display:block;'>К сожалению, на момент отправки, опрос был закрыт.<br>
						Заявка не отправлена.</b>
						</td>
						</tr>
						</table>
					<meta http-equiv=\"refresh\" content=\"5;url=swap.php\">";
		}
	}
}

?>

