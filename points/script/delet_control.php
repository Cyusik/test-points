<?php
if(isset($_POST['del_login'])) {
	include_once '../script/connect.php';
	//----------------------------------
	session_start();
	$names = $_SESSION['names'];
	//----------------------------------
	if($_POST['del_login'] != "") {
		if(preg_match("/^[a-z0-9-_]{3,30}$/i", $_POST['del_login']) == false) {
			echo "А такой логин есть? Не должен быть";
			$link->close();
			exit();
		}
		else {
			$del_login = trim(htmlspecialchars(mysqli_real_escape_string($link, $_POST['del_login'])));
		}
	}
	else {
		echo "Как искать без логина?";
		$link->close();
		exit();
	}
	if(!empty($del_login)) {
		$ch_name = "SELECT name_user,login_user FROM users WHERE login_user = '$del_login'";
		$res_name = mysqli_query($link, $ch_name) or die("Error: ".mysqli_error($link));
		if($res_name) {
			$check_n = mysqli_fetch_assoc($res_name);
			if($check_n == false) {
				echo "Такого юзера нет";
				$link->close();
				exit();
			}
			if($check_n['name_user'] == $names) {
				echo "Чтобы удалить себя, зайди с другого юзера";
				$link->close();
				exit();
			}
			else {
				$check_role = "SELECT login_user,role FROM users WHERE role = 1";
				$res_role = mysqli_query($link, $check_role) or die("Error: ".mysqli_error($link));
				if($res_role) {
					$check_num_role = mysqli_num_rows($res_role);
					if($check_num_role == 1) {
						$ch_lg = mysqli_fetch_assoc($res_role);
						if($ch_lg['login_user'] == $del_login) {
							echo "Похоже ты единственный админ. Создай ещё одного, потом удалишь";
							$link->close();
							exit();
						}
					}
					$del_us = "DELETE FROM users WHERE login_user = '$del_login'";
					$res_us = mysqli_query($link, $del_us) or die("Error: ".mysqli_error($link));
					if($res_us) {
						$ins_dl = "INSERT INTO control_log(login_ad,action,field_one,field_two,field_three) VALUES ('$names', 'delet_user', '$del_login', '', '')";
						$res_ins_dl = mysqli_query($link, $ins_dl) or die("Error: ".mysqli_error($link));
						if($res_ins_dl) {
							$echo = 'Запись добавлена. ';
						}
						echo $echo.$del_login.' удалён.';
					}
				}
			}
		}
	}
	else {
		echo "Логин обязателен";
	}
	$link->close();
}
else {
	echo "Не все данные в _POST";
}
?>
