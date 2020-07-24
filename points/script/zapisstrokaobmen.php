<?php
if (isset($_POST['dates']) && isset($_POST['nickname'])  && isset($_POST['itog']) && isset($_POST['prichina'])) {
	include_once '../script/connect.php';
	$db_table = "itogobmen";
	$dates = $_POST['dates'];
	$nickname = $_POST['nickname'];
	$itog = $_POST['itog'];
	$prichina = $_POST ['prichina'];
	if ($dates == true) {
		if($nickname == true) {
			  if($itog == true) {
					  $result = $link->query("INSERT INTO ".$db_table." (dates,nickname,itog,prichina) VALUES ('$dates','$nickname','$itog','$prichina')");
					  if($result == true) {
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
			} else {
		echo "<div class='modal_div_content' data-title='Заполни поле даты'></div>";
	} $link->close();
}
?>
