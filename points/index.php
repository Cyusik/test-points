<?php
require_once 'script/connect.php';
?>
<!DOCTYPE html>
<html lang="ru" prefix="og: http://ogp.me/ns#">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Таблица с баллами</title>
	<meta name="description" content="Таблица с баллами">
	<meta name="keywords" content="MWO,Metal,War,Online,Обмен баллов,Обмен,баллы,призы за баллы,призы,таблица,таблица с баллами,итоги обмена,итоги обмена баллов на призы">
	<meta property="og:type" content="website">
	<meta property="og:url" content="http://mwogame.com/points/index.php">
	<meta property="og:site_name" content="Metal War Online">
	<meta property="og:title" content="Таблица с баллами">
	<meta property="og:description" content="Таблица с баллами">
	<meta property="og:image" content="http://mwogame.com/uploads/images/Gallery/wallpapers/IMG_14062012_192128.png">
	<link rel="shortcut icon" href="http://mwogame.com/forum/favicon.ico" type="image/x-icon">
	<link href="/points/css/normalize.css" rel="stylesheet">
	<link href="/points/css/general.css" rel="stylesheet">
	<link href="/points/css/points.css" rel="stylesheet">
	<link href="/points/css/pagination.css" rel="stylesheet">
	<link href="/points/css/fonts.css" rel="stylesheet">
	<link href="/points/css/snow.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="/points/jquery-3.4.1.min.js"></script>
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
				<div class="left-content clearfix">
					<?php
					include_once 'script/poisk.php';
					?>
				</div>
				<div class="right-content clearfix">
					<div class="fixed-div">
						<div class="nav-points clearfix">
							<div class="nav-heding clearfix">
								<span>Навигация</span>
							</div>
							<div class="nav-bottom clearfix">
								<ul>
									<li>
										<a href="/points/prizes">Призы за баллы</a>
									</li>
									<li class="active">
										<a href="/points/index">Таблица с баллами</a>
									</li>
									<li>
										<a href="/points/results">Итоги обмена баллов на призы</a>
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
								<form class="form-search" method="get" action="index.php">
									<div class="form-row">
										<input class="user-search" id="user-search" type="text" name="search"
											   minlength="3" maxlength="21" required autocomplete="off">
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
<script type="text/javascript" src="jsjq/fixed-div.js"></script>
</body>
</html>