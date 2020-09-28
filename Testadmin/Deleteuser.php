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
					<title> Удаление пользователей из блога! </title>
				</head>
				
				<body>
					<form name=\"inputarticledb\" action=\"formdeleteuser.php\" method=\"post\">
						<p align=\"center\"> Удаление пользователей из блога! </p>
						<label for=\"Number\"> Номер статьи </label>
						<input type=\"text\" name=\"a\" /> <br /> <br />
						<input type=\"submit\" value=\"Удалить пользователя\" />
					</form>
				</body>
			</html>
			");
		}
?>