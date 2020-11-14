<?php
require_once 'script/connect.php';
?>
<!doctype html>
<html lang="ru" prefix="og: http://ogp.me/ns#">
<?php include 'cap.php'; ?>
<head>
	<title>Таблица с баллами</title>
	<meta name="description" content="Таблица с баллами">
	<meta property="og:url" content= "http://mwogame.com/points/index.php">
	<meta property="og:title" content="Таблица с баллами">
	<meta property="og:description" content="Таблица с баллами">
	<link href="/points/styleballs.css" rel="stylesheet">
	<link href="indexstyle.css" rel="stylesheet">
</head>
<body>
<h1>Привет, МИР!</h1>
<div class="container"> ТУТ таблица
	<?php
	include_once 'script/poisk.php';
	?>
</div>
<?php include 'footer.php'; ?>
</body>
</html>