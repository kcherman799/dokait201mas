<?php
	// Скрипт для входа в админ панель

	session_start(); // Устанавлеваем сессии для текувщей формы

	if(isset($_SESSION['User']['id']))
	{ // Если сессия открыта для данного пользователя
		?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title> Работа с постами блога! </title>
		<link href="style.css" rel="stylesheet" type="text/css" />
	</head>

	<body>
		<header>
			<h1> Админ панель CMS MyBlog </h1>
			
			<form name="Exitadminka" action="Exitadmin.php" method="post">
				<input type="submit" id="End" value="Выход" />
			</form>
			
			
			<div class="clear"></div>
			<nav id="MainMenu">
				<a href="main.html" title="Главная"> Главная </a>
				<a href="workpage.php" title="Работа со страничками"> Работа со страничками </a>
				<a href="workpost.php" class="Home" title="Посты"> Посты </a>
				<a href="setadmin.php" title="Настройки админа"> Настройки админа </a>
			</nav>
		</header>
		
		<section class="MainBlock">
			<div id="SubDiv">
				<p> Работа со постами </p>
				<a href="Newpost.php" title="Добавит новый пост"> 1) Добавит новый пост </a> 
				<a href="Editpost.php" title="Редактировать посты"> 2) Редактировать посты </a> 
				<a href="delpost.php" title="Удалить пост"> 3) Удалить пост </a>					
			</div>				
		</section>
		 
		<p id="Avtor"> Данную CMS написал Черматеев Камиль </p>


	</body>
</html>
<?php
		// Покаживаем страницу "Работа с постами" пользователю
	}
	else {  // Иначи
			echo("Извините, но эта часть сайта Вам недоступна! <br >
			<a href='../index.php'> Назад к сайту </a>"); // Выводим информацию об ошибке и просем пользователя вернутся на главную страницу блога					
		}

?>

