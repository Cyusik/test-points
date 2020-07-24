<?php
if(isset($_POST['truncate2'])){
	include_once '../script/connect.php';
	$query = "TRUNCATE TABLE zapisform";
	$result = mysqli_query($link, $query);
	echo "<br><b style='color:red'>Таблица очищена, проверь</b><br>";
	mysqli_close($link);
}
else {
	echo "<br>";
}

?>

