<?php
$addLine_page = "SELECT COUNT(*) as count FROM $tableBD $wereDB";
$result_line_page = mysqli_query($link, $addLine_page) or die ('Error '.mysqli_error($link));
$result_line_page = mysqli_fetch_assoc($result_line_page);
$count = $result_line_page['count'];
$pagesCount = ceil($count / $notesOnPage);
$link->close();
if($page > $pagesCount) {
	//ничего не найдено
} else {
	if($page != 1) {
		$pervpage = '<a href= ./description.php?'.$line_page.'&page=1><i class="fa fa-angle-double-left"></i></a>';
		$perv1page = '<a href= ./description.php?'.$line_page.'&page='.($page - 1).'><i class="fa fa-angle-left"></i></a>';
	}
	else {
		$pervpage = '<a href= ./description.php?'.$line_page.'&page=1 class="disabled"><i class="fa fa-angle-double-left"></i></a>';
		$perv1page = '<a href= ./description.php?'.$line_page.'&page= class="disabled" '.($page - 1).'><i class="fa fa-angle-left"></i></a>';
	}
	if($page != $pagesCount) {
		$nextpage1 = '<a href= ./description.php?'.$line_page.'&page='.($page + 1).'><i class="fa fa-angle-right"></i></a>';
		$nextpage = '<a href= ./description.php?'.$line_page.'&page='.$pagesCount.'><i class="fa fa-angle-double-right"></i></i></a>';
	}
	else {
		$nextpage1 = '<a href= ./description.php?'.$line_page.'&page= class="disabled" '.($page + 1).'><i class="fa fa-angle-right"></i></a>';
		$nextpage = '<a href= ./description.php?'.$line_page.'&page= class="disabled" '.$pagesCount.'><i class="fa fa-angle-double-right"></i></a>';
	}
	if($page - 3 > 0)
		$page3left = '<li><a href= ./description.php?'.$line_page.'&page='.($page - 3).'>'.($page - 3).'</a></li>';
	if($page - 2 > 0)
		$page2left = '<li><a href= ./description.php?'.$line_page.'&page='.($page - 2).'>'.($page - 2).'</a></li>';
	if($page - 1 > 0)
		$page1left = '<li><a href= ./description.php?'.$line_page.'&page='.($page - 1).'>'.($page - 1).'</a></li>';
	if($page + 3 <= $pagesCount)
		$page3right = '<li><a href= ./description.php?'.$line_page.'&page='.($page + 3).'>'.($page + 3).'</a></li>';
	if($page + 2 <= $pagesCount)
		$page2right = '<li><a href= ./description.php?'.$line_page.'&page='.($page + 2).'>'.($page + 2).'</a></li>';
	if($page + 1 <= $pagesCount)
		$page1right = '<li><a href= ./description.php?'.$line_page.'&page='.($page + 1).'>'.($page + 1).'</a></li>';
	echo "<div class='ul-pagination'><ul class='pagination'>
			<li>$pervpage</li>
			<li>$perv1page</li>".$page3left.$page2left.$page1left."<li><b class='currentpage'>$page</b></li>".$page1right.$page2right.$page3right."<li>$nextpage1</li>
			<li>$nextpage</li>
		</ul></div>";
}
?>