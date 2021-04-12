<?php
set_time_limit(380);
ini_set('memory_limit', '128M');

        if(!empty($_FILES['imp_file']['tmp_name'])){
			include_once "../script/connect.php";
            $target_dir = '../script/uploads/';
            $target_file = $target_dir . basename($_FILES['imp_file']['name']);
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            $uploadOk = 1;
            if($imageFileType != "csv" ) {
                $uploadOk = 0;
            }
//            var_dump($uploadOk, $target_file); die;
            if ($uploadOk != 0) {
				//------------------------------
				session_start();
				$names = $_SESSION['names'];
				//-------------------------------
                if (move_uploaded_file($_FILES["imp_file"]["tmp_name"], $target_dir.'imp_file.csv')) {
                    $target_file = $target_dir . 'imp_file.csv';
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
                            for ($c=0; $c < $num; $c++) {
                                $importData_arr[$i][] = $data[$c];
                            }
                            $i++;
                        }
                        fclose($file);
                        $dataForSql = array();
                        foreach($importData_arr as $data) {
                                $dataForSql[] = "('". $data[0] ."','" . $data[1] . "','" . $data[2] . "','" . $data[3] . "','" . $data[4] . "','" . $data[5] . "','" . $data[6] . "')";
                        }

	                    if (!empty($dataForSql)) {
		                    $insert_query = " insert into tablballs (nickname, balls, history, exclude, login_one, login_two, login_three) values " . implode(",", $dataForSql);
		                    mysqli_query($link, $insert_query);
	                    }

                        $newtargetfile = $target_file;
                        if (file_exists($newtargetfile)) {
                            unlink($newtargetfile);
                            $imp_table = "INSERT INTO tbl_exim_log(login_ad,section,field_one,field_two,field_three) VALUES ('$names', 'points', 'Импорт таблицы', '', '')";
                            $res_imp = mysqli_query($link, $imp_table);
                            if($res_imp) {
								echo "<b style='color:red'>Загрузка завершена</b>";
							}
                        }
                    }
					$link->close();
                }
            }
        }
        ?>