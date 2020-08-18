<?php
//header("Content-type: text/html; Charset=utf-8");

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

