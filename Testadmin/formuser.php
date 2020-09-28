<?php
	// Скрипт для входа в админ панель

	session_start(); // Устанавлеваем сессии для текувщей формы

	if(isset($_SESSION["id"]))
	{ // Если сессия открыта для данного пользователя
		echo("
			<!doctype html>
				<html lang=\"ru\">
				<head>
					<meta http-equiv=\"Content-Type\" content=\"text/html\" charset=\"utf-8\" />
					<title> Добавление новых пользователей на сайт </title>
				</head>
				
				<body>
					<form name=\"inputarticledb\" action=\"forminputeuser.php\" method=\"post\">
						<p align=\"center\"> Добавление новых пользователей на сайт! </p>
						<label for=\"login\"> Логин </label>
						<input type=\"text\" name=\"login\" /> <br /> <br />
						<label for=\"Password\"> Пароль </label>
						<input type=\"Password\" name=\"Password\" /> <br /> <br />
						<input type=\"submit\" value=\"Добавить нового пользователя\" />
					</form>
				</body>
			</html>
			");
		}
?>