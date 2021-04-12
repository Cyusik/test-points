<?php
$ignore_check = "SELECT nickname, exclude FROM tablballs WHERE exclude = '1'";
$result_chesk = mysqli_query($link, $ignore_check) or die ('Error: '.mysqli_error($link));
$counts_ig = mysqli_num_rows($result_chesk);
if ($counts_ig > 0) {
	$list = array();
	for($q = 0; $q < $counts_ig; ++$q) {
		$list_ignor = mysqli_fetch_row($result_chesk);
		$list[] = $list_ignor[0];
	}
	echo '<div class="input">Начисляется всем, кроме: '.implode(" | ", $list).'</div><br>';
} else {
	echo '<div class="input">Начисляется всем игрокам</div><br>';
}
?>