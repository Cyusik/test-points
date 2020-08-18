<?php
header("Content-type: text/html; Charset=utf-8");

function print_arr($arr){
	echo "<pre>" . print_r($arr, true) . "</pre>";
}
if(!empty($_POST)){
	// print_arr($_POST);
	$data = array();
	foreach($_POST['podarok'] as $item){
		$item = explode('|', $item);
		$data[$item[0]] = $item[1];
	}
	$priz5 = implode("\r",$data);
	echo $priz5;
}

?>
<form method="post">
	<select name="podarok[]">
		<option value="0">Содержимое 0</option>
		<option value="1">Содержимое 1</option>
	</select>
	<button type="submit" id="send">Send</button>
</form>

<script src="http://code.jquery.com/jquery.min.js"></script>
<script>
	$(function(){
		$('#send').on('click', function(){
			$("select[name='podarok[]'] > option").each(function(){
				var content = $(this).text(),
					val = $(this).val();
				$(this).val(val + '|' + content);
			});
		});
	});
</script>

