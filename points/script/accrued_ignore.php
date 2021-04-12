<?php
if(isset($_POST['id_ignore'])) {
	$id_ignore = trim(intval($_POST['id_ignore']));
	if ($id_ignore != ""){
		include_once '../script/connect.php';
		//--------------------------
		session_start();
		$names = $_SESSION['names'];
		//--------------------------
		$select_idIg = "SELECT id,date,nickname,points,accrued FROM ignoresstory WHERE id ='$id_ignore'";
		$result_idIg = mysqli_query($link, $select_idIg) or die('Error: '.mysqli_error($link));
		$row = mysqli_fetch_row($result_idIg);
		if (!empty($row)) {
			$id = $row[0];
			$dates = $row[1];
			$nickname = $row[2];
			$points = $row[3];
			$update_ignore = "UPDATE tablballs TB, ignoresstory IG SET TB.balls = `balls`+'$points' WHERE TB.nickname = '$nickname'";
			$result_update = mysqli_query($link, $update_ignore) or die('Error: '.mysqli_error($link));
			if ($result_update) {
				$accrued = "UPDATE ignoresstory SET accrued = '1' WHERE id = '$id'";
				$result_acc = mysqli_query($link, $accrued) or die('Error: '.mysqli_error($link));
				if($result_acc) {
					$ins_ig_log = "INSERT INTO ign_log(login_ad,action,ig_nickname,f_time) VALUES ('$names', 'add $points points', '$nickname', '$dates')";
					$res_ig_log = mysqli_query($link, $ins_ig_log) or die ('Error: '.mysqli_error($link));
					echo '<div>'.$nickname.' начислено '.$points.' баллов</div>';
				}
			}
		} else {
			echo '<div>Error, not found id..</div>';
		}
		$link->close();
	}
}
?>