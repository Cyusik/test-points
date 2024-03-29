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
	<link rel="shortcut icon" href="http://mwogame.com/forum/favicon.ico" type="image/x-icon">
	<link href="/points/css/normalize.css" rel="stylesheet">
	<link href="/points/css/general.css" rel="stylesheet">
	<link href="/points/css/swap.css" rel="stylesheet">
	<link href="/points/css/fonts.css" rel="stylesheet">
	<link href="/points/css/mobile-adaptation.css" rel="stylesheet">
	<link href="/points/css/snow.css" rel="stylesheet">
	<link href="/points/css/cross-browser.css" rel="stylesheet">
	<link href="https://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="/points/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="jsjq/form.js"></script>
	<script type="text/javascript">
		var isMobile = false;
		$(document).ready( function() {
			if ($('body').width() <= 460) {
				isMobile = true;
			}
			if (!isMobile) {
				$('body').append('<script type="text/javascript" src="jsjq/fixed-div.js"></scr' + 'ipt>');
			} else {
				$('body').append('<script type="text/javascript" src="jsjq/nav-mobile.js"></scr' + 'ipt>');
				$('head').append('<script type="text/javascript" src="jsjq/mobile_replace_div.js"></scr' + 'ipt>');
			}
		});
	</script>
</head>
<body>
<div class="snow">
<div class="main">
	<div id="logos" class="clearfix">
		<h1 class="logomwo">
			<a href="/">metal war online</a>
		</h1>
	</div>
	<div id="table" class="clearfix">
		<div class="table-t">
			<div id="left" class="left-content clearfix">
				<?php
				include_once 'script/connect.php';
				$query = "SELECT * FROM formobmen WHERE `open`";
				$result = mysqli_query($link, $query);
				while ($row = $result->fetch_assoc())
				{
					$open = $row['open'];
					if( $open == '1')
					{
						echo "<form id='forms' method='POST' action='/points/script/swapform.php'>
						<table class='table_dark swap_content'>
						<tr><th class='heding'>Форма для обмена баллов на призы</th></tr>";
							echo "<tr>
				<th>Выдача наград будет производиться в течении 3-х дней после закрытия опроса</th>
				</tr>
				<tr>
				<td>
					Укажите ваше игровое имя (никнейм):<br>
					<div class='div_points_search'><span>На счету баллов:</span>
				    <input style='width:140px; border:none' class='points_search' id='resultdiv_search' name='points_search' type='text' readonly></div>
					<input minlength='3' id='search' name='nicknames5' class='form_input' type='text' maxlength='21' required>
					<ul id='ul_stop1' class='input-requirements' style='height:0px; opacity:0'>
					<li>не менее 3 символов...</li></ul>
				</td>	
				</tr>";
							?>
							<script type="text/javascript" src="jsjq/live_search.js"></script>
						<?php
						echo "<tr>
				<td>
					Укажите логин вашего аккаунта:<br>
					<div class='div_points_search' style='margin-bottom:10px'>Для игроков из социальных сетей и steam необходимо указать ссылку на ваш профиль</div> 
					<input minlength='3'  id = 'login' name=\"login5\" type=\"text\" required/>
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
							<script type="text/javascript" src="jsjq/help_login.js"></script>
						<?php
						echo "<tr>
				<td>
					Выберите приз:<br>
					<div class='div_points_search' style='margin-bottom:10px'>Необходимо баллов:
						<input class='points_search' id='resultdiv10' style='width:100px; border: none' type='text' name='points_required' readonly/>
					</div>
				<div id='list'>
					<div id='select0'></div>
				</div>
					<div class='add' onclick='addSelect()'>+ Добавить</div><div class='add' onclick='delSelect()'>- Удалить</div>
					</td>
					</tr>
					<tr>
					<td>
					<input  class='searhpoisk swap_button' type='submit' id='submit' value='Отправить'>
					</td>
					</tr>";
						?>
							<script type="text/javascript">
								$(document).ready(function() {
									$("#submit").click(function() {
										$("select[name='priz5[]'] > option").each(function() {
											var content = $(this).text();
											$(this).val(content);
										});
									});
								});
							</script>
							<script type="text/javascript" src="jsjq/prizes_add.js"></script>
							<?php
							echo "</table></form>
				<div class='mainwindow'>
					<div class='openwindow'>
						<h2 id='heading'></h2>
						<span id='spanwidow'></span><br><br>
						<div class='add' id='closewidow'>Закрыть</div>
						</div>
					</div>";
					} else if ($open == '2') {
						echo "<table class='table_dark close_table'><tr><th class='heding'>Форма для обмена баллов на призы</th></tr>
			<tr>
			<td><b>Опрос будет доступен для заполнения с 13 по 15 и с 28 по 30 число каждого месяца.<br> Выдача наград будет производиться в течении 3-х дней после закрытия опроса.</b></td>
		</tr>
		</table>";
					}
				}
				?>
				<div id="resultdiv"></div>
			</div>
			<div id="right" class="right-content mob-marg-content clearfix">
				<div class="fixed-div">
					<div class="nav-points clearfix">
						<div class="nav-heding clearfix">
							<span>Навигация</span><i id="hide_menu" class="fa fa-bars"></i>
						</div>
						<div class="nav-bottom clearfix">
							<ul>
								<li>
									<a href="/points/prizes">Призы за баллы</a>
								</li>
								<li>
									<a href="/points/index">Таблица с баллами</a>
								</li>
								<li>
									<a href="/points/results">Итоги выдачи призов</a>
								</li>
								<li class="active">
									<a href="/points/swap">Обмен баллов на призы</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="end"></div>
	<div class="foot">
		<div class="foot_ul">
			<ul class="ulfoot">
				<li>
					Сайт любезно разработан игроком Cyusik. О <a href="/points/about">сайте</a>
				</li>
				<li>
					Copyright (c) GDT Limited. <a href="http://gdteam.com">http://gdteam.com</a>
				</li>
			</ul>
		</div>
	</div>
</div>
<div id="button-up">
	<img src="/points/img/general/top.png" alt="no" title="Вжух!">
</div>
</div>
<!--<script type="text/javascript" src="jsjq/fixed-div.js"></script>-->
</body>
</html>