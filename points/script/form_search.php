<?php
if (isset($_POST['search'])) {
	include_once 'connect.php';
	$search = trim(strip_tags(stripcslashes(htmlspecialchars($_POST['search']))));
	$mb_str_len = mb_strlen($search, 'utf-8');
	if($mb_str_len < 3) {
		echo "Мин 3 символа";
	}
	else {
		$sql = "SELECT * FROM tablballs WHERE nickname='%s'";
		$query = sprintf($sql, mysqli_real_escape_string($link, $search));
		$result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));
		if($result) {
			$rows = mysqli_num_rows($result);
			if($rows > 0) {
				for($i = 0; $i < $rows; ++$i) {
					$row = mysqli_fetch_row($result);
					echo $row[2];
				}
			}
			else {
				echo "Никнейм не найден";
			}
		}
		else {
			echo "Data Not found";
		}
	} $link->close();
}
?>
