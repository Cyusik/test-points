<?php
include_once 'connect.php';
$query = "SELECT * FROM formobmen WHERE `open`";
$link->set_charset("utf8");
$result_link = mysqli_query($link, $query) or die('Ошибка swapform.php(5): '.mysqli_error($link));
$logIP = $_SERVER['REMOTE_ADDR'];
if(isset($_POST['nicknames5']) && !empty($_POST['login5']) && isset($_POST['priz5']) && isset($_POST['points_search']) && isset($_POST['points_required'])) {
	$nicknames5 = trim(strip_tags(htmlspecialchars(mysqli_real_escape_string($link, $_POST['nicknames5']))));
	while($row = mysqli_fetch_assoc($result_link)) {
		$open = $row['open'];
		if($open == '1') {
			//-----------фильтрация баллов игрока--------------------
			$points_search = trim(strip_tags(htmlspecialchars(mysqli_real_escape_string($link, $_POST['points_search']))));
			//--------------фильтрация баллов призов--------------------------
			$points_required = intval($_POST['points_required']);
			//-------------фильтрация ника и логина----------------------
		//	$nicknames5 = trim(strip_tags(htmlspecialchars(mysqli_real_escape_string($link, $_POST['nicknames5']))));
			$login5 = trim(strip_tags(htmlspecialchars(mysqli_real_escape_string($link, $_POST['login5']))));
			$login5 = strtolower($login5);
			//-----------разница баллы игрока и призы------------------------
			if(strpos($points_search, 'Никнейм не найден') !== false) {
				//echo 'не найден - результат нет'; вот тут окно с тем что ника нет в таблице или введен не корректно
			}
			else if(is_numeric($points_search) !== false) { //-----если это число, то ищем по бд--------
				//--------даем запрос в бд на поиск по нику-------------------
				$sql = "SELECT nickname,balls,history,login_one,login_two,login_three FROM tablballs WHERE nickname='%s'";
				$query = sprintf($sql, mysqli_real_escape_string($link, $nicknames5));
				$result_check = mysqli_query($link, $query) or die('Ошибка swapform.php(35): '.mysqli_error($link));
				if($result_check) {
					$rows = mysqli_num_rows($result_check);
					if($rows > 0) {
						$rowtb = mysqli_fetch_row($result_check);
						$points_bd = $rowtb[1];
						$points_nickname = $rowtb[0];
						if(($points_bd == $points_search) AND (strtolower($points_nickname) == strtolower($nicknames5))) {
							//----сравниваем баллы из бд с баллами искомого---------
							//-------------проверка списка призов и баллов необходимых--------------
							$goodvalues = array("Супер-Выстрел 50000 шт", "Усиленная мина 100 шт", "Большая аптечка 100 шт", "Усиленное поле 100 шт", "Усиленный щит 100 шт", "Двойной нитро 100 шт", "Усиленный сканер 100 шт", "Усиленные батареи 100 шт", "Дымовой заслон 100 шт", "Циклотрон IV+ 1 шт", "Катушка V+ 1 шт", "Накопитель IV+ 1 шт", "Турбонаддув IV+ 1 шт", "Обшивка IV+ 1 шт", "Стабилизатор V+ 1 шт", "Дальнометр V+ 1 шт", "Целеуказатель V+ 1 шт", "Усилитель руля V+ 1 шт", "Подшипник V+ 1 шт", "Локатор V+ 1 шт", "Антирадар V+ 1 шт", "Хищник на 30 дней", "Борей на 30 дней", "Титан на 30 дней", "Тень на 30 дней", "Левиафан на 30 дней", "VIP-аккаунт на 30 дней");

							$repl = array('Супер-Выстрел 50000 шт' => 100, 'Усиленная мина 100 шт' => 100, 'Большая аптечка 100 шт' => 100, 'Усиленное поле 100 шт' => 100, 'Усиленный щит 100 шт' => 100, 'Двойной нитро 100 шт' => 100, 'Усиленный сканер 100 шт' => 100, 'Усиленные батареи 100 шт' => 100, 'Дымовой заслон 100 шт' => 100, 'Циклотрон IV+ 1 шт' => 410, 'Катушка V+ 1 шт' => 350, 'Накопитель IV+ 1 шт' => 340, 'Турбонаддув IV+ 1 шт' => 320, 'Обшивка IV+ 1 шт' => 260, 'Стабилизатор V+ 1 шт' => 220, 'Дальнометр V+ 1 шт' => 220, 'Целеуказатель V+ 1 шт' => 210, 'Усилитель руля V+ 1 шт' => 180, 'Подшипник V+ 1 шт' => 170, 'Локатор V+ 1 шт' => 160, 'Антирадар V+ 1 шт' => 110, 'Хищник на 30 дней' => 250, 'Борей на 30 дней' => 250, 'Титан на 30 дней' => 250, 'Тень на 30 дней' => 250, 'Левиафан на 30 дней' => 250, 'VIP-аккаунт на 30 дней' => 250);
							$sum = 0;
							//-----отсев массива значений по шаблону---------
							foreach($_POST['priz5'] as $value) {
								if(in_array($value, $goodvalues)) {
									$new_array[] = $value;
								}
							}
							//------отсев массива суммы по шаблону-------
							foreach($new_array as $key => $value) {
								if(in_array($value, $goodvalues)) {
									$sum += $repl[$value];
								}
							}
							//---возьмем строку за дату и внесем в массив----
							$priz5 = implode(", ", $new_array);
							if($points_required == $sum) {
								if($points_search >= $points_required) { // -------если баллов больше или равно то одобрено------
									//----проверяем логин---
									$arr_login = array($rowtb[3], $rowtb[4], $rowtb[5]);
									if(($arr_login[0] || $arr_login[1] || $arr_login[3]) == false) // если нет логинов вообще то записываем в первый
									{
										$status = 'new_login';
										$write_login_one = "UPDATE tablballs SET login_one='$login5' WHERE nickname='$nicknames5'";
										$result = mysqli_query($link, $write_login_one) or die ('Error: '.mysqli_error($link));
									}
									else if(in_array($login5, $arr_login) == false) // строгий поиск совпадений
									{
										$status = 'no matches'; // - нет совпадений
									}
									else {
										$status = 'success';// - совпадения есть, списываем баллы, заносим историю
										//----------- подготовка истории обмена для записи--------
										//---массив количества---
										$quantity = array('Супер-Выстрел' => 50000, 'Усиленная мина' => 100, 'Большая аптечка' => 100, 'Усиленное поле' => 100, 'Усиленный щит' => 100, 'Двойной нитро' => 100, 'Усиленный сканер' => 100, 'Усиленные батареи' => 100, 'Дымовой заслон' => 100, 'Циклотрон IV+' => 1, 'Катушка V+' => 1, 'Накопитель IV+' => 1, 'Турбонаддув IV+' => 1, 'Обшивка IV+' => 1, 'Стабилизатор V+' => 1, 'Дальнометр V+' => 1, 'Целеуказатель V+' => 1, 'Усилитель руля V+' => 1, 'Подшипник V+' => 1, 'Локатор V+' => 1, 'Антирадар V+' => 1, 'Хищник' => 30, 'Борей' => 30, 'Титан' => 30, 'Тень' => 30, 'Левиафан' => 30, 'VIP-аккаунт' => 30);
										$itog_arr = array();
										foreach($new_array as $data) { // велосипед для сложения кол-ва призов strripos()
											foreach($quantity as $k => $value) {
												if(strpos($data, $k) !== false) {
													$itog_arr[] = $k;
													$itog_arr[] = $value;
												}
											}
										}
										//-----вот тут надо разобрать строки на составные части массива-------
										//----ищем есть ли текущая дата в истории----
										$date_recording = date('d.m.Y h:i:s'); //---установить дату заявки
										$write_date = date('d.m.y', strtotime($date_recording));
										if(strpos($rowtb[2], $write_date) !== false) { // если такая дата уже есть, то дополняем
											$true_date = $write_date;
											$masshist = array();
											$stdateline = strtok($rowtb[2], "\n"); // извлекаем первую строку (она не может быть иной!!!)
											$stdateline = str_replace($write_date, '', $stdateline);//удаляем дату
											$masshist = explode(',', $stdateline);//формируем в массив
											foreach($masshist as $dt) { //разбираем массив из истории
												foreach($quantity as $khis => $valuet) {
													if(strpos($dt, $khis) !== false) {
														$arr_rowtb[] = $khis;
														$arr_rowtb[] = preg_replace('/[^0-9]/', '', $dt);//оставляем только цифры
													}
												}
											}
											$unite_mass = array_merge($itog_arr, $arr_rowtb); //объединяем заказы и то что уже есть
											//-------конец разбора и объединение массивов----------
											$separation = array_chunk($unite_mass, 2);
										} else {
											$separation = array_chunk($itog_arr, 2); //если нет даты, то только заказанное берем
										}
										$unique_array = array();
										foreach($separation as $data) { // удалляем дубликаты, складываем значения
											$hash = $data[0];
											if(isset($unique_array[$hash])) {
												$data[1] += $unique_array[$hash][1];
											}
											$unique_array[$hash] = $data;
										}
										$ending = array('Хищник', 'Борей', 'Титан', 'Тень', 'Левиафан', 'VIP-аккаунт'); // - отсеить похожее
										foreach($unique_array as $luck => $mass) { // --- необходимо для записи элементов через запятую
											if(in_array($mass[0], $ending) !== false) {
												$line[] = implode(' ', $mass).' дней'; //---определяем окончание
											}
											else {
												$line[] = implode(' ', $mass).' шт'; //---определяем окончание
											}
											$line_history = implode(', ', $line); //---запись через дапятую
										}
										if(!empty($true_date)) { // если такая дата уже есть, то дополняем
											$rowtb[2] = preg_replace('/^.+\n/', '', $rowtb[2]);//удаляем первую строку
											$write_hisline = $write_date.' '.$line_history."\r\n".$rowtb[2]; //- итоговая строка для записи в бд
										}
										else { //если текущей даты нет, то записываем только заказанное
											$write_hisline = $write_date.' '.$line_history."\r\n".$rowtb[2]; //- итоговая строка для записи в бд
										}
										//----------end-подготовка истории----
										$subtract_points = "UPDATE tablballs SET balls=`balls`-'$points_required', history ='$write_hisline' WHERE nickname='$nicknames5'";
										$result_subtract = mysqli_query($link, $subtract_points) or die('Ошибка swapform.php(85): '.mysqli_error($link));
										$logSwapAct = 'Списание: '.$nicknames5.' points -'.$points_required;
									}
									if(!empty($true_date)) {
										$date_format = date('Y-m-d', strtotime(date('Y-m-d h:i:s')));
										$points_nickname = strtolower($points_nickname);
										$select_date = "SELECT id,dates,nickname,status FROM zapisform WHERE dates LIKE '$date_format%' AND nickname = '$points_nickname' AND status = 'success'";
										$result_date = mysqli_query($link, $select_date) or die ('Error: '.mysqli_error($link));
										$select_row = mysqli_fetch_row($result_date);
										$wrrite_request = "UPDATE zapisform SET priz='$line_history', points=`points`+'$sum' WHERE id='$select_row[0]'";
										$result_request = mysqli_query($link, $wrrite_request) or die ('Error: '.mysqli_error($link));
									} else {
										$wrrite_request = "INSERT INTO zapisform (nickname,account,priz,points,status) VALUES ('$nicknames5','$login5','$priz5','$points_required','$status')";
										$result_request = mysqli_query($link, $wrrite_request) or die ('Error: '.mysqli_error($link));;
									}
									if($result_request) {
										$logSwapAct = ' Заявка записана';
										echo "<span style='text-align:center;'>Заявка успешно отправлена!<br><br>Призы будут выданы в течении 3-х дней после закрытия опроса</span>";
									}
									else {
										$logSwapAct = 'Нет результата от таблицы zapisform';
										echo "<span style='text-align:center;'>Упс! К сожалению опрос уже закрыт.</span>";
									}
								}
								else {
									$logSwapAct = 'Недостаточно баллов';
									echo "<span style='text-align:center;'>Недостаточно баллов для обмена на призы</span>";
								}
							}
							else {
								$logSwapAct = 'Баллы необходимые на призы не равны сумме проверки';
								echo "Error(4)...<br>Обратитесь к Администратору";//----баллы необходимые на призы не равны сумме проверки----
							}
						}
						else {
							$logSwapAct = 'Баллы из бд не совпадают с баллами в таблице';
							echo 'Error(1)...<br>Обратитесь к Администратору'; //------баллы из бд не совпадают с баллами в таблице--------
						}
					}
					else {
						$logSwapAct = 'Изменил ник и баллы вручную';
						echo "Error(2)...<br>Обратитесь к Администратору";//-------изменил ник и баллы---------
					}
				}
				else {
					echo "Not bd..."; //------нет результата-------
				}
			}
			else {
				$logSwapAct = 'поле "не найдено" изменено';
				echo "Error(3)...<br>Обратитесь к Администратору";// ---"не найдено" изменено на муть---------
			}
		}
		else if($open == '2') {
			$logSwapAct = 'Опрос закрыт на момент отправки';
			echo "<span style='text-align:center;'>К сожалению, на момент отправки, опрос был закрыт.<br>
						Заявка не отправлена</span>
					<meta http-equiv=\"refresh\" content=\"5;url=swap.php\">";
		}
		unset($quantity);
		unset($separation);
		unset($ending);
		unset($sum);
	}
}
else {
	$nicknames5 = trim(strip_tags(htmlspecialchars(mysqli_real_escape_string($link, $_POST['nicknames5']))));
	$points_search = trim(strip_tags(htmlspecialchars(mysqli_real_escape_string($link, $_POST['points_search']))));
	$login5 = trim(strip_tags(htmlspecialchars(mysqli_real_escape_string($link, $_POST['login5']))));
	$points_required = trim(strip_tags(htmlspecialchars(mysqli_real_escape_string($link, $_POST['points_required']))));
	$logSwapAct = 'Заполнены не все поля ввода';
	echo "<span style='text-align:center;'>Необходимо заполнить все данные!</span>";
}
$swap_log = array("'$logIP'", "'$nicknames5'", "'$login5'", "'$points_search'", "'$points_required'", "'$priz5'", "'$logSwapAct'", "'$status'");
foreach($swap_log as $k => $data) {
	if($data == "") {
		$swap_log[$k] = "'"."'";
	}
}
$swap_log = implode(", ", $swap_log);
$logSwapRecording = "INSERT INTO swap_log (log_ip,nickname,login,pnt_srh,pnt_rqd,prizes,result,status) VALUES ($swap_log)";
$logRecordingResult = mysqli_query($link, $logSwapRecording) or die(mysqli_error($link));
// varh 30, varch 30, int 10, int 10, text, varch 255, varch 30
?>