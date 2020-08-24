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
			//--------------фильтрация баллов призов--------------------------
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
								//-------------проверка списка призов и баллов необходимых--------------
								$array_priz5 = array("Супер-Выстрел 50000 шт", "Усиленная мина 100 шт", "Большая аптечка 100 шт", "Усиленное поле 100 шт",
									"Усиленный щит 100 шт", "Двойной нитро 100 шт", "Усиленный сканер 100 шт", "Усиленные батареи 100 шт", "Дымовой заслон 100 шт", "Циклотрон IV+ 1 шт", "Катушка V+ 1 шт", "Накопитель IV+ 1 шт", "Турбонаддув IV+ 1 шт", "Обшивка IV+ 1 шт", "Стабилизатор V+ 1 шт", "Дальнометр V+ 1 шт", "Целеуказатель V+ 1 шт", "Усилитель руля V+ 1 шт", "Подшипник V+ 1 шт", "Локатор V+ 1 шт", "Антирадар V+ 1 шт", "Хищник на 30 дней", "Борей на 30 дней", "Титан на 30 дней", "Тень на 30 дней", "Левиафан на 30 дней", "VIP-аккаунт на 30 дней");
								if ($points_search >= $points_required) { // -------если баллов больше или равно то одобрено------
									// ------обработка массива-------------
									foreach($_POST['priz5'] as $k=>$m) {
										if (!empty($m)) {
											$mass[$k] = $m;
										}
									}
									$itog_array = array_intersect($array_priz5, $mass); //-----занесутся только те значения, что равны array_priz5----
									//print_r($itog_array);
									$priz5 = mysqli_real_escape_string($link, implode(", ", $itog_array));
									//echo $priz5;
									//-------конец обработки---------------
									$link->query("INSERT INTO zapisform (nickname,account,priz,points) VALUES ('$nicknames5','$login5','$priz5','$points_required')");
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
} else {
	echo "<table class='table_dark2'>
						<tr>
						<td>
						<b style='color:red; text-align:center; display:block;'>Необходимо заполнить все данные!</b>
						</td>
						</tr>
						</table>";
}

?>

