<?php
if($_GET['action'] == 'control_user.php') {
	include_once '../script/connect.php';
	$check_user = "SELECT id,name_user,login_user,role FROM users";
	$res_us_ch = mysqli_query($link, $check_user) or die('Error: '.mysqli_error($link));
	if($res_us_ch) {
		$ln = mysqli_num_rows($res_us_ch);
		echo "<table class='table_history'><tr>
				<th>№</th>
				<th>Имя юзера</th>
				<th>Логин юзера</th>
				<th>Роль</th></tr>";
		for($i = 0; $i < $ln; ++$i) {
			$st = mysqli_fetch_row($res_us_ch);
			echo "<tr>";
			for($h = 0; $h < count($st); ++$h) {
				echo "<td>$st[$h]</td>";
			}
			echo "</tr>";
		}
		echo "</table><div class='ul-pagination'><ul class='pagination'></ul></div><br>";
	}
	//$link->close();
}
?>