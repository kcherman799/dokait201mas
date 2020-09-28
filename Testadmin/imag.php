<?php
	// Скрипт для Добавление новый страницы
//phpinfo();
	session_start(); // Устанавлеваем сессии для текувщей формы

	if(isset($_SESSION["id"]))
	{ // Если сессия открыта для данного пользователя
?>
		
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title> Добавить новый пост! </title>
		<link href="style.css" rel="stylesheet" type="text/css" />
		<link href="jHtmlArea/jHtmlArea.css" rel="stylesheet" type="text/css" />	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="jHtmlArea/jHtmlArea-0.8.js"></script>
		
		
		
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
				<a href="workpost.php" class="Home" title="Посты"> Посты </a>
				<a href="setadmin.php" title="Настройки админа"> Настройки админа </a>
			</nav>
		</header>
		
		<section class="MainBlock">
			<div id="SubDiv">
				<p> Добавить новый пост </p>
				
				<form name="insertpost" action="testimg.php" enctype="multipart/form-data" method="post">
				<section id="messageError"> </section>	
					<label> Заголовок поста: </label>
					<input type="text" id="NamePost" name="namepost" placeholder="Ввидете заголовок поста" /> <br /><br />
					<label> Вводный текст поста: </label>
					<input type="text" id="MiniText" name="minitext" placeholder="Ввидете вводный текст поста" /> <br />
					<p id="Text"> Основного текста поста: </p>
					
					<textarea cols="80" rows="10" id="TextPost" name="textpost"> </textarea> <br /> <br />
					<label> Картинка поста: </label>
					<input type="file" id="ImagPost" name="imagpost" /> <br />
					<input type="button" id="send" value="Добавить пост!" />
				</form>
			</div>				
		</section>
		 
		<p id="Avtor"> Данную CMS написал Чермантеев Камиль </p>


	</body>
</html>

<?php
		// Показываем Добавление новой постов пользователю
	}
	else {  // Иначи
			echo("Извините, но эта часть сайта Вам недоступна! <br >
			<a href='../index.php'> Назад к сайту </a>"); // Выводим информацию об ошибке и просем пользователя вернутся на главную страницу блога					
		}

?>