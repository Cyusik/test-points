<?php
if(isset($_POST['id_ignore'])) {
	$id_ignore = trim(intval($_POST['id_ignore']));
	if ($id_ignore != ""){
		include_once 'connect.php';
		//--------------------------
		session_start();
		$login = $_SESSION['login'];
		$file_login = "../logfiles/points_log.log";
		$fw = fopen($file_login, "a+");
		$logarr = array('points', 'accured ignore', $login);
		include_once 'datetime.php';
		//--------------------------
		$select_idIg = "SELECT id,date,nickname,points,accrued FROM ignoresstory WHERE id ='$id_ignore'";
		$result = mysqli_query($link, $select_idIg) or die(fwrite($fw, $newdate.' Ошибка accrued_ignore.php (16): '.mysqli_error($link)."\n"));
		$row = mysqli_fetch_row($result);
		if (!empty($row)) {
			$id = $row[0];
			$dates = $row[1];
			$nickname = $row[2];
			$points = $row[3];
			$update_ignore = "UPDATE tablballs TB, ignoresstory IG SET TB.balls = `balls`+'$points' WHERE TB.nickname = '$nickname'";
			$result = mysqli_query($link, $update_ignore) or die(fwrite($fw, $newdate.' Ошибка accrued_ignore.php (22): '.mysqli_error($link)."\n"));
			if ($result) {
				echo 'Игроку '.$nickname.' начислено '.$points.' баллов';
				fwrite($fw, $newdate.' '.$login.' add points => '.$points.' ignore => '.$nickname."\r\n");
				$accrued = "UPDATE ignoresstory SET accrued = '1' WHERE id = '$id'";
				$result = mysqli_query($link, $accrued) or die(fwrite($fw, $newdate.' Ошибка accrued_ignore.php (22): '.mysqli_error($link)."\n"));
				$logResult = array($dates, $nickname, $points, 'начислено');
			}
		} else {
			echo '<div class="modal_div_external count_result">Error, not found id..</div>';
		}
		$logarr = array_merge($logarr, $logResult);
		require_once 'LogAdminAction.php';
		fclose($fw);
		$link->close();
	}
}
?>