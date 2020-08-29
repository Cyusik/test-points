<?php
header("Content-type: text/html; Charset=utf-8");

//function print_arr($arr){
//	echo "<pre>" . print_r($arr, true) . "</pre>";
//}
if(isset($_POST['podarok'])){
	echo "<pre>";
	print_r($_POST);
	//$data = array();
	foreach($_POST['podarok'] as $item){
		$item = explode('|', $item);
		$data[$item[0]] = $item[1];
	}
	$priz5 = implode("\r",$data);
	//echo $priz5;
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<title>TEST</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<form method="post" id="forms">
	Значение 1 <br>
	<input type="text" id="numone">
	<br>Значение 2<br>
	<input type="text" id="numtwo">
	<br><br>
	<input type="submit" id="button">
	<br><br>
	<div>
		<span id="itog"></span>
	</div>
</form>
<script type="text/javascript">
	$(document).ready(function() {
		$('#forms').submit(function(event) {
			event.preventDefault();
			var numone = document.getElementById('numone').value;
			var numtwo = document.getElementById('numtwo').value;
			var a = parseInt(numone);
			var b = parseInt(numtwo);
			if (isNaN(a)) {
				$('#itog').html('значение 1 не число');
			} else if (a<b) {
				$('#itog').html('итог: ' + numone + ' < ' + numtwo);
			} else {
				$('#itog').html('другое');
			}
		});
	});
</script>




<br><br><br><br>
<form method="post">
	<select name="podarok[]">
		<option value="0">Содержимое 0</option>
		<option value="1">Содержимое 1</option>
		<option value="3">Содержимое 2</option>
		<option value="4">Содержимое 3</option>
		<option value="5">Содержимое 4</option>
		<option value="6">Содержимое 5</option>
		<option value="7">Содержимое 6</option>
	</select>
	<select name="podarok[]">
		<option value="0">Содержимое 0</option>
		<option value="1">Содержимое 1</option>
		<option value="3">Содержимое 2</option>
		<option value="4">Содержимое 3</option>
		<option value="5">Содержимое 4</option>
		<option value="6">Содержимое 5</option>
		<option value="7">Содержимое 6</option>
	</select>
	<button type="submit" id="send">Send</button>
</form>

<script src="http://code.jquery.com/jquery.min.js"></script>
<script>
	$(function(){
		$('#send').on('click', function(){
			$("select[name='podarok[]'] > option").each(function(){
				var content = $(this).text();
					//val = $(this).val();
				$(this).val(content);
				//alert(ends);
			});
		});
	});
</script>


<?php
/*if (isset($_POST['arrForm'])) {
	$arrTemplate = array("Строка_1", "Строка_2", "Строка_3", "Строка_4", "Строка_5");

	foreach($_POST['arrForm'] as $k=>$m) {
		if (!empty($m)) {
			$arrForm[$k] = $m;
		}
	}
	$arr_result = array_intersect($arrTemplate, $arrForm);// делаем схождение массивов
	$arr_result = implode(", ", $arr_result);
	$link->query("Запись в БД");

}*/

//$goodvalues = ['1', '2', '3', 'бублик', '5', '6', '7', '8', '9', 'other'];

//$arrForm = ['one', 'two', 'бублик', 'бублик', '5', '5', '5', '5', 'nine', 'other']; //получено из формы
//$i = 0;
//$c = 0;
//foreach($arrForm as $value) {
//	if(in_array($value, $goodvalues)) {
	//	$new_array[] = $value;
	//}
//}
//echo '<pre>';
//print_r($new_array);

echo 'ТЕСТ номер три';

$goodvalues  = array ('Строка_1','Строка_2','Строка_3','Строка_4','Строка_5');

//$arrForm = array ('one','two','4','nine', 'other'); //получено из формы
$arrForm = array ('Строка_1', 'Строка_1', 'Строка_5');
$repl = array(
	'Строка_1' => 100,
	'Строка_2' => 100,
	'Строка_3' => 170,
	'Строка_4' => 150,
	'Строка_5' => 320);
$sum = 0;
foreach($arrForm as $key => $value)
{
	if (!empty($value)) {
		$mass[$key] = $value;
	}
	if(in_array($value, $goodvalues))
	{
		$sum += $repl[$value];
	}
}
echo '<pre>';
$priz5 = implode(", ", $mass);
echo 'sum: '.$sum;
echo '<br>mass: '.$priz5;
?>

<form method="POST">
	<select name="arrForm[]">
		<option value="100">Строка_1</option>
		<option value="100">Строка_2</option>
		<option value="170">Строка_3</option>
		<option value="150">Строка_4</option>
		<option value="320">Строка_5</option>
	</select>
	<!-- тут кнопки на jqery + добавить select или - удалить. Максимум 10 select-ов -->
	<select name="arrForm[]">
		<option>Строка_1</option>
		<option>Строка_2</option>
		<option>Строка_3</option>
		<option>Строка_4</option>
		<option>Строка_5</option>
	</select>
	<button>Отправить</button>
</form>


</html>