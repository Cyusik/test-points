<?php
if(isset($_POST['search_contests']) && $_POST['add_points'] && $_POST['cause']) {
	include_once '../script/connect.php';
	$add_points = array();
	foreach($_POST['search_contests'] as $k => $d) {
		foreach($_POST['add_points'] as $y => $c) {
			if($k == $y) {
				$add_points[$k][] = trim(htmlspecialchars(mysqli_real_escape_string($link, $d)));
				if(preg_match("/[^0-9]/", $c) == false) {
					$add_points[$k][] = intval($c);
				} else {
					$result = "Одно или несколько значений не верны";
					break;
				}
			}
		}
	}
	$cause = $_POST['cause'];
	if(empty($cause)) {
		echo "Необходимо указать причину";
		$link->close();
		exit();
	}
	if($result) {
		echo $result;
		$link->close();
		exit();
	} else {
		$update_count = "UPDATE tablballs SET balls=`balls`+? WHERE nickname=?";
		$stmt = mysqli_prepare($link, $update_count);
		$false_update = array();
		foreach ($add_points as  $row) {
			mysqli_stmt_bind_param($stmt,"ss", $row[1], $row[0]);
			mysqli_stmt_execute($stmt);
			if(mysqli_stmt_affected_rows($stmt) == false) {// кидаем в массив ник/баллы если update их не затронул
				$false_update[] = $row[0].' = '.$row[1];
			}
		}
		mysqli_stmt_close($stmt);
		if(!empty($false_update)) {
			$false_update = implode(", ", $false_update);
			echo "Не начислено: ".$false_update;
			$link->close();
			exit();
		}
		//-------------запись в историю начислений----------------
		session_start();
		$names = $_SESSION['names'];
		$log_arr = array();
		foreach($add_points as $k => $d) {
			foreach($cause as $e => $c) {
				if($k == $e) {
					$log_arr[$k][] = $names;
					$log_arr[$k][] = $d[0];
					$log_arr[$k][] = $d[1];
					$log_arr[$k][] = htmlspecialchars(mysqli_real_escape_string($link, $c));
				}
			}
		}
		$num_insert = 0;
		foreach($log_arr as $k => $date) {
			$insert_log_arr = "INSERT INTO contests_log(login_ad,nickname,points,cause) VALUES ('$date[0]','$date[1]','$date[2]','$date[3]')";
			$result_insert = mysqli_query($link, $insert_log_arr) or die ("Error: ".mysqli_error($link));
			if($result_insert) {
				++$num_insert;
			}
		}
		//------------конец записи--------------------------------
		if($num_insert != 0) {
			echo "Начислено. "."Записей добавлено = ".$num_insert;
		}
	}
} else {
	echo 'Не все поля получены..';
}
?>