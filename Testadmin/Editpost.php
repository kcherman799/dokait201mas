<?php
	// Скрипт для редактирование постов

	session_start(); // Устанавлеваем сессии для текувщей формы
	
	if(isset($_SESSION['User']['id']))
		{ // Если сессия открыта для данного пользователя
		require_once("Myfunctions.php"); // Подключаем наши функции

			echo("
		<!doctype html>
		<html>
			<head>
				<meta charset=\"UTF-8\">
				<title> Редактировать посты! </title>
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
						<a href=\"workpost.php\" class=\"Home\" title=\"Посты\"> Посты </a>
						<a href=\"setadmin.php\" title=\"Настройки админа\"> Настройки админа </a>
					</nav>
				</header>
				
				<section class=\"MainBlock\">
					<div id=\"SubDiv\">
						<p> Редактировать посты </p>
						<table>
							<tr>
								<th> id </th>
								<th> Заголовок поста</th>
								<th> Втупителный текст </th>
								<th> Дата и время </th>
								<th> Операции </th>
							</tr>");
							
							$SelectPost = getRecFromNewsinfodb();
										
							for ($i = 0; $i<count($SelectPost)-1; $i++) 
								{ // Цикл для вывода списка страниц из БД
									 
									$RecPost = $SelectPost[$i]; // В переменную RecPost получаем текущую страницу из БД
									echo("
							<tr>
								<td height=\"103\">". $RecPost["id"] ."</td>
								<td>". $RecPost["Title"] ."</td>
								<td>". $RecPost["Intro_text"] ."</td>
								<td>". $RecPost["Date_time"] ."</td>
								<td> <a class=\"EditRec\" href=\"Formeditpost.php?id=". $RecPost["id"]. " \" title=\"Редактировать\"> Редактировать </a> </tr>"); // Выводим страницу из БД на экран 
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