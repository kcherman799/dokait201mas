<?php
	// Скрипт для работы с настройками админа 

	session_start(); // Устанавлеваем сессии для текувщей формы

	if(isset($_SESSION['User']['id']))
	{ // Если сессия открыта для данного пользователя
		?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title> Настройки админа блога! </title>
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
				<a href="workpage.php" title="Работа со страничками"> Работа со страничками </a>
				<a href="workpost.php" title="Посты"> Посты </a>
				<a href="setadmin.php" class="Home" title="Настройки админа"> Настройки админа </a>
			</nav>
		</header>
		
		<section class="MainBlock">
			<div id="SubDiv">
				<p> Настройки админа </p>
				<a href="ChangMyuser.php" title="Сменит данные своей учетной записи"> 1) Сменить данные своей учетной записи </a> 
			<?php
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
		 
		<p id="Avtor"> Данную CMS написал Черматеев Камиль </p>


	</body>
</html>
<?php
		// Покаживаем страницу "Настройки админ панели" пользователю
	}
	else {  // Иначи
			echo("Извините, но эта часть сайта Вам недоступна! <br >
			<a href='../index.php'> Назад к сайту </a>"); // Выводим информацию об ошибке и просем пользователя вернутся на главную страницу блога					
		}

?>