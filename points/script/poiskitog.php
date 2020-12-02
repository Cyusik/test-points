<?php
$search = mb_strimwidth($_GET['search'], 0, 21);
$fw = fopen('logfiles/search_log.log', "a+");
date_default_timezone_set('Europe/Moscow');
$date = date('Y-m-d h:i:s');
$newdate = date('Y-m-d h:i:s A', strtotime($date));
if($search == false) {
	require_once 'script/connect.php';
	mysqli_query($link, "SET NAMES 'utf8'");
	if(isset($_GET['page'])) {
		$page = intval($_GET['page']);
		$page = abs($page);
		if($page == 0) {
			$page = intval(1);
		}
	}
	else {
		$page = intval(1);
	}
	$notesOnPage = 50;
	$id = 0;
	$from = ($page - 1) * $notesOnPage;
	if($from >= 0) {
		$sql = "SELECT * FROM itogobmen WHERE id > %d ORDER BY dates DESC LIMIT %s,%s";
		$query = sprintf($sql, mysqli_real_escape_string($link, $id), mysqli_real_escape_string($link, $from), mysqli_real_escape_string($link, $notesOnPage));
		$result = mysqli_query($link, $query) or die(fwrite($fw, $newdate.' Ошибка poiskitog.php(24): '.mysqli_error($link)."\n"));
		if($result) {
			$rows = mysqli_num_rows($result);// количество полученных строк
			echo "<table id='range1' class='table_dark'>
					<tr>
						<th colspan='4' class='heding'>Итоги обмена баллов на призы</th>
					</tr>
					<tr>
					<th style='width:135px'>Дата выдачи приза</th>
					<th style='width:140px'>Никнейм</th>
					<th>Выдача</th>
					<th>Причина отклонения заявки</th>
				</tr>";
			for($i = 0; $i < $rows; ++$i) {
				$row = mysqli_fetch_row($result);
				echo "<tr>";
				for($j = 1; $j < 5; ++$j)
					echo nl2br("<td>$row[$j]</td>");
				echo "</tr>";
			}
		}
	}
	else {
		fwrite($fw, $newdate." Ошибка условия poiskitog.php(21) ".$from.' >=0'."\n");
		echo "<table class='table_dark'>
					<tr>
						<th class='heding' style='text-align:center'>Ошибка поиска</th>
					</tr>
					<tr>
						<td style='padding:15px 7px; font-size:14px'><b>Неизвестная ошибка</b></td>
					</tr>
					</table>";
	}
	echo "</table>";
	$query = "SELECT COUNT(*) as count FROM itogobmen";
	$result = mysqli_query($link, $query) or die(fwrite($fw, $newdate.' Ошибка poiskitog.php(52): '.mysqli_error($link)."\n"));
	$res = mysqli_fetch_assoc($result);
	$count = $res['count'];
	$pagesCount = ceil($count / $notesOnPage);
	if($page > $pagesCount) {
		echo "<table class='table_dark'><tr><td colspan='2' style='padding:15px 7px'><b>Таблица с итогами обновляется или такой страницы не существует</b></td></tr></table>";
	}
	else {
		if($page != 1) {
			$pervpage = '<a href= ../points/results?page=1><<</a>';
			$perv1page = '<a href= ./results?page='.($page - 1).'>Назад</a>';
		}
		else {
			$pervpage = '<a href= ./points/results?page=1 class="disabled"><<</a>';
			$perv1page = '<a href= ./results?page= class="disabled" '.($page - 1).'>Назад</a>';
		}
		if($page != $pagesCount) {
			$nextpage1 = '<a href= ./results?page='.($page + 1).'>Далее</a>';
			$nextpage = '<a href= ./results?page='.$pagesCount.'>>></a>';
		}
		else {
			$nextpage1 = '<a href= ./results?page= class="disabled" '.($page + 1).'>Далее</a>';
			$nextpage = '<a href= ./results?page= class="disabled" '.$pagesCount.'>>></a>';
		}
		if($page - 3 > 0)
			$page3left = '<li><a href= ./results?page='.($page - 3).'>'.($page - 3).'</a></li>';
		if($page - 2 > 0)
			$page2left = '<li><a href= ./results?page='.($page - 2).'>'.($page - 2).'</a></li>';
		if($page - 1 > 0)
			$page1left = '<li><a href= ./results?page='.($page - 1).'>'.($page - 1).'</a></li>';
		if($page + 3 <= $pagesCount)
			$page3right = '<li><a href= ./results?page='.($page + 3).'>'.($page + 3).'</a></li>';
		if($page + 2 <= $pagesCount)
			$page2right = '<li><a href= ./results?page='.($page + 2).'>'.($page + 2).'</a></li>';
		if($page + 1 <= $pagesCount)
			$page1right = '<li><a href= ./results?page='.($page + 1).'>'.($page + 1).'</a></li>';
		echo "<div class='ul-pagination'><ul class='pagination'>
			<li>$pervpage</li>
			<li>$perv1page</li>".$page3left.$page2left.$page1left."<li><b class='currentpage'>$page</b></li>".$page1right.$page2right.$page3right."<li>$nextpage1</li>
			<li>$nextpage</li>
		</ul></div>";
	}
}
else {
	$search = trim($search);
	fwrite($fw, $newdate.' Запрос поиск итогов: '.$search."\n");
	require_once 'script/connect.php';
	mysqli_query($link, "SET NAMES 'utf8'");
	if(isset($_GET['page'])) {
		$page = intval($_GET['page']);
		$page = abs($page);
		if($page == 0) {
			$page = intval(1);
		}
	}
	else {
		$page = intval(1);
	}
	$notesOnPage = 50;
	$id = 0;
	$from = ($page - 1) * $notesOnPage;
	if($from >= 0) {
		$sql = "SELECT * FROM itogobmen WHERE nickname='%s' ORDER BY dates DESC LIMIT %s,%s";
		$query = sprintf($sql, mysqli_real_escape_string($link, $search), mysqli_real_escape_string($link, $from), mysqli_real_escape_string($link, $notesOnPage));
		$result = mysqli_query($link, $query) or die(fwrite($fw, $newdate.' Ошибка poiskitog.php(111): '.mysqli_error($link)."\n"));
		if($result) {
			$rows = mysqli_num_rows($result);
			if($rows > 0) {
				fwrite($fw, $newdate.' Запрос: '.'true'."\n");
				echo "<table class='table_dark'>
					<tr>
						<th colspan='4' class='heding'>Итоги обмена баллов на призы игрока $search</th>
					</tr>
					<tr>
					<th style='width:135px'>Дата выдачи приза</th>
					<th style='width:140px'>Никнейм</th>
					<th>Выдача</th>
					<th>Причина отклонения заявки</th>
				</tr>";
				for($i = 0; $i < $rows; ++$i) {
					$row = mysqli_fetch_row($result);
					echo "<tr>";
					for($j = 1; $j < 5; ++$j)
						echo nl2br("<td>$row[$j]</td>");
					echo "</tr>";
				}
				echo "</table>";
			}
			else {
				fwrite($fw, $newdate.' Запрос: '.'false'."\n");
				echo "<table class='table_dark'>
					<tr>
						<th class='heding' style='text-align:center'>Ошибка поиска</th>
					</tr>
					<tr>
						<td style='padding:15px 7px; font-size:14px'><b>Такого никнейма нет в таблице</b></td>
					</tr>
					</table>";
			}
		}
	}
	else {
		fwrite($fw, $newdate." Ошибка условия poiskitog.php(163) ".$from.' >=0'."\n");
		echo "<table class='table_dark'>
					<tr>
						<th class='heding' style='text-align:center'>Ошибка поиска</th>
					</tr>
					<tr>
						<td style='padding:15px 7px; font-size:14px'><b>Неизвестная ошибка</b></td>
					</tr>
					</table>";
	}
	$query = "SELECT COUNT(*) as count FROM itogobmen WHERE nickname='$search'";
	$result = mysqli_query($link, $query) or die(fwrite($fw, $newdate.' Ошибка poiskitog.php(174): '.mysqli_error($link)."\n"));
	$res = mysqli_fetch_assoc($result);
	$count = $res['count'];
	$pagesCount = ceil($count / $notesOnPage);
	if($page > $pagesCount) {
		echo "<table class='table_dark'><tr><td colspan='2' style='padding:15px 7px'><b>Таблица с итогами обновляется или такой страницы не существует</b></td></tr></table>";
	}
	else {
		if($page != 1) {
			$pervpage = '<a href= ../points/results?search='.$search.'&page=1><<</a>';
			$perv1page = '<a href= ./results?search='.$search.'&page='.($page - 1).'>Назад</a>';
		}
		else {
			$pervpage = '<a href= ./points/results?search='.$search.'&page=1 class="disabled"><<</a>';
			$perv1page = '<a href= ./results?search='.$search.'&page= class="disabled" '.($page - 1).'>Назад</a>';
		}
		if($page != $pagesCount) {
			$nextpage1 = '<a href= ./results?search='.$search.'&page='.($page + 1).'>Далее</a>';
			$nextpage = '<a href= ./results?search='.$search.'&page='.$pagesCount.'>>></a>';
		}
		else {
			$nextpage1 = '<a href= ./results?search='.$search.'&page= class="disabled" '.($page + 1).'>Далее</a>';
			$nextpage = '<a href= ./results?search='.$search.'&page= class="disabled" '.$pagesCount.'>>></a>';
		}
		if($page - 3 > 0)
			$page3left = '<li><a href= ./results?search='.$search.'&page='.($page - 3).'>'.($page - 3).'</a></li>';
		if($page - 2 > 0)
			$page2left = '<li><a href= ./results?search='.$search.'&page='.($page - 2).'>'.($page - 2).'</a></li>';
		if($page - 1 > 0)
			$page1left = '<li><a href= ./results?search='.$search.'&page='.($page - 1).'>'.($page - 1).'</a></li>';
		if($page + 3 <= $pagesCount)
			$page3right = '<li><a href= ./results?search='.$search.'&page='.($page + 3).'>'.($page + 3).'</a></li>';
		if($page + 2 <= $pagesCount)
			$page2right = '<li><a href= ./results?search='.$search.'&page='.($page + 2).'>'.($page + 2).'</a></li>';
		if($page + 1 <= $pagesCount)
			$page1right = '<li><a href= ./results?search='.$search.'&page='.($page + 1).'>'.($page + 1).'</a></li>';
		echo "<div class='ul-pagination'><ul class='pagination'>
			<li>$pervpage</li>
			<li>$perv1page</li>".$page3left.$page2left.$page1left."<li><b class='currentpage'>$page</b></li>".$page1right.$page2right.$page3right."<li>$nextpage1</li>
			<li>$nextpage</li>
		</ul></div>";
	}
}
fclose($fw);
?>
