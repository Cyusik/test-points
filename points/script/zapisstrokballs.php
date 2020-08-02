<?php
if(isset($_POST['nickname']) && isset($_POST['balls']) && isset($_POST['history'])) {
		include_once '../script/connect.php';
		$db_table = "tablballs";
		$nickname = trim($_POST['nickname']);
		$balls = trim($_POST['balls']);
		$history = $_POST ['history'];
		if($nickname != "") {
			if($balls != "") {
				$result = $link->query("INSERT INTO ".$db_table." (nickname,balls,history) VALUES ('$nickname','$balls','$history')");
				if($result) {
					echo "<div class='modal_div_content' data-title='Строка добавлена...'></div>";
				}
				else {
					echo "<div class='modal_div_content' data-title='Нет ответа от БД'></div>";
				}
			}
			else {
				echo "<div class='modal_div_content' data-title='Заполни никнейм/баллы'></div>";
			}
		}
		else {
			echo "<div class='modal_div_content' data-title='Заполни никнейм/баллы'></div>";
		}
		$link->close();
	}
?>