<?php
$start = microtime(true);
set_time_limit(380);
ini_set('memory_limit', '128M');

if (!empty($_FILES['countfile'])) {
	$white_format = '.csv';
	$white_type = array('text/csv', 'application/vnd.ms-excel', 'text/plain');
	if (preg_match("/$white_format\$/i", $_FILES['countfile']['name']) == false) {
		echo 'Please upload only .csv format', die;
	}
	$fileinfo = finfo_open(FILEINFO_MIME_TYPE);
	$detected_type = finfo_file($fileinfo, $_FILES['countfile']['tmp_name']);
	if (in_array($detected_type, $white_type)) {
		include_once '../script/connect.php';
		$count_dir = '../script/uploads/';
		$count_files = $count_dir.basename($_FILES["countfile"]["name"]);
		if (move_uploaded_file($_FILES['countfile']['tmp_name'], $count_dir.'countfile.csv')) {
			$count_files = $count_dir.'countfile.csv';
			if (file_exists($count_files) !== false) {
				$file = fopen($count_files,"r");
				$i = 0;
				$importData_arr = array();
				while (($data = fgetcsv($file, 3000, ";")) !== FALSE) {
					$num = count($data);
					if ($num != 8) {
						echo 'Ошибка. Возможно файл сформирован не верно..', die;
					}
					for ($c=4; $c < 5; $c++) {  //берем только 5 столбец
						$importData_arr[$i][] = $data[$c];
						for ($c=7; $c < 8; $c++) { // берем только 8 столбец
							$importData_arr[$i][] = $data[$c];
						}
					}
					$i++;
				}
				foreach($importData_arr as $k => $array) {
					if ($array[0] == '' || NULL || false) { //удаляем пустые строки
						unset($importData_arr[$k]);
					}
					if (stripos($array[1], 'Boss') !== false) { // поиск содержания boss
						$importData_arr[$k][1] = '20';
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
				fclose($file);
				foreach($unique_array as $data) { // формируем в строки
						$update_count = "UPDATE tablballs SET balls=`balls`+'$data[1]' WHERE nickname='$data[0]'";
						$result = mysqli_query($link, $update_count) or die('Error: '.mysqli_error($link));
				}
				$nums = count($unique_array);
				echo 'sucsess<br>'.$nums.' строк<br>';
				echo 'Время выполнения скрипта: '.round(microtime(true) - $start, 4).' сек.';
				exit();

			} else {
				echo 'Ошибка загрузки файла в папку uploads';
			}
		}

	} else {
		echo '<br>';
		echo 'нет такого';
	}

} else
{
	echo 'Fail...';
}
?>
