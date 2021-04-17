<?php
if (isset($_POST['id_user']) && isset($_POST['nick_user'])) {
	include_once '../script/connect.php';
	$id_user = trim(htmlspecialchars(mysqli_real_escape_string($link, $_POST['id_user'])));
	$nick_user = trim(htmlspecialchars(mysqli_real_escape_string($link, $_POST['nick_user'])));
	//-------------------------------------------
	session_start();
	$names = $_SESSION['names'];
	//-------------------------------------------
	if($nick_user == true) {
		$select_nickname = "SELECT id,nickname FROM tablballs WHERE nickname ='$nick_user'";
		$rs_sl_nck = mysqli_query($link, $select_nickname) or die ('Error: '.mysqli_error($link));
		if($rs_sl_nck) {
			$res_nick = mysqli_fetch_assoc($rs_sl_nck);
			if($res_nick) {
				if((($res_nick['id'] == $id_user) && ($res_nick['nickname'] == $nick_user)) == false) {
					echo "id или ник не совпадают. Запроси никнейм ещё раз.";
					$link->close();
					exit();
				}
			} else {
				echo "<div class='modal_div_content' data-title='$nick_user не найден..'></div>";
				$link->close();
				exit();
			}
		}
		$query = "DELETE FROM tablballs WHERE id = '$id_user'";
		$result = mysqli_query($link, $query) or die('Error: '.mysqli_error($link));
		if($result) {
			$del_pnt_sql = "INSERT INTO changes_log(login_ad,section,field_one,field_two,field_three,field_four) VALUES ('$names', 'points', '$nick_user', 'row_deleted', '', '')";
			$res_del = mysqli_query($link, $del_pnt_sql) or die('Error :'.mysqli_error($link));
			if($res_del) {
				$echo = 'Запись добавлена. ';
			}
			echo "<div class='modal_div_content' data-title='".$echo."Результат $nick_user удален'></div>";
		}
	} else {
		echo "<div class='modal_div_content' data-title='Никнейм не может быть пустой'></div>";
	}
}  else {
	echo "<div class='modal_div_content' data-title='Не все данные в _POST'></div>";
}
?>