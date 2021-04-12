<?php
if(isset($_POST['new_login']) && isset($_POST['new_password']) && isset($_POST['new_priorty'])) {
	include_once '../script/connect.php';
	$upd_arr = array();
	//-----------------------
	session_start();
	$names = $_SESSION['names'];
	$ins_lg = array("'$names'", "'changed'");
	//-----------------------
	if($_POST['new_login'] != "") {
		if(preg_match("/^[a-z0-9-_]{3,30}$/i", $_POST['new_login']) == false) {
			echo "А такой логин есть? Не должен быть";
			$link->close();
			exit();
		} else {
			$login = trim(htmlspecialchars(mysqli_real_escape_string($link, $_POST['new_login'])));
			$ins_lg[] = "'$login'";
		}
	} else {
		echo "Как искать без логина?";
		$link->close();
		exit();
	}
	if($_POST['new_password'] != "") {
		if(preg_match("/^[а-яё]+$/iu", $_POST['new_password'])) {
			echo "Пароль не может содержать кириллицу";
			$link->close();
			exit();
		} else {
			$password = trim(htmlspecialchars(mysqli_real_escape_string($link, $_POST['new_password'])));
			$salt = $login.'login_user';
			$upd_arr['password_user'] = hash("sha256", $password.$salt);
		}
	}
	if($_POST['new_priorty'] != "") {
		if((($_POST['new_priorty'] == '1') || ($_POST['new_priorty'] == '2') || ($_POST['new_priorty'] == '3')) == false) {
			echo 'Роль может быть только 1 или 2 или 3';
			$link->close();
			exit();
		} else {
			$upd_arr['role'] = $_POST['new_priorty'];
		}
	}
	if(!empty($upd_arr)) { //логин в бд может быть только 1 такой
		$check_data = "SELECT login_user,password_user,role FROM users WHERE login_user = '$login'"; // чекаем данные того кого редачим
		$res_dt = mysqli_query($link, $check_data) or die('Error: '.mysqli_error($link));
		if($res_dt) {
			$check_inf = mysqli_fetch_assoc($res_dt);
			if(empty($check_inf)) {
				echo "Нет такого логина";
				$link->close();
				exit();
			}
			$itogarr = array_diff_assoc($upd_arr, $check_inf);
			if(!empty($itogarr)) {
				foreach($itogarr as $tbcolumn => $data) {
					$update_sql[] = $tbcolumn."="."'".$data."'";
					if($tbcolumn == 'password_user') {
						$ins_lg[] = "'Смена пароля'";
					}
					if($tbcolumn == 'role') {
						$ins_lg[] = "'Смена роли = ".$data."'";
					}
				}
			}
			else {
				echo "Нет изменений для обновления";
				$link->close();
				exit();
			}
			if(($itogarr['role'] != "") && ($itogarr['role'] != 1)) {
				$check_role = "SELECT login_user,role FROM users WHERE role = 1";
				$res_role = mysqli_query($link, $check_role) or die("Error: ".mysqli_error($link));
				if($res_role) {
					$check_num_role = mysqli_num_rows($res_role);
					if($check_num_role == 1) { // если у нас остался только 1 админ, то нельзя допустить чтоб его отредачили
						$ch_lg = mysqli_fetch_assoc($res_role);
						if($ch_lg['login_user'] == $login) {
							echo "Сначала сделай ещё 1 админку";
							$link->close();
							exit();
						}
					}
				}
			}
			if(!empty($update_sql)) {
				$update_sql = implode(", ", $update_sql);
				$upd_ad = "UPDATE users SET $update_sql WHERE login_user='$login'";
				$res_up = mysqli_query($link, $upd_ad) or die('Error: '.mysqli_error($link));
				if($res_up) {
					$num_mass = count($ins_lg);
					if($num_mass < 5) {
						for($i = $num_mass;$i < 5; $i++) {
							$ins_lg[] = "'".''."'";
						}
					}
					$ins_lg = implode(", ", $ins_lg);
					$ins_up_ct = "INSERT INTO control_log(login_ad,action,field_one,field_two,field_three) VALUES ($ins_lg)";
					$res_up_ct = mysqli_query($link, $ins_up_ct) or die('Error: '.mysqli_error($link));
					if($res_up_ct) {
						$echo = "Запись добавлена. ";
					}
					echo $echo.'Обновлены изменения'; // сделать запись в лог
				}
			}
		}
	} else {
		echo 'Укажи новый пароль или роль';
	}
} else {
	echo "Не все данные в _POST";
}
?>