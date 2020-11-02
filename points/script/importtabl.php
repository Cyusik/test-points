<?php
set_time_limit(380);
ini_set('memory_limit', '128M');

        include_once "../script/connect.php";
        if(isset($_POST['but_import'])){
            $target_dir = '../script/uploads/';
            $target_file = $target_dir . basename($_FILES["importfile"]["name"]);
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            $uploadOk = 1;
            if($imageFileType != "csv" ) {
                $uploadOk = 0;
            }
 //          var_dump($uploadOk, $target_file); die;
            if ($uploadOk != 0) {
				//------------------------------
				$login = $_SESSION['login'];
				$file_login = "../logfiles/points_log.log";
				$fw = fopen($file_login, "a+");
				$date = date('Y-m-d h:i:s');
				$newdate = date('Y-m-d h:i:s A', strtotime($date));
				fwrite($fw, $newdate.' '.$login.' Импортировал таблицу points(tablballs)'."\r\n");
				fclose($fw);
				//-------------------------------
                if (move_uploaded_file($_FILES["importfile"]["tmp_name"], $target_dir.'importfile.csv')) {
                    $target_file = $target_dir . 'importfile.csv';
                    $fileexists = 0;
                    if (file_exists($target_file)) {
                        $fileexists = 1;
                    }
                    if ($fileexists == 1 ) {
                        $file = fopen($target_file,"r");
                        $i = 0;
                        $importData_arr = array();
                        while (($data = fgetcsv($file, 3000, ";")) !== FALSE) {
                            $num = count($data);
                           for ($c=4; $c < 5; $c++) {
                           			$importData_arr[$i][] = $data[$c];
                           		for ($c=7; $c < 8; $c++) {
									$importData_arr[$i][] = $data[$c];
								}
                            }
							$i++;
                        }
						//echo 'сначала Босс<br>';
                        foreach($importData_arr as $k => $array) {
                        	if ($array[0] == '' || NULL || false) {
									unset($importData_arr[$k]);
                        	}
							if (stripos($array[1], 'Boss') !== false) {
								$importData_arr[$k][1] = '20';
							}
                        }
						//echo 'Теперь обычные<br>';
                        foreach($importData_arr as $k => $array) {
							if (stripos($array[1], 'Courier') !== false) {
								$importData_arr[$k][1] = '15';
							}
						}
						// удалляем дубликаты, складываем значения
						$unique_array = array();
						foreach($importData_arr as $data) {
							$hash = $data[0];
							if (isset($unique_array[$hash])) {
								$data[1] += $unique_array[$hash][1];
							}
							$unique_array[$hash] = $data;
						}
                        fclose($file);
						// формируем в строки
                        $dataForSql = array();
                        foreach($unique_array as $data) {
                                $dataForSql[] = "('". $data[0] ."','" . $data[1] . "')";
                        }
						echo '<pre>';
						print_r($dataForSql);
						exit;

	                    if (!empty($dataForSql)) {
		                    $insert_query = " insert into tablballs (nickname, balls, history) values " . implode(",", $dataForSql);
		                    mysqli_query($link, $insert_query);
	                    }

                        $newtargetfile = $target_file;
                        if (file_exists($newtargetfile)) {
                            unlink($newtargetfile);
                            echo "<b style='color:red'>Загрузка завершена</b>";
                        }
                    }
					$link->close();
                }
            }
        }
        ?>