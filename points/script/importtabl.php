<?php
set_time_limit(380);
ini_set('memory_limit', '128M');

        include_once "../script/connect.php";
        if(isset($_POST['but_import'])){
            $target_dir = '../script/uploads/';
            $target_file = $target_dir . basename($_FILES['importfile']['name']);
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            $uploadOk = 1;
            if($imageFileType != "csv" ) {
                $uploadOk = 0;
            }
//            var_dump($uploadOk, $target_file); die;
            if ($uploadOk != 0) {
				//------------------------------
				$login = $_SESSION['login'];
				$logarr = array('points', 'import csv points', $login);
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
                            $logarr[] = 'import -> true';
                            echo "<b style='color:red'>Загрузка завершена</b>";
                        }
                    }
                    require_once '../script/LogAdminAction.php';
					$link->close();
                }
            }
        }
        ?>