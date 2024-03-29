<?php
set_time_limit(380);
ini_set('memory_limit', '128M');

if (!empty($_FILES['countfile']['tmp_name'])) {
	include_once '../script/connect.php';
	//------------------------------
	session_start();
	$names = $_SESSION['names'];
	$logarr = array($names, 'points');
	//-------------------------------
	$white_format = '.csv';
	$white_type = array('text/csv', 'application/vnd.ms-excel', 'text/plain');
	if (preg_match("/$white_format\$/i", $_FILES['countfile']['name']) == false) {
		echo '<div class="modal_div_external count_result">Please upload only .csv format</div>';
		$link->close();
		exit;
	}
	$fileinfo = finfo_open(FILEINFO_MIME_TYPE);
	$detected_type = finfo_file($fileinfo, $_FILES['countfile']['tmp_name']);
	if (in_array($detected_type, $white_type)) {
		$count_dir = '../script/uploads/';
		$count_files = $count_dir.basename($_FILES['countfile']['name']);
		if (move_uploaded_file($_FILES['countfile']['tmp_name'], $count_dir.'countfile.csv')) {
			$count_files = $count_dir.'countfile.csv';
			if (file_exists($count_files) !== false) {
				$file = fopen($count_files,"r");
				$i = 0;
				$importData_arr = array();
				while (($data = fgetcsv($file, 3000, ";")) !== FALSE) {
					$num = count($data);
					if ($num != 8) {
						echo '<div class="modal_div_external count_result">Error, the file is not correct..</div>';
						$link->close();
						exit;
					}
					for ($c=4; $c < 5; $c++) {  //берем только 5 столбец
						$importData_arr[$i][] = $data[$c];
						for ($c=7; $c < 8; $c++) { // берем только 8 столбец
							$importData_arr[$i][] = $data[$c];
						}
					}
					$i++;
				}
				fclose($file);
				foreach($importData_arr as $k => $array) {
					if (stripos($array[1], 'Boss') !== false) { // поиск содержания boss
						$importData_arr[$k][1] = '20';
					}
					if ($array[0] == '' || NULL || false) { //удаляем пустые строки
						unset($importData_arr[$k]);
					}
				}
				foreach($importData_arr as $k => $array) {
					if (stripos($array[1], 'Courier') !== false) { // поиск обычных
						$importData_arr[$k][1] = '15';
					}
				}
				$unique_array = array();
				foreach($importData_arr as $data) { // удалляем дубликаты, складываем значения
					$hash = $data[0];
					if (isset($unique_array[$hash])) {
						$data[1] += $unique_array[$hash][1];
					}
					$unique_array[$hash] = $data;
				}
		//--------------инор лист-------------------------------------------
					if (!empty($unique_array)) {
					$check_ignore =  "SELECT nickname FROM tablballs WHERE exclude = '1'";
					$result = mysqli_query($link, $check_ignore) or die ('Error: '.mysqli_error($link));
					$rows = mysqli_num_rows($result);
					if ($rows > 0) {
						$ignore_array = array();
						for($i = 0; $i < $rows; ++$i) {
							$row = mysqli_fetch_row($result);
							$ignore_list[] = $row;
						}
						function compare_ignoreList($a, $b) {
							return strcmp($a[0], $b[0]);
						}
						$black_array = array_uintersect($unique_array, $ignore_list, 'compare_ignoreList'); // формируем ник-баллы для игнора
						$white_array = array_udiff($unique_array, $ignore_list, 'compare_ignoreList'); // удалляем из массива список тех кто есть в листе игнора
						$blackForSql = array();
						if(!empty($black_array)) {
							foreach($black_array as $data) {
								$data[2] = 0;
								$blackForSql[] = "('". $data[0] ."','" . $data[1] . "','" . $data[2] . "')";
							}
						}
						if(!empty($blackForSql)) {
							$black_query = " insert into ignoresstory (nickname, points, accrued) values " . implode(",", $blackForSql);
							$result = mysqli_query($link, $black_query) or die ('Error: '.mysqli_error($link));
							$logarr[] = 'Игнор лист сформирован';
							$emptyignore = 'Игнор лист сформирован.';
						} else {
							$logarr[]= 'В csv не найдены никнеймы для игнора. ';
						}
					} else {
						$emptyignore = 'Игнор лист пуст.';
						$logarr[] = 'В таблице баллов нет ников для игнора. ';
						$white_array = $unique_array;
					}
				} else {
					echo '<div class="modal_div_external count_result">Error in the formation of consolidation points 105</div>';
					$link->close();
					exit;
				}
		//--END--------------инор лист-------------------------------------------
		//-запрос UPDATE-----
				$update_count = "UPDATE tablballs SET balls=`balls`+? WHERE nickname=?";
				$stmt = mysqli_prepare($link, $update_count);
				$false_update = array();
				foreach ($white_array as  $row) {
					mysqli_stmt_bind_param($stmt,"ss", $row[1], $row[0]);
					mysqli_stmt_execute($stmt);
					if(mysqli_stmt_affected_rows($stmt) == false) {// кидаем в массив ник/баллы если update их не затронул
						$row[2] = "";
						$row[3] = 0;
						$false_update[] = "('". $row[0] ."','" . $row[1] . "','" . $row[2] . "','" . $row[3] . "')";
					}
				}
				mysqli_stmt_close($stmt);
		//-END-----
				if(!empty($false_update)) { // добавляем, если update false----------
					$false_query = " insert into tablballs (nickname, balls, history, exclude) values " . implode(",", $false_update);
					$result = mysqli_query($link, $false_query) or die ('Error: '.mysqli_error($link));
					if($result) {
						$logarr[]= 'Отсутствующие никнеймы в таблице добавлены. ';
						$emptynicknames = 'Новые никнеймы добавлены.';
					}
				}
				$delet_files = $count_files;
				if (file_exists($delet_files)) {
					unlink($delet_files);
					echo '<div class="modal_div_external count_result">Загрузка завершена. '.$emptyignore.' '.$emptynicknames.'</div>';
					$logarr[] = 'Баллы подсчитаны, файл удален. ';
					if($_POST['date_check']) {
						$date_points = date('d.m.y', strtotime(date('d.m.Y H:i:s')));
						$update_date = "UPDATE formobmen SET `open`='$date_points' WHERE id=2";
						$result_update_date = mysqli_query($link, $update_date) or die('Error '.mysqli_error($link));
					}
				}
			} else {
				echo '<div class="modal_div_external count_result">Error, countfile.csv is not moved to uploads..</div>';
				$logarr[] = 'Невозможно переместить '.$_FILES['countfile']['tmp_name'].' => '.$count_dir.'countfile.csv';
			}
		}
		unset($white_array);
		unset($importData_arr);
		unset($unique_array);
		unset($black_array);
		unset($false_update);
	}
	else
	{
		echo '<div class="modal_div_external count_result">Please upload only .csv format</div>';
		$logarr[] = 'Нельзя использовать такой тип файла '.$fileinfo.' => '.$detected_type;
	}
	if(!empty($logarr)) {
		$insertlogarr = array();
		foreach($logarr as $data) {
			$insertlogarr[] = "'".$data."'";
		}
		$countarr = count($insertlogarr);
		if ($countarr < 5) {
			for($i = $countarr;$i < 5; $i++) {
				$insertlogarr[] = "'".''."'";
			}
		}
		$insertlogarr = implode(", ", $insertlogarr);
		$conts_log = "INSERT INTO tbl_exim_log(login_ad,section,field_one,field_two,field_three) VALUES ($insertlogarr)";
		$res_counts_log = mysqli_query($link, $conts_log) or die ('Error :'.mysqli_error($link));
		$link->close();
	}
} else
{
	echo '<div class="modal_div_external count_result">File selected ?</div>';
}
?>