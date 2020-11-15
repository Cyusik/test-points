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
	<meta property="og:url" content= "http://mwogame.com/points/index.php">
	<meta property="og:site_name" content="Metal War Online">
	<meta property="og:title" content="Таблица с баллами">
	<meta property="og:description" content="Таблица с баллами">
	<meta property="og:image" content="http://mwogame.com/uploads/images/Gallery/wallpapers/IMG_14062012_192128.png">
	<link rel="shortcut icon" href="/points/favicon.ico" type="image/x-icon">
	<link href="/points/normalize.css" rel="stylesheet">
	<link href="/points/styleballs.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="/points/jquery-3.4.1.min.js"></script>
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
				<h3 class="heding">Общая таблица баллов</h3>
				<?php
				include_once 'script/poisk.php';
				?>
			</div>
			<div id="nav-balls">
				<ul class="nav-bottom">
					<li depth="1">
						<a href="/points/prizes">Призы за баллы</a>
					</li>
					<li class="active" depth="1">
						<a href="/points/index">Таблица с баллами</a>
					</li>
					<li depth="1">
						<a href="/points/results">Итоги обмена баллов на призы</a>
					</li>
					<li depth="1">
						<a href="/points/swap">Обмен баллов на призы</a>
					</li>
				</ul>
				<div class="poisk">
					<form class="searh" method="get" action="index.php">
						<input class="searhnik" type="text" name="search" placeholder="Введите никнейм..." minlength="3" maxlength="21">
						<br>
						<button class="searhpoisk" type="submit">Найти...</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<footer>
	<div class="foot">
		<ul class="ulfoot">
			<li>
				Сайт любезно разработан игроком Cyusik. О <a href="/points/about">сайте</a>
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
</body>
</html>