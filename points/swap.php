
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
	<link href="/points/styleobmen.css" rel="stylesheet">
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
				<form id= \"foms\" method=\"POST\" action=\"/points/script/swapform.php\">";
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
					<input id = \"nickname\" onkeyup=\"checkParams()\" name=\"nicknames5\" type=\"text\" size=\"40\" required/>
				</td>	
				</tr>
				<tr>
				<td>
					Укажите логин вашего аккаунта:<br>
					<p style='font-size:12px'>Для игроков из социальных сетей и steam необходимо указать ссылку на ваш профиль.</p> 
					<input  id = \"login\" onkeyup=\"checkParams()\" name=\"login5\" type=\"text\" size=\"40\" required/>
				</td>
				</tr>
				<tr>
				<td>
					Выберите приз:<br><br>
				<select name=\"priz5\" form=\"foms\">
					<option>Супер-Выстрел 50000 шт</option>
					<option>Усиленная мина 100 шт</option>
					<option>Большая аптечка 100 шт</option>
					<option>Усиленное поле 100 шт</option>
					<option>Усиленный щит 100 шт</option>
					<option>Двойной нитро 100 шт</option>
					<option>Усиленный сканер 100 шт</option>
					<option>Усиленные батареи 100 шт</option>
					<option>Дымовой заслон 100 шт</option>
					<option>Циклотрон IV+ 1 шт</option>
					<option>Катушка V+ 1 шт</option>
					<option>Накопитель IV+ 1 шт</option>
					<option>Турбонаддув IV+ 1 шт</option>
					<option>Обшивка IV+ 1 шт</option>
					<option>Стабилизатор V+ 1 шт</option>
					<option>Дальнометр V+ 1 шт</option>
					<option>Целеуказатель V+ 1 шт</option>
					<option>Усилитель руля V+ 1 шт</option>
					<option>Подшипник V+ 1 шт</option>
					<option>Локатор V+ 1 шт</option>
					<option>Антирадар V+ 1 шт</option>
					<option>Хищник на 30 дней</option>
					<option>Борей на 30 дней</option>
					<option>Титан на 30 дней</option>
					<option>Тень на 30 дней</option>
					<option>Левиафан на 30 дней</option>
					<option>VIP-аккаунт на 30 дней</option>
					</select>
					</td>			
					</tr>
					<tr>
					<td>
					<input  class=\"searhpoisk\" type=\"submit\" id=\"submit\" value=\"Отправить\" disabled>
					</td>
					</tr>
				</form>
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
				}$result->free();
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


