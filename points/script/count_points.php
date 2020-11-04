<?php
set_time_limit(380);
ini_set('memory_limit', '128M');

if (!empty($_FILES['countfile']['tmp_name'])) {
	include_once '../script/connect.php';
	//------------------------------
	session_start();
	$login = $_SESSION['login'];
	$file_login = "../logfiles/points_log.log";
	$fw = fopen($file_login, "a+");
	$date = date('Y-m-d h:i:s');
	$newdate = date('Y-m-d h:i:s A', strtotime($date));
	//-------------------------------
	$white_format = '.csv';
	$white_type = array('text/csv', 'application/vnd.ms-excel', 'text/plain');
	if (preg_match("/$white_format\$/i", $_FILES['countfile']['name']) == false) {
		echo '<div class="modal_div_external count_result">Please upload only .csv format</div>';
		fwrite($fw, $newdate.' '.$login.' Нельзя использовать такой тип => '.$_FILES['countfile']['name']."\r\n");
		fclose($fw);
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
						fwrite($fw, $newdate.' '.$login.' В файле '.$count_files.' '.$num.' столбцов '."\r\n");
						fclose($fw);
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
				if (!empty($importData_arr)) {
					$check_ignore =  "SELECT nickname FROM tablballs WHERE exclude = '1'";
					$result = mysqli_query($link, $check_ignore) or die (fwrite($fw, $newdate.' '.$login.' Error: '.mysqli_error($link)."\r\n"));
					$rows = mysqli_num_rows($result);
					if ($rows > 0) {
						for($i = 0; $i < $rows; ++$i) {
							$row = mysqli_fetch_row($result);
							$ignore_list[] = $row;
						}
						//создать бд игнора
						function compare_ignoreList($a, $b) {
							return strcmp($a[0], $b[0]);
						}
						$white_array = array_udiff($importData_arr, $ignore_list, 'compare_ignoreList'); // удалляем из массива список тех кто есть в листе игнора
					} else {
						$emptyignore = 'Игнор лист пуст';
						$white_array = $importData_arr; // если игнор лист пуст
					}
				} else {
					echo '<div class="modal_div_external count_result">Error, array is empty..</div>';
					fwrite($fw, $newdate.' '.$login.' Не сформирован массив из файла'."\r\n");
					fclose($fw);
					exit;
				}

				foreach($white_array as $k => $array) {
					if ($array[0] == '' || NULL || false) { //удаляем пустые строки
						unset($white_array[$k]);
					}
					if (stripos($array[1], 'Boss') !== false) { // поиск содержания boss
						$white_array[$k][1] = '20';
					}
				}
				foreach($white_array as $k => $array) {
					if (stripos($array[1], 'Courier') !== false) { // поиск обычных
						$white_array[$k][1] = '15';
					}
				}
				$unique_array = array();
				foreach($white_array as $data) { // удалляем дубликаты, складываем значения
					$hash = $data[0];
					if (isset($unique_array[$hash])) {
						$data[1] += $unique_array[$hash][1];
					}
					$unique_array[$hash] = $data;
				}
				foreach($unique_array as $data) { // более путного способа не придумал и не нашел
						$update_count = "UPDATE tablballs SET balls=`balls`+'$data[1]' WHERE nickname='$data[0]'";
						$result = mysqli_query($link, $update_count) or die (fwrite($fw, $newdate.' '.$login.' Error: '.mysqli_error($link)."\r\n"));
				}

				$delet_files = $count_files;
				if (file_exists($delet_files)) {
					unlink($delet_files);
					echo '<div class="modal_div_external count_result">Загрузка завершена</div>';
					fwrite($fw, $newdate.' '.$login.' Баллы подсчитаны, файл удален.'."\r\n");
				}
			} else {
				echo '<div class="modal_div_external count_result">Error, countfile.csv is not moved to uploads..</div>';
				fwrite($fw, $newdate.' '.$login.' Невозможно переместить '.$_FILES['countfile']['tmp_name'].' => '.$count_dir.'countfile.csv'."\r\n");
			}
		}
		$link->close();
		unset($unique_array);
		unset($white_array);
	}
	else
	{
		echo '<div class="modal_div_external count_result">Please upload only .csv format</div>';
		fwrite($fw, $newdate.' '.$login.' Нельзя использовать такой тип '.$fileinfo.' => '.$detected_type."\r\n");
	}
	fclose($fw);
} else
{
	echo '<div class="modal_div_external count_result">File selected?</div>';
}
?>