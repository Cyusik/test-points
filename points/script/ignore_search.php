<?php
if(isset($_POST['search'])) {
	include_once '../script/connect.php';
	$ig_srh = trim(htmlspecialchars(mysqli_real_escape_string($link, $_POST['search'])));
	$mb_str_len = mb_strlen($ig_srh, 'utf-8');
	if($mb_str_len < 3) {
		echo "Минимум 3 символа";
		$link->close();
		exit();
	} else {
		$ig_sql = "SELECT nickname, exclude FROM tablballs WHERE nickname ='%s'";
		$query = sprintf($ig_sql, mysqli_real_escape_string($link, $ig_srh));
		$res_ig = mysqli_query($link, $query) or die('Error :'.mysqli_error($link));
		if($res_ig) {
			$rows = mysqli_num_rows($res_ig);
			if($rows > 0) {
				for($i = 0; $i < $rows; ++$i) {
					$row = mysqli_fetch_row($res_ig);
					echo $row[1];
				}
			} else {
				echo "Никнейм не найден";
			}
		}
	}
	$res_ig->free();
	$link->close();
}
?>