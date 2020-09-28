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
				<title> Работа с страницами блога! </title>
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
						<a href="main.php" title="Главная"> Главная </a>
						<a href="workpage.php" class="Home" title="Работа с страничками"> Работа с страничками </a>
						<a href="workpost.php" title="Посты"> Посты </a>
						<a href="setadmin.php" title="Настройки админа"> Настройки админа </a>
					</nav>
				</header>

				<section class="MainBlock">
					<div id="SubDiv">
						<p> Работа со страницами </p>
						<a href="Newpage.php" title="Добавит новую страницу"> 1) Добавит новую страницу </a> 
						<a href="Editpage.php" title="Редактировать страницы"> 2) Редактировать страницы </a> 
						<?php
							if($_SESSION['User']["role"] == "Admin")
							{ // Если пользователь админ
						?>
								<a href="Delpage.php" title="Удалить страницу"> 3) Удалить страницу </a> 
						<?php
							// Покаживаем настройки админа
							}
						?>					
					</div>				
				</section>

				<p id="Avtor"> Данную CMS написал Чермантеев Камиль </p>


			</body>
		</html>

		<?php
		// Покаживаем страницу "Работа с страницами" пользователю
	}
	else {  // Иначи
			echo("Извините, но эта часть сайта Вам недоступна! <br >
			<a href='../index.php'> Назад к сайту </a>"); // Выводим информацию об ошибке и просем пользователя вернутся на главную страницу блога					
		}

?>
