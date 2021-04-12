<?php
$search = mb_strimwidth($_GET['search'], 0, 21);
$search = mysqli_real_escape_string($link, $search);
$search = htmlspecialchars($search);
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
		$result = mysqli_query($link, $query) or die(' Ошибка poiskitog.php(24): '.mysqli_error($link));
		if($result) {
			$rows = mysqli_num_rows($result);// количество полученных строк
			if($rows > 0) {
			echo "<table id='range1' class='table_dark'>
					<tr>
						<th colspan='4' class='heding'>История выдачи призов</th>
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
				echo "<td>$row[1]</td>
					  <td style='padding:0'><a class='results' href='/points/index?search=$row[2]'>$row[2]</a></td>
					  <td>$row[3]</td>
					  <td>$row[4]</td>";
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
		$logresult = 'Ошибка условия poiskitog.php(21)'.$from.' >=0';
		echo "<table class='table_dark'>
					<tr>
						<th class='heding' style='text-align:center'>Ошибка поиска</th>
					</tr>
					<tr>
						<td style='padding:15px 7px; font-size:14px'><b>Неизвестная ошибка</b></td>
					</tr>
					</table>";
	}
	$query = "SELECT COUNT(*) as count FROM itogobmen";
	$result = mysqli_query($link, $query) or die(' Ошибка poiskitog.php(52): '.mysqli_error($link));
	$res = mysqli_fetch_assoc($result);
	$count = $res['count'];
	$pagesCount = ceil($count / $notesOnPage);
	if($page > $pagesCount) {
		echo "<table class='table_dark'><tr><td colspan='2' style='padding:15px 7px'><b>Таблица с историей выдачи обновляется или такой страницы не существует</b></td></tr></table>";
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
	$logsearch = $search;
	$ip_search = $_SERVER['REMOTE_ADDR'];
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
		$result = mysqli_query($link, $query) or die(' Ошибка poiskitog.php(111): '.mysqli_error($link));
		if($result) {
			$rows = mysqli_num_rows($result);
			if($rows > 0) {
				$logresult = 'true';
				echo "<table class='table_dark'>
					<tr>
						<th colspan='4' class='heding'>История выдачи призов игрока $search</th>
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
					echo "<td>$row[1]</td>
					  <td style=padding:0;'><a class='results' href='/points/index?search=$row[2]'>$row[2]</a></td>
					  <td>$row[3]</td>
					  <td>$row[4]</td>";
					echo "</tr>";
				}
				echo "</table>";
			}
			else {
				$logresult = 'false';
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
		$logresult = 'Ошибка условия poiskitog.php(163)'.$from.' >=0';
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
	$result = mysqli_query($link, $query) or die(' Ошибка poiskitog.php(174): '.mysqli_error($link));
	$res = mysqli_fetch_assoc($result);
	$count = $res['count'];
	$pagesCount = ceil($count / $notesOnPage);
	if($page > $pagesCount) {
		//ничего не найдено
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
$table = 'results';
require_once 'logsearch.php';
?>
