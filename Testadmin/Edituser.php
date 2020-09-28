<?php
	// Скрипт для редактирование пользователя

	session_start(); // Устанавлеваем сессии для текувщей формы
	if(isset($_SESSION['User']['id']) && $_SESSION['User']["role"] == "Admin")
	{ // Если сессия открыта для данного пользователя
		require_once("Myfunctions.php"); // Подключаем наши функции	
		echo("
<!doctype html>
<html>
	<head>
		<meta charset=\"UTF-8\">
		<title> Редактировать пользователей! </title>
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
				<a href=\"workpage.php\" title=\"Работа со страничками\"> Работа со страничками </a>
				<a href=\"workpost.php\" title=\"Посты\"> Посты </a>
				<a href=\"setadmin.php\" class=\"Home\" title=\"Настройки админа\"> Настройки админа </a>
			</nav>
		</header>
		
		<section class=\"MainBlock\">
			<div id=\"SubDiv\">
				<p> Редактировать пользователей </p>
				<table>
					<tr>
						<th> id </th>
						<th> Логин </th>
						<th> Email </th>
						<th> Роль </th>
						<th> Операции </th>
					</tr>");
				
				$id = $_SESSION['User']['id']; // Получаем id текущего пользоваталя
				$EditUser = getNoMyUser($id); // Получаем список пользователь из БД, кроме текущего
				
				for ($i = 0; $i<count($EditUser)-1; $i++) 
						{ // Цикл для вывода списка пользователя из БД
							 
							$RecUser = $EditUser[$i]; // // В переменную RecUser получаем текущего пользователя из БД
							echo("
					<tr>
						<td height=\"103\">". $RecUser["id"] ."</td>
						<td>". $RecUser["Login"] ."</td>
						<td>". $RecUser["Email"] ."</td>
						<td>". $RecUser["Role"] ."</td>
						<td> <a class=\"EditRec\" href=\"Formedituser.php?id=". $RecUser["id"]. " \" title=\"Редактировать\"> Редактировать </a> </tr>"); // Выводим пользователей из БД на экран 
						}	
				echo("
				</table>
				
			</div>				
		</section>
		 
		<p id=\"Avtor\"> Данную CMS написал Чермантеев Камиль </p>


	</body>
</html>


		"); // Показываем страницу для редактирование пользователей пользователю
	}

?> 