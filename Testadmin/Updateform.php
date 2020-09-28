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
					<title> Изменить статей в БД </title>
				</head>
				
				<body>
					<form name=\"inputarticledb\" action=\"formupdatecarticle.php\" method=\"post\">
						<p align=\"center\"> Изменить статью в блог! </p>
						<label for=\"Number\"> Номер статьи </label>
						<input type=\"text\" name=\"Number\" /> <br /> <br />
						<label for=\"title\"> Заголовок статьи </label>
						<input type=\"text\" name=\"title\" /> <br /> <br />
						<label for=\"Intro_text\"> Вводная статья </label>
						<input type=\"text\" name=\"Intro_text\" /> <br /> <br />
						<label for=\"Full_text\"> Полная статья </label>
						<input type=\"text\" name=\"Full_text\" /> <br /> <br />
						<label for=\"img\"> Загружить картинку </label>
						<input type=\"image\" name=\"img\" /> <br /> <br />
						<input type=\"submit\" value=\"Добавить новую статью\" />
					</form>
				</body>
			</html>
			");
		}
?>