<?php
if(isset($_POST['truncate1'])){
	include_once '../script/connect.php';
	$query = "TRUNCATE TABLE itogobmen";
	$result = mysqli_query($link, $query);
	echo "<b style='color:red'>Таблица очищена, проверь</b><br />";
	mysqli_close($link);
}
else {
	echo "Не очищена";
}
?>
