<?php
require_once 'script/connect.php';
?>
<!DOCTYPE html>
<html lang="ru" prefix="og: http://ogp.me/ns#">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Итоги обмена баллов на призы</title>
	<meta name="description" content="Итоги обмена баллов на призы">
	<meta name="keywords" content="MWO,Metal,War,Online,Обмен баллов,Обмен,баллы,призы за баллы,призы,таблица,таблица с баллами,итоги обмена,итоги обмена баллов на призы">
	<meta property="og:type" content="website">
	<meta property="og:url" content= "http://mwogame.com/points/results.php">
	<meta property="og:site_name" content="Metal War Online">
	<meta property="og:title" content="Итоги обмена баллов на призы">
	<meta property="og:description" content="Итоги обмена баллов на призы">
	<meta property="og:image" content="http://mwogame.com/uploads/images/Gallery/wallpapers/IMG_14062012_192128.png">
	<link rel="shortcut icon" href="http://mwogame.com/forum/favicon.ico" type="image/x-icon">
	<link href="/points/css/normalize.css" rel="stylesheet">
	<link href="/points/css/general.css" rel="stylesheet">
	<link href="/points/css/results.css" rel="stylesheet">
	<link href="/points/css/pagination.css" rel="stylesheet">
	<link href="/points/css/fonts.css" rel="stylesheet">
	<link href="/points/css/mobile-adaptation.css" rel="stylesheet">
	<link href="/points/css/snow.css" rel="stylesheet">
	<link href="/points/css/cross-browser.css" rel="stylesheet">
	<link href="https://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="/points/jquery-3.4.1.min.js"></script>
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
					include_once 'script/poiskitog.php';
					?>
				</div>
				<div id="right" class="right-content clearfix">
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
									<li class="active">
										<a href="/points/results">Итоги выдачи призов</a>
									</li>
									<li>
										<a href="/points/swap">Обмен баллов на призы</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="nav-search clearfix">
							<div class="nav-heding clearfix">
								<span>Поиск</span>
							</div>
							<div class="box-search">
								<form class="form-search" method="get" action="results.php">
									<div class="form-row">
										<input class="user-search" id="user-search" type="text" name="search"
											   minlength="3" maxlength="21" required>
										<label for="user-search">Введите никнейм...</label>
									</div>
									<button class="searhpoisk" type="submit">НАЙТИ</button>
								</form>
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
</body>
</html>
