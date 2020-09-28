<?php
	// Скрипт для посмотра данных о абитурентов
	
	session_start(); // Устанавлеваем сессии для текувщей формы
	
	if(isset($_SESSION['User']['id']) && $_SESSION['User']["role"] == "Admin")
	{ // Если сессия открыта для данного пользователя
		require_once("Myfunctions.php"); // Подключаем наши функции
	
		$NumbEnroll = substr($_SERVER['QUERY_STRING'], 3); // Получаем номер абитурента со адресной строки
		$NumbEnroll *=1; // Певращаем номер абитурента в числу
		
		
		$RecEnroll = getEditEnroll($NumbEnroll); // Получаем одну заявку по номеру абитурента
				
		echo("
<!doctype html>
<html>
	<head>
		<meta charset=\"UTF-8\">
		<title>". $RecEnroll["Famile"] ." ". $RecEnroll["Name"] ." ". $RecEnroll["Patron"] ."</title>
		<link href=\"style.css\" rel=\"stylesheet\" type=\"text/css\" />
		<link href=\"jHtmlArea/jHtmlArea.css\" rel=\"stylesheet\" type=\"text/css\" />	
	</head>

	<body>
		<header>
			<h1> Админ панель CMS MyBlog </h1>
			
			<form name=\"Exitadminka\" action=\"Exitadmin.php\" method=\"post\">
				<input type=\"submit\" id=\"End\" value=\"Выход\" />
			</form>
			
			<div class=\"clear\"></div>
			<nav id=\"MainMenu\">
				<a href=\"main.php\" title=\"Главная\"> Главная </a>
				<a href=\"workpage.php\" class=\"Home\" title=\"Работа со страничками\"> Работа со страничками </a>
				<a href=\"workpost.php\" title=\"Посты\"> Посты </a>
				<a href=\"setadmin.php\" title=\"Настройки админа\"> Настройки админа </a>
			</nav>
		</header>
		
		<section class=\"MainBlock\">
			<div id=\"SubDiv\">
				<p> Данные о абитуриенте </p>
				
				<span> Фамилия: </span>
				<span>". $RecEnroll["Famile"] .". </span> <br>
				
				<span> Имя: </span>
				<span>". $RecEnroll["Name"] .". </span> <br>
				
				<span> Отчество: </span>
				<span>". $RecEnroll["Patron"] .". </span> <br><br>
				
				<span> Телефон: </span>
				<span>". $RecEnroll["Phone"] .". </span> <br>
				
				<span> Email: </span>
				<span>". $RecEnroll["Email"] .". </span> <br><br>
				
				<span> Школа: </span>
				<span>". $RecEnroll["Shkool"] .". </span> <br>
				
				<span> Класс: </span>
				<span>". $RecEnroll["Class"] .". </span><br>
				<button class=\"Person\"> <a href=\"Formdelenroll.php?id=". $RecEnroll["id"]. " \" title=\"Удалить абитурента\"> Удалить абитурента </a> </button>
			</div>				
		</section>
		 
		<p id=\"Avtor\"> Данную CMS написал Чермантеев Камиль </p>


	</body>
</html>


			"); // Показываем Информацию о абитуриента пользователю 
	}
?>