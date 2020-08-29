<?php
include_once 'connect.php';
$query = "SELECT * FROM formobmen WHERE `open`";
$link->set_charset("utf8");
$result = mysqli_query($link, $query);
if (isset($_POST['nicknames5']) && isset($_POST['login5'])  && isset($_POST['priz5']) && isset($_POST['points_search']) && isset($_POST['points_required'])){
	while($row = $result->fetch_assoc()) {
		$open = $row['open'];
		if($open == '1') {
			//-----------фильтрация баллов игрока--------------------
			$points_search = trim(strip_tags(htmlspecialchars(mysqli_real_escape_string($link, $_POST['points_search']))));
			//--------------фильтрация баллов призов--------------------------
			$points_required = intval($_POST['points_required']);
			//-------------фильтрация ника и логина----------------------
			$nicknames5 = trim(strip_tags(htmlspecialchars(mysqli_real_escape_string($link, $_POST['nicknames5']))));
			$login5 = trim(strip_tags(htmlspecialchars(mysqli_real_escape_string($link, $_POST['login5']))));
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
							if (($points_bd == $points_search) AND (strtolower($points_nickname) == strtolower($nicknames5))) {
								//----сравниваем баллы из бд с баллами искомого---------
								//-------------проверка списка призов и баллов необходимых--------------
	$goodvalues = ["Супер-Выстрел 50000 шт",
		"Усиленная мина 100 шт",
		"Большая аптечка 100 шт",
		"Усиленное поле 100 шт",
		"Усиленный щит 100 шт",
		"Двойной нитро 100 шт",
		"Усиленный сканер 100 шт",
		"Усиленные батареи 100 шт",
		"Дымовой заслон 100 шт",
		"Циклотрон IV+ 1 шт",
		"Катушка V+ 1 шт",
		"Накопитель IV+ 1 шт",
		"Турбонаддув IV+ 1 шт",
		"Обшивка IV+ 1 шт",
		"Стабилизатор V+ 1 шт",
		"Дальнометр V+ 1 шт",
		"Целеуказатель V+ 1 шт",
		"Усилитель руля V+ 1 шт",
		"Подшипник V+ 1 шт",
		"Локатор V+ 1 шт",
		"Антирадар V+ 1 шт",
		"Хищник на 30 дней",
		"Борей на 30 дней",
		"Титан на 30 дней",
		"Тень на 30 дней",
		"Левиафан на 30 дней",
		"VIP-аккаунт на 30 дней"];
	$repl = [
		'Супер-Выстрел 50000 шт' => 100,
		'Усиленная мина 100 шт' => 100,
		'Большая аптечка 100 шт' => 100,
		'Усиленное поле 100 шт' => 100,
		'Усиленный щит 100 шт' => 100,
		'Двойной нитро 100 шт' => 100,
		'Усиленный сканер 100 шт' => 100,
		'Усиленные батареи 100 шт' => 100,
		'Дымовой заслон 100 шт' => 100,
		'Циклотрон IV+ 1 шт' => 410,
		'Катушка V+ 1 шт' => 350,
		'Накопитель IV+ 1 шт' => 340,
		'Турбонаддув IV+ 1 шт' => 320,
		'Обшивка IV+ 1 шт' => 260,
		'Стабилизатор V+ 1 шт' => 220,
		'Дальнометр V+ 1 шт' => 220,
		'Целеуказатель V+ 1 шт' => 210,
		'Усилитель руля V+ 1 шт' => 180,
		'Подшипник V+ 1 шт' => 170,
		'Локатор V+ 1 шт' => 160,
		'Антирадар V+ 1 шт' => 110,
		'Хищник на 30 дней' => 250,
		'Борей на 30 дней' => 250,
		'Титан на 30 дней' => 250,
		'Тень на 30 дней' => 250,
		'Левиафан на 30 дней' => 250,
		'VIP-аккаунт на 30 дней' => 250];
								$sum = 0;
								//-----отсев массива значений по шаблону---------
								foreach($_POST['priz5'] as $value) {
									if(in_array($value, $goodvalues)) {
										$new_array[] = $value;
									}
								}
								//------отсев массива суммы по шаблону-------
								foreach($new_array as $key => $value)
								{
									if(in_array($value, $goodvalues))
									{
										$sum += $repl[$value];
									}
								}
								$priz5 = implode(", ", $new_array);
								if($points_required == $sum) {
								if ($points_search >= $points_required) { // -------если баллов больше или равно то одобрено------
									$link->query("INSERT INTO zapisform (nickname,account,priz,points) VALUES ('$nicknames5','$login5','$priz5','$points_required')");
									if($result) {
										echo "<span style='text-align:center;'>Заявка успешно отправлена!<br><br>Призы будут выданы в течении 3-х дней после закрытия опроса</span>";
									} else {
										echo "<span style='text-align:center;'>Упс! К сожалению опрос уже закрыт.</span>";
									}
								} else {
									echo "<span style='text-align:center;'>Недостаточно баллов для обмена на призы</span>";
								}
								} else {
									echo "Error(4)...<br>Обратитесь к Администратору";//----баллы необходимые на призы не равны сумме проверки----
								}
							} else {
								echo 'Error(1)...<br>Обратитесь к Администратору'; //------баллы из бд не совпадают с баллами в таблице--------
							}
							}
						} else {
						echo "Error(2)...<br>Обратитесь к Администратору";//-------изменил ник и баллы---------
					}
					}
					else {
						echo "Not bd..."; //------нет результата-------
					}
				} else {
				echo "Error(3)...<br>Обратитесь к Администратору";// ---"не найдено" изменено на муть---------
			}
		}
		else if($open == '2') {

			echo "<span style='text-align:center;'>К сожалению, на момент отправки, опрос был закрыт.<br>
						Заявка не отправлена</span>
					<meta http-equiv=\"refresh\" content=\"5;url=swap.php\">";
		}
	}
} else {
	echo "<span style='text-align:center;'>Необходимо заполнить все данные!</span>";
}

?>

