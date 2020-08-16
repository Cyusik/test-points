<!DOCTYPE html>
<html lang="ru" prefix="og: http://ogp.me/ns#">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Обмен баллов на призы</title>
	<meta name="description" content="Обмен баллов на призы">
	<meta name="keywords" content="MWO,Metal,War,Online,Обмен баллов,Обмен,баллы,призы за баллы,призы,таблица,таблица с баллами,итоги обмена,итоги обмена баллов на призы">
	<meta property="og:type" content="website">
	<meta property="og:url" content= "http://mwogame.com/points/swap.php">
	<meta property="og:site_name" content="Metal War Online">
	<meta property="og:title" content="Обмен баллов на призы">
	<meta property="og:description" content="Обмен баллов на призы">
	<meta property="og:image" content="http://mwogame.com/uploads/images/Gallery/wallpapers/IMG_14062012_192128.png">
	<link rel="shortcut icon" href="/points/favicon.ico" type="image/x-icon">
	<link href="/points/normalize.css" rel="stylesheet">
	<link href="/points/styleswap.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="/points/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="form.js"></script>

</head>
<body>
<div class="main">
	<div id="logos" class="clearfix">
		<h1 class="logomwo">
			<a href="/">metal war online</a>
		</h1>
	</div>
	<div id="table" class="clearfix">
		<div class="table-t">
			<div class="spisok-priz">
				<h3 class="heding">Форма для обмена баллов на призы</h3>
				<div id="resultdiv"></div>
				<?php
				include_once 'script/connect.php';
				$query = "SELECT * FROM formobmen WHERE `open`";
				$result = mysqli_query($link, $query);
				echo "<table class='table_dark2'>
				<form id= 'forms' method= 'POST' action=''>";
				while ($row = $result->fetch_assoc())
				{
					$open = $row['open'];
					if( $open == '1')
					{
						echo "<tr>
				<th>Выдача наград будет производиться в течении 3-х дней после закрытия опроса</th>
				</tr>
				<tr>
				<td>
					Укажите ваше игровое имя (никнейм):<br><br>
					<input minlength='3' id='search' name='nicknames5' class='form_input' type='text' maxlength='21' onkeyup=\"checkParams()\" required>
					<ul id='ul_stop1' class='input-requirements' style='height:0px; opacity:0'>
					<li>не менее 3 символов...</li></ul>
					<td><div id='resultdiv_search'></div></td>
				</td>	
				</tr>";
				?>
						<script>
						$(document).ready(function() {
								var search = $("#search");
								search.focus(function () {
									$("#ul_stop1").stop().animate({
										height: "20px",
										opacity: 1,
									}, 500, function() {
										$("#ul_stop1").add("ul_stop1").css("display", "block");
									});
								});
								search.blur(function() {
									$("#ul_stop1").stop().animate({
										height: "0px",
										opacity: 0,
									}, 500, function() {
									});
								});
								var timeout;
								search.keyup(function (I) {
									switch(I.keyCode) {
										case 13:
										case 27:
										case 38:
										case 40:
											break;
										default:
											var name = $("#search").val();
											name = name.replace(/ +/g, ' ').trim();
											if (name === '') {
												$("#resultdiv_search").html('');
											} else if (name.length > 2) {
												clearTimeout(timeout);
												timeout = setTimeout(function () {
													$.ajax({
														type: "POST",
														url: "form_search.php",
														data: {
															search: name
														},
														success: function (respone) {
															$("#resultdiv_search").html(respone).show();
														},
													});
												}, 330);
											}
									}
								});
							});
						</script>
				<?php
				echo "<tr>
				<td>
					Укажите логин вашего аккаунта:<br>
					<p style='font-size:12px'>Для игроков из социальных сетей и steam необходимо указать ссылку на ваш профиль.</p> 
					<input  id = 'login' onkeyup=\"checkParams()\" name=\"login5\" type=\"text\" required/>
					<ul id='ul_stop2' class='input-requirements' style='height:0px; opacity:0'>
						<li class='one'>Примеры:</li>
						<li>login123@mail.ru</li>
						<li>vk.com/id23456789...</li>
						<li>steamcommunity.com/profiles/12345678910...</li>
						<li>ok.ru/profile/123456789...</li>
					</ul>
				</td>
				</tr>";
				?>
				<script>
					$(document).ready(function() {
						var login =  $("#login");
						login.focus(function () {
						 	$("#ul_stop2").stop().animate({
								height: "83px",
								opacity: 1,
							 }, 800, function() {
								$("#ul_stop2").add("ul_stop2").css("display", "block");
							});
						});
						login.blur(function() {
							$("#ul_stop2").stop().animate({
								height: "0px",
								opacity: 0,
							}, 800, function() {
								//$("#ul_stop2").remove();
							});
						});
					});
				</script>
				<?php
				echo "<tr>
				<td>
			<div id='list'>
					Выберите приз:<br><br>
					<div id='select0'></div>
			</div>
					<div class='add' onclick='addSelect()'>+ Добавить</div><div class='add' onclick='delSelect()'>- Удалить</div>
					</td>
					<td>
					<div>Необходимо баллов:<br><br> 
						<input id='resultdiv10' style='color:black' type='text' value='' name='points_required' disabled />
					</div>
					</td>		
					</tr>
					<tr>
					<td>
					<input  class=\"searhpoisk\" type=\"submit\" id=\"submit\" value=\"Отправить\">
					</td>
					</tr>";
				?>
				<script>
					var x = 0;
					var y = 1;
					var i = 1;
					function addSelect() {
						if (x < 10) {
							var list = document.getElementById('list');
							var div = document.createElement('div');
							var span = document.createElement('span');
							div.id = 'select' + ++x;
							div.innerHTML = '<select id="test' + y + '" type="text" name=\'priz5[]\' form=\'forms\' required>\n' +
								'<option disabled=\'disabled\' selected></option>\n' +
								'<option value="100">Супер-Выстрел 50000 шт</option>\n' +
								'<option value="100">Усиленная мина 100 шт</option>\n' +
								'<option value="100">Большая аптечка 100 шт</option>\n' +
								'<option value="100">Усиленное поле 100 шт</option>\n' +
								'<option value="100">Усиленный щит 100 шт</option>\n' +
								'<option value="100">Двойной нитро 100 шт</option>\n' +
								'<option value="100">Усиленный сканер 100 шт</option>\n' +
								'<option value="100">Усиленные батареи 100 шт</option>\n' +
								'<option value="100">Дымовой заслон 100 шт</option>\n' +
								'<option value="410">Циклотрон IV+ 1 шт</option>\n' +
								'<option value="350">Катушка V+ 1 шт</option>\n' +
								'<option value="340">Накопитель IV+ 1 шт</option>\n' +
								'<option value="320">Турбонаддув IV+ 1 шт</option>\n' +
								'<option value="260">Обшивка IV+ 1 шт</option>\n' +
								'<option value="220">Стабилизатор V+ 1 шт</option>\n' +
								'<option value="220">Дальнометр V+ 1 шт</option>\n' +
								'<option value="210">Целеуказатель V+ 1 шт</option>\n' +
								'<option value="180">Усилитель руля V+ 1 шт</option>\n' +
								'<option value="170">Подшипник V+ 1 шт</option>\n' +
								'<option value="160">Локатор V+ 1 шт</option>\n' +
								'<option value="110">Антирадар V+ 1 шт</option>\n' +
								'<option value="250">Хищник на 30 дней</option>\n' +
								'<option value="250">Борей на 30 дней</option>\n' +
								'<option value="250">Титан на 30 дней</option>\n' +
								'<option value="250">Тень на 30 дней</option>\n' +
								'<option value="250">Левиафан на 30 дней</option>\n' +
								'<option value="250">VIP-аккаунт на 30 дней</option>\n' +
								'</select>';
							list.appendChild(div);
							++y;
							$(document).ready(function() {
								$('#list').change(sum);
								function sum(){
									let result=0;
									$('#list').find('select').each(function(){
										let value = 0;
										if (typeof $(this).val() == 'object'){
											$.each($(this).val(), function(index, val) {
												value += val*1;
											});
										} else {
											value = $(this).val()
										}
										result+=value*1;
									});
									$('#resultdiv10').val(result);
								}
							});
						}
					}
						function delSelect() {
						if (x > 0) {
							var div = document.getElementById('select' + x);
							var result = document.getElementById('prizes-result');
							div.remove();
							--x;
									$('#list').find('select').each(function(){
										let value = 0;
										if (typeof $(this).val() == 'object'){
											$.each($(this).val(), function(index, val) {
												value += val*1;
											});
										} else {
											value = $(this).val()
										}
										result+=value*1;
									});
									if (result <= 0) {
										$('#resultdiv10').val('');
									} else {
										$('#resultdiv10').val(result);
									}
						}
					}

				</script>
				<?php
				echo "</form>
				</table>";
					} else if ($open == '2') {
						echo "<table class='table_dark2'>
			<tr>
			<td><br>
			Опрос будет доступен для заполнения с 13 по 15 и с 28 по 30 число каждого месяца.<br> Выдача наград будет производиться в течение 3-х дней после закрытия опроса.
			<br><br></td>
		</tr>
		</table>";
					}
				}
				?>
			</div>
			<div id="nav-balls">
				<ul class="nav-bottom">
					<li depth="1">
						<a href="/points/prizes.php">Призы за баллы</a>
					</li>
					<li depth="1">
						<a href="/points/index.php">Таблица с баллами</a>
					</li>
					<li depth="1">
						<a href="/points/results.php">Итоги обмена баллов на призы</a>
					</li>
					<li class="active" depth="1">
						<a href="/points/swap.php">Обмен баллов на призы</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<script src="knopa.js"></script>

</body>
<footer>
	<div class="foot">
		<ul class="ulfoot">
			<li>
				Сайт любезно разработан игроком Cyusik. О <a href="/points/about.php">сайте</a>
			</li>
			<li>
				Copyright (c) GDT Limited. <a href="http://gdteam.com">http://gdteam.com</a>
			</li>
		</ul>
	</div>
	<div id="button-up">
		<img src="top.png" alt="no" title="Вжух!">
	</div>
</footer>
</html>


