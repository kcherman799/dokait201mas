<?php
	// Скрипт для посмотра списка заявок от абитурентов

	session_start(); // Устанавлеваем сессии для текувщей формы

	require_once("Myfunctions.php"); // Подключаем наши функции


	if(isset($_SESSION['User']['id']) && $_SESSION['User']["role"] == "Admin")
	{ // Если сессия открыта для данного пользователя
		echo("
<!doctype html>
<html>
	<head>
		<meta charset=\"UTF-8\">
		<title> Заявки от абитурентов! </title>
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

		<section class=\"MainBlock width\">
			<div id=\"SubDiv\">
				<p> Заявки от абитуриентов </p>
				<table>
					<tr>
						<th> id </th>
						<th> ФИО </th>
						<th> Дата приезда </th>
						<th> Телефон </th>
						<th> E-mail </th>
						<th> Операции </th>
					</tr>");

				$SelectEnroll = getListEnroll(); // Получаем список заявок от абитурентов из БД
				
					for ($i = 0; $i<count($SelectEnroll)-1; $i++)
						{ // Цикл для вывода списка заявок от абитурентов из БД

							$RecEnroll = $SelectEnroll[$i]; // В переменную RecEnroll получаем текущую страницу из БД
							echo("
					<tr>
						<td height=\"103\">". $RecEnroll["id"] ."</td>
						<td>". $RecEnroll["Famile"] ." ". $RecEnroll["Name"] ." ". $RecEnroll["Patron"] ."</td>
						<td>". $RecEnroll["Date"] ." в ". $RecEnroll["Time"]."</td>
						<td>". $RecEnroll["Phone"] ."</td>
						<td>". $RecEnroll["Email"] ."</td>
						<td> <a class=\"EditRec\" href=\"Formeditenroll.php?id=". $RecEnroll["id"]. " \" title=\"Посмотреть детали\"> Посмотреть детали </a> </tr>"); // Выводим список заявок от абитурентов из БД на экран
						}
				echo("
				</table>

			</div>
		</section>

		<p id=\"Avtor\"> Данную CMS написал Чермантеев Камиль </p>


	</body>
</html>


		"); // Показываем страницу для список заявок от абитурентов пользователю
	}

?>
