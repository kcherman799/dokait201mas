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
				<title> Админ панель блога! </title>
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
						<a href="main.php" class="Home" title="Главная"> Главная </a>
						<a href="workpage.php" title="Работа со страничками"> Работа со страничками </a>
						<a href="workpost.php" title="Посты"> Посты </a>
						<a href="setadmin.php" title="Настройки админа"> Настройки админа </a>
					</nav>
				</header>

				<section class="MainBlock" >
					<div class="SetBlock">
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

					<div class="SetBlock">
						<p> Работа со постами </p>
						<a href="Newpost.php" title="Добавит новый пост"> 1) Добавит новый пост </a> 
						<a href="Editpost.php" title="Редактировать посты"> 2) Редактировать посты </a> 
						<a href="delpost.php" title="Удалить пост"> 3) Удалить пост </a>			
					</div>

					<div class="SetBlock" id="Center">
								<p> Настройки админа </p>
								<a href="ChangMyuser.php" title="Сменит данные своей учетной записи"> 1) Сменить данные своей учетной записи </a> 		<?php
								if($_SESSION['User']["role"] == "Admin")
								{ // Если пользователь админ
							?>					
										
								<a href="dataenroll.php" title="Посмотреть заявки от абитуриентов"> 2) Посмотреть заявки от абитуриентов  </a> 				
								<a href="Newuser.php" title="Добавит нового пользователя"> 3) Добавит нового пользователя </a> 
								<a href="Edituser.php" title="Редактировать пользователя"> 4) Редактировать пользователя </a> 
								<a href="Deluser.php" title="Удалить пользователя"> 5) Удалить пользователя </a>
							</div>
					<?php
							// Покаживаем настройки админа
						}
					?>
				</section>

				<p id="Avtor"> Данную CMS написал Чермантеев Камиль </p>


			</body>
		</html>
		
		<?php
		// Покаживаем админ панель пользователю
	}
	else {  // Иначи
			echo("Извините, но эта часть сайта Вам недоступна! <br >
			<a href='../index.php'> Назад к сайту </a>"); // Выводим информацию об ошибке и просем пользователя вернутся на главную страницу блога					
		}

?>
