<?php
$search = mb_strimwidth($_GET['search'], 0, 21);
if($search == false) {
	//echo "Вы не ввели никнейм. Вывод общего списка";
	require_once 'script/connect.php';
	mysqli_query($link, "SET NAMES 'utf8'");
	if(isset($_GET['page'])) {
		$page = intval($_GET['page']);
	}
	else {
		$page =intval(1);
	}
	$notesOnPage = 50;
	$id = 0;
	$from = ($page - 1) * $notesOnPage;
	if ($from >= 0) {
	$sql = "SELECT * FROM itogobmen WHERE id > %d ORDER BY dates DESC LIMIT %s,%s";
		$query = sprintf($sql, mysqli_real_escape_string($link, $id), mysqli_real_escape_string($link, $from), mysqli_real_escape_string($link, $notesOnPage));
	$result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));
	if($result) {
		$rows = mysqli_num_rows($result);// количество полученных строк
		echo "<table id='range1' class='table_dark'><tr>
					<th>id</th>
					<th style='width:140px'>Дата и время заявки</th>
					<th style='width:145px'>Никнейм</th>
					<th>Выдача</th>
					<th>Причина отклонения заявки</th>
				</tr>";
		for($i = 0; $i < $rows; ++$i) {
			$row = mysqli_fetch_row($result);
			echo "<tr>";
			for($j = 0; $j < 5; ++$j)
				echo nl2br("<td>$row[$j]</td>");
			echo "</tr>";
			}
		}
	} else {
		echo "<table class='table_dark2'>
					<tr>
						<th style='display:block; text-align:center'>Ошибка</th>
					</tr>
					</table>";
	}


	echo "</table>";
	// очищаем результат
	//mysqli_free_result($result);
	$query = "SELECT COUNT(*) as count FROM itogobmen";
	$result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));
	$res = mysqli_fetch_assoc($result);
	$count = $res['count'];
	$pagesCount = ceil($count / $notesOnPage);
	if($page > $pagesCount) {
		echo "<table class='table_dark'><tr><td></td><td colspan='2'>Таблица итогов обмена баллов на призы обновляется или такой страницы не существует</td></tr>";
		echo "</table>";
	} else {
	if($page != 1) {
		$pervpage = '<a href= ../points/results.php?page=1><<</a>';
		$perv1page = '<a href= ./results.php?page='.($page - 1).'>Назад</a>';
	}
	else {
		$pervpage = '<a href= ./points/results.php?page=1 class="disabled"><<</a>';
		$perv1page = '<a href= ./results.php?page= class="disabled" '.($page - 1).'>Назад</a>';
	}
	if($page != $pagesCount) {
		$nextpage1 = '<a href= ./results.php?page='.($page + 1).'>Далее</a>';
		$nextpage = '<a href= ./results.php?page='.$pagesCount.'>>></a>';
	}
	else {
		$nextpage1 = '<a href= ./results.php?page= class="disabled" '.($page + 1).'>Далее</a>';
		$nextpage = '<a href= ./results.php?page= class="disabled" '.$pagesCount.'>>></a>';
	}
	if($page - 3 > 0)
		$page3left = '<li><a href= ./results.php?page='.($page - 3).'>'.($page - 3).'</a></li>';
	if($page - 2 > 0)
		$page2left = '<li><a href= ./results.php?page='.($page - 2).'>'.($page - 2).'</a></li>';
	if($page - 1 > 0)
		$page1left = '<li><a href= ./results.php?page='.($page - 1).'>'.($page - 1).'</a></li>';
	if($page + 3 <= $pagesCount)
		$page3right = '<li><a href= ./results.php?page='.($page + 3).'>'.($page + 3).'</a></li>';
	if($page + 2 <= $pagesCount)
		$page2right = '<li><a href= ./results.php?page='.($page + 2).'>'.($page + 2).'</a></li>';
	if($page + 1 <= $pagesCount)
		$page1right = '<li><a href= ./results.php?page='.($page + 1).'>'.($page + 1).'</a></li>';
	echo "<ul class='pagination'>
			<li>$pervpage</li>
			<li>$perv1page</li>".$page3left.$page2left.$page1left.
		"<li><b>$page</b></li>".$page1right.$page2right.$page3right.
		"<li>$nextpage1</li>
			<li>$nextpage</li>
		</ul>";
}}
else {
	require_once 'script/connect.php';
	mysqli_query($link, "SET NAMES 'utf8'");
	if(isset($_GET['page'])) {
		$page = $_GET['page'];
	}
	else {
		$page = 1;
	}
	$notesOnPage = 50;
	$from = ($page - 1) * $notesOnPage;
	$sql = "SELECT * FROM itogobmen WHERE nickname='%s' ORDER BY dates DESC LIMIT %s,%s";
	$query = sprintf($sql, mysqli_real_escape_string($link, $search), mysqli_real_escape_string($link, $from), mysqli_real_escape_string($link, $notesOnPage));
	$result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));
	if($result) {
		$rows = mysqli_num_rows($result);
		if($rows > 0) {
			echo "<table class='table_dark2'><tr>
					<th>id</th>
					<th style='width:140px'>Дата и время заявки</th>
					<th style='width:145px'>Никнейм</th>
					<th>Выдача</th>
					<th>Причина отклонения заявки</th>
				</tr>";
			for($i = 0; $i < $rows; ++$i) {
				$row = mysqli_fetch_row($result);
				echo "<tr>";
				for($j = 0; $j < 5; ++$j)
					echo nl2br("<td>$row[$j]</td>");
				echo "</tr>";

			}
			echo "</table>";
		}
		else {
			echo "<table class='table_dark2'>
					<tr>
						<td style='display:block; text-align:center'>Такого никнейма нет в таблице</td>
					</tr>
					</table>";
		}

	}
}
?>
