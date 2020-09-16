<?php
include_once 'connect.php';
$file_login = "../logfiles/swap_log.log";
$fw = fopen($file_login, "a+");
date_default_timezone_set('Europe/Moscow');
$date = date('Y-m-d h:i:s');
$newdate = date('Y-m-d h:i:s A', strtotime($date));
$query = "SELECT * FROM formobmen WHERE `open`";
$link->set_charset("utf8");
$result = mysqli_query($link, $query) or die(fwrite($fw, $newdate.'Ошибка swapform.php(5): '.mysqli_error($link)."\n"));
if (isset($_POST['nicknames5']) && isset($_POST['login5']) && isset($_POST['priz5']) && isset($_POST['points_search']) && isset($_POST['points_required']))
{
    fwrite($fw, $newdate .' '.'Запрос в форму: '."\n\t");
    while ($row = $result->fetch_assoc())
    {
        $open = $row['open'];
        if ($open == '1')
        {
            //-----------фильтрация баллов игрока--------------------
            $points_search = trim(strip_tags(htmlspecialchars(mysqli_real_escape_string($link, $_POST['points_search']))));
            fwrite($fw, $newdate.' На счету баллов: '.$points_search."\n\t");
            //--------------фильтрация баллов призов--------------------------
            $points_required = intval($_POST['points_required']);
            fwrite($fw, $newdate.' Необходимо баллов: '.$points_required."\n\t");
            //-------------фильтрация ника и логина----------------------
            $nicknames5 = trim(strip_tags(htmlspecialchars(mysqli_real_escape_string($link, $_POST['nicknames5']))));
            fwrite($fw, $newdate.' Никнейм: '.$nicknames5."\n\t");
            $login5 = trim(strip_tags(htmlspecialchars(mysqli_real_escape_string($link, $_POST['login5']))));
            fwrite($fw, $newdate.' Логин: '.$nicknames5."\n\t");
            //-----------разница баллы игрока и призы------------------------
            if (strpos($points_search, 'Никнейм не найден') !== FALSE)
            {
                //echo 'не найден - результат нет'; вот тут окно с тем что ника нет в таблице или введен не корректно
            } else if (is_numeric($points_search) !== FALSE)
            { //-----если это число, то ищем по бд--------
                //--------даем запрос в бд на поиск по нику-------------------
                $sql = "SELECT * FROM tablballs WHERE nickname='%s'";
                $query = sprintf($sql, mysqli_real_escape_string($link, $nicknames5));
                $result = mysqli_query($link, $query) or die(fwrite($fw, $newdate.' Ошибка swapform.php(35): '.mysqli_error($link)."\n"));
                if ($result)
                {
                    $rows = mysqli_num_rows($result);
                    if ($rows > 0)
                    {
                        for ($i = 0; $i < $rows; ++$i)
                        {
                            $row = mysqli_fetch_row($result);
                            $points_bd = $row[2];
                            $points_nickname = $row[1];
                            if (($points_bd == $points_search) AND (strtolower($points_nickname) == strtolower($nicknames5)))
                            {
                                //----сравниваем баллы из бд с баллами искомого---------
                                //-------------проверка списка призов и баллов необходимых--------------
                                $goodvalues = array(
                                    "Супер-Выстрел 50000 шт",
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
                                    "VIP-аккаунт на 30 дней"
                                );

                                $repl = array(
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
                                    'VIP-аккаунт на 30 дней' => 250);
                                $sum = 0;
                                //-----отсев массива значений по шаблону---------
                                foreach ($_POST['priz5'] as $value)
                                {
                                    if (in_array($value, $goodvalues))
                                    {
                                        $new_array[] = $value;
                                    }
                                }
                                //------отсев массива суммы по шаблону-------
                                foreach ($new_array as $key => $value)
                                {
                                    if (in_array($value, $goodvalues))
                                    {
                                        $sum += $repl[$value];
                                    }
                                }
                                $priz5 = implode(", ", $new_array);
                                fwrite($fw, $newdate.' Список призов: '.$priz5."\n\t");
                                if ($points_required == $sum)
                                {
                                    if ($points_search >= $points_required)
                                    { // -------если баллов больше или равно то одобрено------
                                        $link->query("INSERT INTO zapisform (nickname,account,priz,points) VALUES ('$nicknames5','$login5','$priz5','$points_required')");
                                        if ($result)
                                        {
                                            fwrite($fw, $newdate.' Результат: '.'true'."\n\t");
                                            echo "<span style='text-align:center;'>Заявка успешно отправлена!<br><br>Призы будут выданы в течении 3-х дней после закрытия опроса</span>";
                                        } else
                                        {
                                            fwrite($fw, $newdate.' Результат: '.'опрос закрыт'."\n\t");
                                            echo "<span style='text-align:center;'>Упс! К сожалению опрос уже закрыт.</span>";
                                        }
                                    } else
                                    {
                                        fwrite($fw, $newdate.' Результат: '.'Недостаточно баллов'."\n\t");
                                        echo "<span style='text-align:center;'>Недостаточно баллов для обмена на призы</span>";
                                    }
                                } else
                                {
                                    fwrite($fw, $newdate.' Результат: '.'Баллы необходимые на призы не равны сумме проверки'."\n\t");
                                    echo "Error(4)...<br>Обратитесь к Администратору";//----баллы необходимые на призы не равны сумме проверки----
                                }
                            } else
                            {
                                fwrite($fw, $newdate.' Результат: '.'Баллы из бд не совпадают с баллами в таблице'."\n\t");
                                echo 'Error(1)...<br>Обратитесь к Администратору'; //------баллы из бд не совпадают с баллами в таблице--------
                            }
                        }
                    } else
                    {
                        fwrite($fw, $newdate.' Результат: '.'Изменил ник и баллы'."\n\t");
                        echo "Error(2)...<br>Обратитесь к Администратору";//-------изменил ник и баллы---------
                    }
                } else
                {
                    fwrite($fw, $newdate.' Результат: '.'Ошибка БД'."\n\t");
                    echo "Not bd..."; //------нет результата-------
                }
            } else
            {
                fwrite($fw, $newdate.' Результат: '.'"не найдено" изменено на муть'."\n\t");
                echo "Error(3)...<br>Обратитесь к Администратору";// ---"не найдено" изменено на муть---------
            }
        } else if ($open == '2')
        {
            fwrite($fw, $newdate.' Результат: '.'Опрос закрыт на момент отправки'."\n\t");
            echo "<span style='text-align:center;'>К сожалению, на момент отправки, опрос был закрыт.<br>
						Заявка не отправлена</span>
					<meta http-equiv=\"refresh\" content=\"5;url=swap.php\">";
        }
    }
} else
{
    ini_alter('date.timezone','Europe/Moscow');
    $date = date('Y-m-d h:i:s');
    fwrite($fw, $newdate.' Результат: '.'Заполнил не все поля'."\n");
    //$post = print_r($_POST);
    fwrite($fw, $newdate.' Содержимое: '.json_encode($_POST)."\n");
    echo "<span style='text-align:center;'>Необходимо заполнить все данные!</span>";
}
fwrite($fw, $newdate.' end--'."\n\n");
fclose($fw);
?>

