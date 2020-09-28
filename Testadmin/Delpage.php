<?php
	// Скрипт для удаление страницы
	session_start(); // Устанавлеваем сессии для текувщей формы
	
	require_once("Myfunctions.php"); // Подключаем наши функции
	

	if(isset($_SESSION['User']['id']) && $_SESSION['User']["role"] == "Admin")
	{ // Если сессия открыта для данного пользователя
		echo("
<!doctype html>
<html>
	<head>
		<meta charset=\"UTF-8\">
		<title> Удалить страницы! </title>
		<link href=\"style.css\" rel=\"stylesheet\" type=\"text/css\" />
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
				<p> Удалить страницы </p>
				<table>
					<tr>
						<th> id </th>
						<th> Название </th>
						<th> Заголовок </th>
						<th> Операции </th>
					</tr>");
				
				$SelectPage = getListPage(); // Получаем список страниц из БД
				
					for ($i = 0; $i<count($SelectPage)-1; $i++) 
						{ // Цикл для вывода списка страниц из БД
							 
							$RecPage = $SelectPage[$i]; // В переменную RecPage получаем текущую страницу из БД
							echo("
					<tr>
						<td height=\"103\">". $RecPage["id"] ."</td>
						<td>". $RecPage["Namepage"] ."</td>
						<td>". $RecPage["header"] ."</td>
						<td> <a class=\"EditRec\" href=\"Formdelpage.php?id=". $RecPage["id"]. " \" title=\"Удалить\"> Удалить </a> </tr>"); // Выводим страницу из БД на экран 
						}	
				echo("
				</table>
				
			</div>				
		</section>
		 
		<p id=\"Avtor\"> Данную CMS написал Чермантеев Камиль </p>


	</body>
</html>


		"); // Показываем страницу для редактирование страниц пользователю
	}

?>