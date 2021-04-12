<?php
set_time_limit(180);
setLocale(LC_ALL, 'ru_RU.CP1251');

if(!empty($_FILES['imp_file']['tmp_name'])){
	include_once "../script/connect.php";
	$target_dir = "../script/uploads/";
	$target_file = $target_dir . basename($_FILES["imp_file"]["name"]);
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$uploadOk = 1;
	if($imageFileType != "csv" ) {
		$uploadOk = 0;
	}
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

				$dataForSql = array();
				while (($data = myfgetcsv($file, ";")) !== FALSE) {
					$dataForSql[] = "('".$data[0]."','".$data[1]."','".$data[2]."','". $data[3]."')";
				}
				fclose($file);

				if (!empty($dataForSql)) {
					$insert_query = "insert into itogobmen (dates,nickname,itog,prichina) values " . implode(",", $dataForSql);
					mysqli_query($link, $insert_query);
				}

				$newtargetfile = $target_file;
				if (file_exists($newtargetfile)) {
					unlink($newtargetfile);
					$imp_table = "INSERT INTO tbl_exim_log(login_ad,section,field_one,field_two,field_three) VALUES ('$names', 'results', 'Импорт таблицы', '', '')";
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

function myfgetcsv($file, $separator){
	if($str=fgets($file)) {
		$data=split($separator, trim($str));
		return $data;
	}

	return false;
}
?>