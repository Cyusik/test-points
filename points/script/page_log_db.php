<?php
$pagelog = "SELECT COUNT(*) as count FROM $sqltabledb $sqlarr";
$respage = mysqli_query($link, $pagelog) or die ('Error '.mysqli_error($link));
$respage = mysqli_fetch_assoc($respage);
//print_r($sqlarr);
$count = $respage['count'];
$pagesCount = ceil($count / $notesOnPage);
if($page > $pagesCount) {
	//ничего не найдено
} else {
	$pagearr = implode("&", $pagearr);
	$pagearr = str_replace(" ", "+", $pagearr);
	//echo '<pre>';
	//print_r($pagearr);
	//echo '</pre>';
	if($page != 1) {
		$pervpage = '<a href= ./log_db.php?'.$pagearr.'&page=1><<</a>';
		$perv1page = '<a href= ./log_db.php?'.$pagearr.'&page='.($page - 1).'>Назад</a>';
	}
	else {
		$pervpage = '<a href= ./log_db.php?'.$pagearr.'&page=1 class="disabled"><<</a>';
		$perv1page = '<a href= ./log_db.php?'.$pagearr.'&page= class="disabled" '.($page - 1).'>Назад</a>';
	}
	if($page != $pagesCount) {
		$nextpage1 = '<a href= ./log_db.php?'.$pagearr.'&page='.($page + 1).'>Далее</a>';
		$nextpage = '<a href= ./log_db.php?'.$pagearr.'&page='.$pagesCount.'>>></a>';
	}
	else {
		$nextpage1 = '<a href= ./log_db.php?'.$pagearr.'&page= class="disabled" '.($page + 1).'>Далее</a>';
		$nextpage = '<a href= ./log_db.php?'.$pagearr.'&page= class="disabled" '.$pagesCount.'>>></a>';
	}
	if($page - 3 > 0)
		$page3left = '<li><a href= ./log_db.php?'.$pagearr.'&page='.($page - 3).'>'.($page - 3).'</a></li>';
	if($page - 2 > 0)
		$page2left = '<li><a href= ./log_db.php?'.$pagearr.'&page='.($page - 2).'>'.($page - 2).'</a></li>';
	if($page - 1 > 0)
		$page1left = '<li><a href= ./log_db.php?'.$pagearr.'&page='.($page - 1).'>'.($page - 1).'</a></li>';
	if($page + 3 <= $pagesCount)
		$page3right = '<li><a href= ./log_db.php?'.$pagearr.'&page='.($page + 3).'>'.($page + 3).'</a></li>';
	if($page + 2 <= $pagesCount)
		$page2right = '<li><a href= ./log_db.php?'.$pagearr.'&page='.($page + 2).'>'.($page + 2).'</a></li>';
	if($page + 1 <= $pagesCount)
		$page1right = '<li><a href= ./log_db.php?'.$pagearr.'&page='.($page + 1).'>'.($page + 1).'</a></li>';
	echo "<div class='ul-pagination'><ul class='pagination'>
			<li>$pervpage</li>
			<li>$perv1page</li>".$page3left.$page2left.$page1left."<li><b class='currentpage'>$page</b></li>".$page1right.$page2right.$page3right."<li>$nextpage1</li>
			<li>$nextpage</li>
		</ul></div>";
}
?>