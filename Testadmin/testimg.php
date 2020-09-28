<?php
	// Скрипт для измениние поста

	session_start(); // Устанавлеваем сессии для текувщей формы
	
	require_once("Myfunctions.php"); // Подключаем наши функции

	$NumbPost = substr($_SERVER['QUERY_STRING'], 3); // Получаем номер поста со адресной строки
	$NumbPost *=1; // Певращаем номер поста в числу

	
	$mySQLarray = getArticleFromNewsinfodb($NumbPost); // Получаем один пост по его номеру
	
	for ($i = 0; $i<count($mySQLarray); $i++) 
		{ // Цикл для получение одной страницы из БД
			$Post = $mySQLarray[$i]; // В переменную Post записываем текущый пост из БД					
		}

	if(isset($_SESSION["id"]))
	{ // Если сессия открыта для данного пользователя
		echo("
<!doctype html>
<html>
	<head>
		<meta charset=\"UTF-8\">
		<title> Изменить пост! </title>
		<link href=\"style.css\" rel=\"stylesheet\" type=\"text/css\" />
		<link href=\"jHtmlArea/jHtmlArea.css\" rel=\"stylesheet\" type=\"text/css\" />	
		<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js\"></script>
		<script src=\"jHtmlArea/jHtmlArea-0.8.js\"></script>
		
		
		<script>
			$(document).ready( function () { 
				$(\"#TextPost\").htmlarea(); // Подключаем текстовый редактор
				
				$(\"#send\").click(function ()
				{ // Функция для обработки изменение поста
					$('#messageError').hide(); // Скрываем сообщение об ошибки
					$('#messageError').css(\"color\", \"#cf720e\");
										
					var NamePost = $(\"#NamePost\").val(); // Получаем значение поля Название поста
					var MiniText = $(\"#MiniText\").val(); // Получаем значение поля Вводного текста поста
					var TextPost = $(\"#TextPost\").val(); // Получаем значение поля Основного текста поста
					//var ImagPost = $(\"#ImagPost\").val(); // Получаем значение поля картинка				
					var Fail = ''; // Переменная для ошибок 
					
					if(NamePost.length < 3)
					{ // Если Название поста неправильно указано
						Fail = 'Название не меньше 3 символов!';
					}
					else if (MiniText.length < 10)
					{ // Если Вводный текст неправильно указано 
						Fail = 'Текст не меньше 10 символов!';
					}
					else if (TextPost.length < 20)
					{ // Если Основной текст неправильно указано 
						Fail = 'Текст не меньше 20 символов!';
					}
					/*else if (!ImagPost)
					{ // Если картинка не загрузана 
						Fail = 'Загрузите киртинку!';
					}*/
					
					
					if(Fail != \"\")
					{ // Если в полях есть ошибки
						$('#messageError').html(Fail + \"<section class='clear'></section>\");
						$('#messageError').show(); // Показываем ошибку пользователю
					}
					else { // Если в полях нет ошибок
							$.ajax({ // Отправка формы на сервер
							url: 'editpostform.php',
							type: 'POST',
							cache: false,
							data: {'Id':". $NumbPost .", 'namepost': NamePost, 'minitext': MiniText, 'textpost': TextPost},
							dataType: 'html',
							success: function (data) {
									$('#messageError').html(data + \"<section class='clear'></section>\");
									$('#messageError').show(); // Покаживаем сообщение о состояние сообщение
									//alert(data);
									
									if (data == \"Пост успешно изменен!\")
									{ // Если страница создалась
										$('#messageError').css(\"color\", \"green\"); // Меняем цвет у информационного поля 										
									}
								}
						    });
						}
				
				
				});
			});	
		</script>
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
				<p> Измениния поста </p>
				
				<form name=\"insertpost\" action=\"editpostform.php\" method=\"post\">
				<section id=\"messageError\"> </section>	
					<label> Заголовок поста: </label>
					<input type=\"text\" id=\"NamePost\" name=\"namepost\" value=\"". $Post["Title"]. "\" /> <br /><br />
					<label> Вводный текст поста: </label>
					<input type=\"text\" id=\"MiniText\" name=\"minitext\" value=\"". $Post["Intro_text"]. "\" /> <br />
					<p id=\"Text\"> Основного текста поста: </p>
					
					<textarea cols=\"80\" rows=\"10\" id=\"TextPost\" name=\"textpost\">". $Post["Full_text"]. "</textarea> <br /> <br />
					<label> Картинка поста: </label>
					<input type=\"file\" id=\"ImagPost\" name=\"imagpost\" /> <br />
					<input type=\"button\" id=\"send\" value=\"Изменить пост!\" />
				</form>
			</div>				
		</section>
		 
		<p id=\"Avtor\"> Данную CMS написал Чермантеев Камиль </p>


	</body>
</html>


		"); // Покаживаем админ панель пользователю
	}
	

?>
