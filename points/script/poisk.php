<?php
$search = mb_strimwidth($_GET['search'], 0, 21);
$search = htmlspecialchars($search);
if($search == false) {
	require_once 'script/connect.php';
	$id2 = 2;
	$sql = "SELECT * FROM formobmen WHERE id=%d";
	$query = sprintf($sql, mysqli_real_escape_string($link, $id2));
	$result = mysqli_query($link, $query) or die('Error: '.mysqli_error($link));
	$row = mysqli_fetch_row($result);
	$dates = $row [1];
	$result->free();
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
	$from = ($page - 1) * $notesOnPage;
	$id = 0;
	if($from >= 0) {
		$sql = "SELECT * FROM tablballs WHERE id > %d ORDER BY nickname LIMIT %s,%s";
		$query = sprintf($sql, mysqli_real_escape_string($link, $id), mysqli_real_escape_string($link, $from), mysqli_real_escape_string($link, $notesOnPage));
		$result = mysqli_query($link, $query) or die(' Ошибка poisk.php(37): '.mysqli_error($link));
		if($result) {
			$rows = mysqli_num_rows($result);// количество полученных строк
			if($rows > 0) {
				echo "<table class='table_dark'>
				<tr>
					<th colspan='2' class='heding'><span style='float:left'>Общая таблица баллов</span><span style='float:right'>Обновлена $dates</span></th>
				</tr>
				<tr>
					<th>Никнейм</th>
					<th>Баллы</th>
				</tr>";
				for($i = 0; $i < $rows; ++$i) {
					$row = mysqli_fetch_row($result);
					echo "<tr>";
					for($j = 1; $j < 3; ++$j)
						if($row[2] != "") { // если balls пусто то не выводим
							echo "<td>$row[$j]</td>";
						}
					echo "</tr>";
				}
				echo "</table>";
			}
			else {
				$logresult = 'there are no rows in the table';
				echo "<table class='table_dark'>
					<tr>
						<th class='heding' style='text-align:center'>Ошибка поиска</th>
					</tr>
					<tr>
						<td style='padding:15px 7px; font-size:14px'><b>Ничего не найдено</b></td>
					</tr>
					</table>";
			}
		}
	}
	else {
		$logresult = 'Ошибка условия poisk.php(35)'.$from.' >=0';
		echo "<table class='table_dark'>
					<tr>
						<th class='heding' style='text-align:center'>Ошибка поиска</th>
					</tr>
					<tr>
						<td style='padding:15px 7px'><b>Неизвестная ошибка</b></td>
					</tr>
					</table>";
	}

	$query = "SELECT COUNT(*) as count FROM tablballs";
	$result = mysqli_query($link, $query) or die(' Ошибка poisk.php(67): '.mysqli_error($link));
	$res = mysqli_fetch_assoc($result);
	$count = $res['count'];
	$pagesCount = ceil($count / $notesOnPage);
	if($page > $pagesCount) {
		//пусто
	}
	else {
		if($page != 1) {
			$pervpage = '<a href= ./index?page=1><<</a>';
			$perv1page = '<a href= ./index?page='.($page - 1).'>Назад</a>';
		}
		else {
			$pervpage = '<a href= ./index?page=1 class="disabled"><<</a>';
			$perv1page = '<a href= ./index?page= class="disabled" '.($page - 1).'>Назад</a>';
		}
		if($page != $pagesCount) {
			$nextpage1 = '<a href= ./index?page='.($page + 1).'>Далее</a>';
			$nextpage = '<a href= ./index?page='.$pagesCount.'>>></a>';
		}
		else {
			$nextpage1 = '<a href= ./index?page= class="disabled" '.($page + 1).'>Далее</a>';
			$nextpage = '<a href= ./index?page= class="disabled" '.$pagesCount.'>>></a>';
		}
		if($page - 3 > 0)
			$page3left = '<li><a href= ./index?page='.($page - 3).'>'.($page - 3).'</a></li>';
		if($page - 2 > 0)
			$page2left = '<li><a href= ./index?page='.($page - 2).'>'.($page - 2).'</a></li>';
		if($page - 1 > 0)
			$page1left = '<li><a href= ./index?page='.($page - 1).'>'.($page - 1).'</a></li>';
		if($page + 3 <= $pagesCount)
			$page3right = '<li><a href= ./index?page='.($page + 3).'>'.($page + 3).'</a></li>';
		if($page + 2 <= $pagesCount)
			$page2right = '<li><a href= ./index?page='.($page + 2).'>'.($page + 2).'</a></li>';
		if($page + 1 <= $pagesCount)
			$page1right = '<li><a href= ./index?page='.($page + 1).'>'.($page + 1).'</a></li>';
		echo "<div class='ul-pagination'><ul class='pagination'>
			<li>$pervpage</li>
			<li>$perv1page</li>".$page3left.$page2left.$page1left."<li><b class='currentpage'>$page</b></li>".$page1right.$page2right.$page3right."<li>$nextpage1</li>
			<li>$nextpage</li>
		</ul></div>";
	}
}
else {
	$search = trim($search);
	$logsearch = $search;
	$ip_search = $_SERVER['REMOTE_ADDR'];
	require_once 'script/connect.php';
	mysqli_query($link, "SET NAMES 'utf8'");
	$sql = "SELECT * FROM tablballs WHERE nickname='%s' ORDER BY nickname";
	$query = sprintf($sql, mysqli_real_escape_string($link, $search));
	$result = mysqli_query($link, $query) or die(' Ошибка poisk.php(124): '.mysqli_error($link));
	if($result) {
		$rows = mysqli_num_rows($result);
		$row = mysqli_fetch_row($result);
		if($row[2] != "") {
			if($rows > 0) {
				$logresult = 'true';
				echo "<table class='table_dark'><tr>
					<tr>
					<th colspan='2' class='heding'>&nbsp;</th></tr>
					<th>Никнейм</th>
					<th>Баллы</th>
				</tr>";
				for($i = 0; $i < $rows; ++$i) {
					echo "<tr>";
					for($j = 1; $j < 3; ++$j)
						echo nl2br("<td>$row[$j]</td>");
					echo "</tr>";
					echo "<th colspan='2'>История обмена баллов</th>";
					echo "<tr>";
					for($j = 3; $j < 4; ++$j)
						echo nl2br("<td colspan='2' style='text-align:left'>$row[$j]</td>");
					echo "</tr>";
					echo "</table>";
				}
			}
			else {
				$logresult = 'false';
				echo "<table class='table_dark'>
					<tr>
						<th class='heding' style='text-align:center'>Ошибка поиска</th>
					</tr>
					<tr>
						<td style='padding:15px 7px'><b>Такого никнейма нет в таблице</b></td>
					</tr>
					</table>";
			}
		}
		else {
			$logresult = 'false';
			echo "<table class='table_dark'>
					<tr>
						<th class='heding' style='text-align:center'>Ошибка поиска</th>
					</tr>
					<tr>
						<td style='padding:15px 7px'><b>Такого никнейма нет в таблице</b></td>
					</tr>
					</table>";
		}
	}
}
$table = 'points';
require_once 'logsearch.php';
?>