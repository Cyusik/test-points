<?php
if($_GET['action'] == 'ex_im_exch.php') {
	$swap_stat = "SELECT * FROM formobmen WHERE `id` = '1'";
	$result_stat = mysqli_query($link, $swap_stat) or die('Error :'.mysqli_error($link));
	if($result_stat) {
		$row = mysqli_fetch_assoc($result_stat);
		if($row['open'] == 1) {
			echo "<b style='color:red; margin-left:10px'>Опрос открыт</b><br>";
		} elseif($row['open'] == 2) {
			echo "<b style='color:red; margin-left:200px;'>Опрос закрыт</b><br>";
		}
		$result_stat->free();
	}
}
?>
