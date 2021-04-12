<?php
ini_set('session.cookie_secure',1);
ini_set('session.cookie_httponly',1); // посмотреть позже
ini_set('session.use_only_cookies',1);
include_once '../script/login.php';
session_start();
if($_GET['do'] == 'logout'){
unset($_SESSION['login']);
session_destroy();
}
if($_SESSION['login']){
	$login = $_SESSION['login'];
	//$file_login = "../logfiles/login_to_admin.log";
	//$fw = fopen($file_login, "a+");
	//include_once '../script/datetime.php';
	//fwrite($fw, $newdate.' '.$login.' Вошел mainballs.php'.' Логин: '. $login."\r\n");
	//fclose($fw);
}
else {
header("Location: ../admin/index.php");
exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Админка баллы</title>
	<link rel="shortcut icon" href="http://mwogame.com/forum/favicon.ico" type="image/x-icon">
	<meta name="description" content="Описание страницы">
	<meta name="keywords" content="Ключевые слова через запятую">
	<link href="../css/normalize.css" rel="stylesheet">
	<link href="../admin/css/main.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="fon">
	<header>
		Админка/описание
	</header>
	<hr>
	<br>
	<div>
		<nav>
			<ul class="menu">
				<li><a href="../admin/importballs.php" class="button15">Управление баллами</a></li>
				<li><a href="../admin/importspisok.php" class="button15">Управление обменом</a></li>
				<li><a href="../admin/formobmen.php" class="button15">Заявки на призы</a></li>
				<?php
				if($_SESSION['login'] && $_SESSION['role'] == 1){
					$log = $_SESSION['login'];
					echo '<li><a href="../admin/control.php" class="button15" style="background: rgb(245,245,245) linear-gradient(#f4f4f4, #fd7a7a); border:none">Управление</a></li>';
				}
				?>
				<li><a href="../admin/mainballs.php?do=logout" class="button15">Выйти</a></li>
			</ul>
		</nav>
	</div>
	<div class="text">
		<table class="table_import1">
			<tr>
			<th><b style="color:red">Руководство пользователя и просто полезная информация (adminballs ver.1)</b></th>
			</tr>
			<tr>
				<td>
					В админке содержится функционал, позволяющий изменять данные в общей таблице баллов и в таблице итогов обмена, смотреть слева соответствующие вкладки управления баллами и обменом. Со временем, по возможности, функционал будет обновляться, о чем тут будет сообщаться. <br>
				</td>
			</tr>
			<tr>
				<td>
					Так же необходимо скачать и установить ПО <a href="https://drive.google.com/file/d/1tR3TsAPts4mYhp_mn6fX7kOxSQqBFcIt/view?usp=sharing" target="_blank">Open Office Calc</a>. По ссылке сразу загружается русская версия программы. Это аналог microsoft office, нам она необходима для открытия/просмотра/редактирования таблиц при импорте. <b>Exel использовать для работы с файлами .csv НЕ рекомендую</b>, т.к. ему характерно автоматически подставлять формулы (например никнеймы со знаком " - " в начале он может определить как условие и при форматировании в csv файл поставить перед минусом знак " = ") из-за чего многие ники превратятся в "#ИМЯ?", и накакой формат ячеек = текстовый не поможет. Open Office воспринимает текст таким, каким вы его поставили, обладает выбором кодировки и разделителя при сохранении и считывания.
				</td>
			</tr>
			<tr>
				<td>
					На данный момент в функционале есть некоторая защита от случайных ошибок/нажатий, однако не везде, не идеальная и далеко не полная. Со временем это так же добавится, например запреты на ввод кириллицы в область никнейма при добавлении. Так же невозможно поставить защиту от всего, так что просьба внимательно ознакомиться с инстукцией и при возникновении вопросов - спрашивать.<br>
					На крайний случай всегда можно полностью очистить таблицы и импортировать вновь.
				</td>
			</tr>
			<tr>
				<td>
					После некоторых действий в админке, при обновлении страницы может появиться окно "Повторная отправка формы"<br><br>
					<img src="formabug.png" alt="" style="margin-left:25%"><br><br>
					В таком случае нажимаем <b>отмена</b> и пользуемся кнопками менюшки слева. Нажимаем назад, например. Потом можно вернуться обратно и продолжать работать.<br>
					Если данная проблема ещё актуальна, сообщи.
				</td>
			</tr>
		</table>
		<br>
		<table class="table_import1">
			<tr>
				<th>
					<b style="color:red">Смотреть перед началом первой работы</b>
				</th>
			</tr>
			<tr>
				<td>
					<b>Видеоинструкция</b><br>
					Подробнее про экспрот/импорт.<br>
					В базе данных таблицы состоят в кодировке UTF-8. Файлы csv состоят не из таблицы, а из строчек и для определеия ячеек используется запятая точка с запятой при экспорте/импорте файлов.<br>
					Это значит что:<br>
					1. Экспортированный файл открываем при помощи Open Office, указываем кодировку UTF-8, разделитель - точка с запятой. Так он откроется в нормальном табличном виде. (при этом ещё и вносятся названия столбцов и id)<br>
					2. Для формирования файла импорта - в Open Office создаем обычную электронную таблицу, вставляем ники, баллы и историю (как обычно в табличном виде выглядит). Далее сохранить как -> указываем файл csv -> использовать текущий формат -> кодировку UTF-8, разделитель точка с запятой -> Ок.<br>
					Ну и смотрим видео ниже, если не понятно.
				</td>
			</tr>
			<tr>
				<td style="text-align: center;">
					<iframe width="560" height="315" src="https://www.youtube.com/embed/UZ8TVolnadI" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				</td>
			</tr>
		</table>
		<div class="kartinka">
			<img src="../admin/sdelal.png" alt="Сюсик" title="Сюсик">
		</div>
	</div>
</div>
</body>
<footer>
	<br>
	author by <a href="http://mwogame.com/forum/user/17146-cyusik-c%d1%8e%d1%81%d0%b8%d0%ba/" target="_blank">Cyusik</a>
	<br>
</footer>
</html>
