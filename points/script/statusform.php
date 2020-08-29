<?php
include_once '../script/connect.php';
$query = "SELECT * FROM formobmen WHERE `open`";
$result = mysqli_query($link, $query);
while ($row = $result->fetch_assoc())
{
	$open = $row['open'];
	if( $open == '1')
	{
		echo "<b style='color:red'>Опрос открыт</b><br>";
		$link->close();
	} else if ($open == '2') {
		echo "<b style='color:red; margin-left:130px;'>Опрос закрыт</b><br>";
		//$link->close();
	}
}$result->free();
?>
