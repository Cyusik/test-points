<?php
if (isset($_POST['dates']) && isset($_POST['nickname'])  && isset($_POST['itog']) && isset($_POST['prichina'])) {
	include_once '../script/connect.php';
	$db_table = "itogobmen";
	$dates = $_POST['dates'];
	$nickname = trim($_POST['nickname']);
	$itog = trim($_POST['itog']);
	$prichina = $_POST ['prichina'];
		if($nickname != "") {
			  if($itog != "") {
					  $result = $link->query("INSERT INTO ".$db_table." (dates,nickname,itog,prichina) VALUES ('$dates','$nickname','$itog','$prichina')");
					  if($result) {
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
		}$link->close();
}
?>
