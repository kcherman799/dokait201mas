<?php
	// Скрипт для Добавление новый страницы

	session_start(); // Устанавлеваем сессии для текувщей формы

	if(isset($_SESSION['User']['id']))
	{ // Если сессия открыта для данного пользователя
?>

<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title> Добавит новую страницу! </title>
		<link href="style.css" rel="stylesheet" type="text/css" />
		<link href="jHtmlArea/jHtmlArea.css" rel="stylesheet" type="text/css" />	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="jHtmlArea/jHtmlArea-0.8.js"></script>
		
		
		<script>
			$(document).ready( function () { 
				$("#TextPage").htmlarea(); // Подключаем текстовый редактор
				
				$("#send").click(function ()
				{ // Функция для обработки добавление новый странички
					$('#messageError').hide(); // Скрываем сообщение об ошибки
					$('#messageError').css("color", "red"); // Меняем цвет у информационного поля
										
					var NamePage = $("#NamePage").val(); // Получаем значение поля Название страницы
					var HeaderPage = $("#HeaderPage").val(); // Получаем значение поля Заголовок страницы
					var TextPage = $("#TextPage").val(); // Получаем значение поля Текст страницы
					
					var Fail = ''; // Переменная для ошибок 
					
					if(NamePage.length < 3)
					{ // Если Название страницы неправильно указано
						Fail = 'Название не меньше 3 символов!';
					}
					else if(HeaderPage.length < 5)
					{ // Если Заголовок страницы неправильно указано
						Fail = 'Заголовок не меньше 5 символов!';
					}
					else if (TextPage.length < 10)
					{ // Если Текст неправильно указано 
						Fail = 'Текст не меньше 10 символов!';
					}
					
					
					if(Fail != "")
					{ // Если в полях есть ошибки
						$('#messageError').html(Fail + "<section class='clear'></section>");
						$('#messageError').show(); // Показываем ошибку пользователю
					}
					else { // Если в полях нет ошибок
							$.ajax({ // Отправка формы на сервер
							url: 'newpageform.php',
							type: 'POST',
							cache: false,
							data: {'namepage': NamePage, 'headerpage': HeaderPage, 'textpage': TextPage},
							dataType: 'html',
							success: function (data) {
									$("#messageError").html(data + "<section class='clear'></section>");
									$("#messageError").show(); // Покаживаем сообщение о состояние сообщение
									
									if (data == "Страница успешно создана!")
									{ // Если страница создалась
										$("#messageError").css("color", "green"); // Меняем цвет у информационного поля
										
										// Очищаем поля формы
										$("#NamePage").val("");
										$("#HeaderPage").val("");
										$("#TextPage").val("");
										$("#TextPage").htmlarea("updateHtmlArea");
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
			
			<form name="Exitadminka" action="Exitadmin.php" method="post">
				<input type="submit" id="End" value="Выход" />
			</form>
			
			<div class="clear"></div>
			<nav id="MainMenu">
				<a href="main.php" title="Главная"> Главная </a>
				<a href="workpage.php" class="Home" title="Работа со страничками"> Работа со страничками </a>
				<a href="workpost.php" title="Посты"> Посты </a>
				<a href="setadmin.php" title="Настройки админа"> Настройки админа </a>
			</nav>
		</header>
		
		<section class="MainBlock">
			<div id="SubDiv">
				<p> Добавить новую страницу </p>
				
				<form name="insertpage" action="newpageform.php" method="post">
					<section id="messageError"> </section>					
					<label> Название страницы: </label>
					<input id="NamePage" name="namepage" type="text" placeholder="Ввидете название страницы" /> <br /> <br />
					<label> Заголовок страницы: </label>
					<input id="HeaderPage" name="headerpage" type="text" placeholder="Ввидете заголовок страницы" /> 					<p id="Text"> Текст страницы: </p>
					<textarea id="TextPage" name="textpage" cols="80" rows="10"></textarea> <br />
					<input type="button" id="send" value="Добавить страницу!" />
				</form>
			</div>				
		</section>
		 
		<p id="Avtor"> Данную CMS написал Чермантеев Камиль </p>


	</body>
</html>

<?php
		// Показываем Добавление новой страницы пользователю
	}
	else {  // Иначи
			echo("Извините, но эта часть сайта Вам недоступна! <br >
			<a href='../index.php'> Назад к сайту </a>"); // Выводим информацию об ошибке и просем пользователя вернутся на главную страницу блога					
		}

?>