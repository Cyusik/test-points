<?php
if(isset($_POST['truncate'])){
	include_once '../script/connect.php';
	$query = "TRUNCATE TABLE tablballs";
	$result = mysqli_query($link, $query);
	echo "<b style='color:red'>Таблица очищена, проверь</b><br />";
	mysqli_close($link);
}
else {
	echo "Не очищена";
}

?>
