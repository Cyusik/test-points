<?php
if (isset($_POST['dates']) && isset($_POST['nickname'])  && isset($_POST['itog']) && isset($_POST['prichina'])) {
	include_once '../script/connect.php';
	$db_table = "itogobmen";
	$dates = trim(htmlspecialchars(mysqli_real_escape_string($link, $_POST['dates'])));
	$dates = str_replace("T", " ", $dates);
	$nickname = trim(htmlspecialchars(mysqli_real_escape_string($link, $_POST['nickname'])));
	$itog = trim(htmlspecialchars(mysqli_real_escape_string($link, $_POST['itog'])));
	$prichina = trim(htmlspecialchars(mysqli_real_escape_string($link, $_POST ['prichina'])));
	//---------------------------------------
	session_start();
	$login = $_SESSION['login'];
	$file_login = "../logfiles/results_log.log";
	$fw = fopen($file_login, "a+");
	$logarr = array('exchange', 'add nickname', $login);
	$valueslog = array($dates, $nickname, $itog, $prichina);
	$logarr = array_merge($logarr, $valueslog);
	include_once '../script/datetime.php';
	//fwrite($fw, $newdate.' '.$login.' Добавил: '.'nick=>'.$nickname.'; result=>'.$itog.' cause=>'.$prichina."\r\n");
	//---------------------------------------
		if($nickname != "") {
			  if($itog != "") {
					  $result = $link->query("INSERT INTO ".$db_table." (dates,nickname,itog,prichina) VALUES ('$dates','$nickname','$itog','$prichina')");
					  if($result) {
						 // fwrite($fw, $newdate.' result=>true'."\r\n");
						  $logarr[] = 'result true';
						  echo "<div class='modal_div_content' data-title='Строка добавлена...'></div>";
					  }
					  else {
						  echo "<b style='color:red'>Ошибка скрипта подключения к базе</b>";
					  }
				  }else {
				  echo "<div class='modal_div_content' data-title='Выбери итог выдачи'></div>";
			  }
			  }else {
			echo "<div class='modal_div_content' data-title='Заполни поле никнейм'></div>";
		}
		require_once 'LogAdminAction.php';
		fclose($fw);
		$link->close();
}
?>
