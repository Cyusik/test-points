<?php
if (!empty($_POST['monthlogadmin'])) {
	$date_month = trim($_POST['monthlogadmin']);
	$log = fopen("../logfiles/login_to_admin.log", "r");
	$arr = file("../logfiles/login_to_admin.log");
	echo '<div id="admin_log">';
	echo '<table class="table_dark2">
							<tr>
								<th>Путешествие по админке</th>
							</tr>';
	echo '<tr><td style="text-align:left"><textarea id="textareaadmin" class="textarea" style="outline:none; cursor:default" readonly>';
	foreach ( $arr as $k=>$v )
	{
		if ( strpos($v, $date_month,0) !==false )
		{
			echo $v;
		}
	}
	echo '</textarea></td></tr></table>
		<button style="float:right" type="submit" class="button10" id="closelogadmin">Закрыть лог</button><br><br></div>
		<script type="text/javascript">
							$("#closelogadmin").click(function() {
								$("#admin_log").remove();
							});
							var textar = $("#textareaadmin").val();   
							var lines = textar.split("\n");
							var count = lines.length - 1;
							var incount = parseInt(count);
							if (incount < 100) {
								if(incount < 15 && incount > 0) {
									$("#textareaadmin").attr("rows", 15);
								} else if (incount === 0) {
									$("#textareaadmin").attr("rows", 1);
									$("#textareaadmin").html("Строк в логе за этот период = 0");
								} else {
									$("#textareaadmin").attr("rows", incount);
								}
							} else {
								$("#textareaadmin").attr("rows", 100);
							}
		</script>';
	fclose($log);
}
if (!empty($_POST['monthlogswap'])) {
	$date_month = trim($_POST['monthlogswap']);
	$log = fopen("../logfiles/swap_log.log", "r");
	$arr = file("../logfiles/swap_log.log");
	echo '<div id="swap_log">';
	echo '<table class="table_dark2">
							<tr>
								<th>Форма для обмена</th>
							</tr>';
	echo '<tr><td style="text-align:left"><textarea id="textareaswap" class="textarea" style="outline:none; cursor:default" readonly>';
	foreach ( $arr as $k=>$v )
	{
		if ( strpos($v, $date_month,0) !==false )
		{
			echo $v;
		}
	}
	echo '</textarea></td></tr></table>
	<button style="float:right" type="submit" class="button10" id="closelogswap">Закрыть лог</button><br><br></div>
	<script type="text/javascript">
							$("#closelogswap").click(function() {
								$("#swap_log").remove();
							});
							var textar = $("#textareaswap").val();   
							var lines = textar.split("\n");
							var count = lines.length - 1;
							var incount = parseInt(count);
							if (incount < 100) {
								if(incount < 15 && incount > 0) {
									$("#textareaswap").attr("rows", 15);
								} else if (incount === 0) {
									$("#textareaswap").attr("rows", 1);
									$("#textareaswap").html("Строк в логе за этот период = 0");
								} else {
									$("#textareaswap").attr("rows", incount);
								}
							} else {
								$("#textareaswap").attr("rows", 100);
							}
		</script>';
	fclose($log);
}
if (!empty($_POST['monthlogsearch'])) {
	$date_month = trim($_POST['monthlogsearch']);
	$log = fopen("../logfiles/search_log.log", "r");
	$arr = file("../logfiles/search_log.log");
	echo '<div id="search_log">';
	echo '<table class="table_dark2">
							<tr>
								<th>Поиск по таблицам юзерами</th>
							</tr>';
	echo '<tr><td style="text-align:left"><textarea id="textareasearch" class="textarea" style="outline:none; cursor:default" readonly>';
	foreach ( $arr as $k=>$v )
	{
		if ( strpos($v, $date_month,0) !==false )
		{
			echo $v;
		}
	}
	echo '</textarea></td></tr></table>
	<button style="float:right" type="submit" class="button10" id="closelogsearch">Закрыть лог</button><br></div>
	<script type="text/javascript">
							$("#closelogsearch").click(function() {
								$("#search_log").remove();
							});
							var textar = $("#textareasearch").val();   
							var lines = textar.split("\n");
							var count = lines.length - 1;
							var incount = parseInt(count);
							if (incount < 100) {
								if(incount < 15 && incount > 0) {
									$("#textareasearch").attr("rows", 15);
								} else if (incount === 0) {
									$("#textareasearch").attr("rows", 1);
									$("#textareasearch").html("Строк в логе за этот период = 0");
								} else {
									$("#textareasearch").attr("rows", incount);
								}
							} else {
								$("#textareasearch").attr("rows", 100);
							}
		</script>';
	fclose($log);
}
if (!empty($_POST['monthlogresults'])) {
	$date_month = trim($_POST['monthlogresults']);
	$log = fopen("../logfiles/results_log.log", "r");
	$arr = file("../logfiles/results_log.log");
	echo '<div id="results_log">';
	echo '<table class="table_dark2">
							<tr>
								<th>Управление обменом</th>
							</tr>';
	echo '<tr><td style="text-align:left"><textarea id="textarearesults" class="textarea" style="outline:none; cursor:default" readonly>';
	foreach ( $arr as $k=>$v )
	{
		if ( strpos($v, $date_month,0) !==false )
		{
			echo $v;
		}
	}
	echo '</textarea></td></tr></table>
	<button style="float:right" type="submit" class="button10" id="closelogresults">Закрыть лог</button><br><br></div>
	<script type="text/javascript">
							$("#closelogresults").click(function() {
								$("#results_log").remove();
							});
							var textar = $("#textarearesults").val();   
							var lines = textar.split("\n");
							var count = lines.length - 1;
							var incount = parseInt(count);
							if (incount < 100) {
								if(incount < 15 && incount > 0) {
									$("#textarearesults").attr("rows", 15);
								} else if (incount === 0) {
									$("#textarearesults").attr("rows", 1);
									$("#textarearesults").html("Строк в логе за этот период = 0");
								} else {
									$("#textarearesults").attr("rows", incount);
								}
							} else {
								$("#textarearesults").attr("rows", 100);
							}
		</script>';
	fclose($log);
}
if (!empty($_POST['monthlogpoints'])) {
	$date_month = trim($_POST['monthlogpoints']);
	$log = fopen("../logfiles/points_log.log", "r");
	$arr = file("../logfiles/points_log.log");
	echo '<div id="points_log">';
	echo '<table class="table_dark2">
							<tr>
								<th>Управление баллами</th>
							</tr>';
	echo '<tr><td style="text-align:left"><textarea id="textareapoints" class="textarea" style="outline:none; cursor:default" readonly>';
	foreach ( $arr as $k=>$v )
	{
		if ( strpos($v, $date_month,0) !==false )
		{
			echo $v;
		}
	}
	echo '</textarea></td></tr></table>
	<button style="float:right" type="submit" class="button10" id="closelogpoints">Закрыть лог</button><br><br></div>
	<script type="text/javascript">
							$("#closelogpoints").click(function() {
								$("#points_log").remove();
							});
							var textar = $("#textareapoints").val();   
							var lines = textar.split("\n");
							var count = lines.length - 1;
							var incount = parseInt(count);
							if (incount < 100) {
								if(incount < 15 && incount > 0) {
									$("#textareapoints").attr("rows", 15);
								} else if (incount === 0) {
									$("#textareapoints").attr("rows", 1);
									$("#textareapoints").html("Строк в логе за этот период = 0");
								} else {
									$("#textareapoints").attr("rows", incount);
								}
							} else {
								$("#textareapoints").attr("rows", 100);
							}
		</script>';
	fclose($log);
}
if (!empty($_POST['monthlogexchange'])) {
	$date_month = trim($_POST['monthlogexchange']);
	$log = fopen("../logfiles/exchange_log.log", "r");
	$arr = file("../logfiles/exchange_log.log");
	echo '<div id="exchange_log">';
	echo '<table class="table_dark2">
							<tr>
								<th>Управление заявками</th>
							</tr>';
	echo '<tr><td style="text-align:left"><textarea id="textareaexchange" class="textarea" style="outline:none; cursor:default" readonly>';
	foreach ( $arr as $k=>$v )
	{
		if ( strpos($v, $date_month,0) !==false )
		{
			echo $v;
		}
	}
	echo '</textarea></td></tr></table>
	<button style="float:right" type="submit" class="button10" id="closelogexchange">Закрыть лог</button><br><br></div>
	<script type="text/javascript">
							$("#closelogexchange").click(function() {
								$("#exchange_log").remove();
							});
							var textar = $("#textareaexchange").val();   
							var lines = textar.split("\n");
							var count = lines.length - 1;
							var incount = parseInt(count);
							if (incount < 100) {
								if(incount < 15 && incount > 0) {
									$("#textareaexchange").attr("rows", 15);
								} else if (incount === 0) {
									$("#textareaexchange").attr("rows", 1);
									$("#textareaexchange").html("Строк в логе за этот период = 0");
								} else {
									$("#textareaexchange").attr("rows", incount);
								}
							} else {
								$("#textareaexchange").attr("rows", 100);
							}
		</script>';
	fclose($log);
}
?>