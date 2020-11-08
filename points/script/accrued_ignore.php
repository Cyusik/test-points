<?php
if(isset($_POST['id_ignore'])) {
	$id_ignore = trim(intval($_POST['id_ignore']));
	if ($id_ignore != ""){
		include_once 'connect.php';
		//--------------------------
		$login = $_SESSION['login'];
		$file_login = "../logfiles/points_log.log";
		$fw = fopen($file_login, "a+");
		$date = date('Y-m-d h:i:s');
		$newdate = date('Y-m-d h:i:s A', strtotime($date));
		//--------------------------
		$select_idIg = "SELECT id,nickname,points,accrued FROM ignoresstory WHERE id ='$id_ignore'";
		$result = mysqli_query($link, $select_idIg) or die(fwrite($fw, $newdate.' Ошибка accrued_ignore.php (16): '.mysqli_error($link)."\n"));
		$row = mysqli_fetch_row($result);
		if (!empty($row)) {
			$id = $row[0];
			$nickname = $row[1];
			$points = $row[2];
			$update_ignore = "UPDATE tablballs TB, ignoresstory IG SET TB.balls = `balls`+'$points' WHERE TB.nickname = '$nickname'";
			$result = mysqli_query($link, $update_ignore) or die(fwrite($fw, $newdate.' Ошибка accrued_ignore.php (22): '.mysqli_error($link)."\n"));
			if ($result) {
				echo 'Игроку '.$nickname.' начислено '.$points.' баллов';
				fwrite($fw, $newdate.' '.$login.' add points => '.$points.' ignore => '.$nickname."\r\n");
				$accrued = "UPDATE ignoresstory SET accrued = '1' WHERE id = '$id'";
				$result = mysqli_query($link, $accrued) or die(fwrite($fw, $newdate.' Ошибка accrued_ignore.php (22): '.mysqli_error($link)."\n"));
				fwrite($fw, $newdate.' '.$login.' accrued ignore = 1 '.$nickname."\r\n");
			}
		} else {
			echo '<div class="modal_div_external count_result">Error, not found id..</div>';
			fwrite($fw, $newdate.' '.$login.' ignore ID empty => '.$row."\r\n");
		}
		fclose($fw);
		$link->close();
	}
}
?>