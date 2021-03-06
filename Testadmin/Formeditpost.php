<?php
	// Скрипт для измениние поста

	session_start(); // Устанавлеваем сессии для текувщей формы
	
	if(isset($_SESSION['User']['id']))
		{ // Если сессия открыта для данного пользователя

		require_once("Myfunctions.php"); // Подключаем наши функции
	
		$NumbPost = substr($_SERVER['QUERY_STRING'], 3); // Получаем номер поста со адресной строки
		$NumbPost *=1; // Певращаем номер поста в числу
	
		$Post= getArticleFromNewsinfodb($NumbPost); // Получаем один пост по его номеру
?>
		
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title> Изменить пост! </title>
		<link href="style.css" rel="stylesheet" type="text/css" />
		<link href="jHtmlArea/jHtmlArea.css" rel="stylesheet" type="text/css" />	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="jHtmlArea/jHtmlArea-0.8.js"></script>
		
		<script>
			$(document).ready(function () { 
				$("#TextPost").htmlarea(); // Подключаем текстовый редактор
				
				$("#send").click(function ()
				{ // Функция для обработки добавление новый странички
					$('#messageError').hide(); // Скрываем сообщение об ошибки
					$('#messageError').css("color", "red"); // Меняем цвет у информационного поля
					
								
					var NamePost = $("#NamePost").val(); // Получаем значение поля Заголовок поста
					var MiniText = $("#MiniText").val(); // Получаем значение поля Вводного текста поста
					var TextPost = $("#TextPost").val(); // Получаем значение поля Основного текста поста
					var ImagPost = $('#ImagPost').prop('files')[0]; // Получаем значение поля картинка как нулевой элемент массива
					// метод prop() задает, или возвращает значения свойств выбранных элементов.
					var Fail = ''; // Переменная для ошибок 
					
					if(NamePost.length < 3)
					{ // Если Название поста неправильно указано
						Fail = 'Заголовок не меньше 3 символов!';
					}
					else if (MiniText.length < 7 && MiniText.length > 20)
					{ // Если Вводный текст неправильно указано 
						Fail = 'Вводный текст от 7 до 20 символов!';
					}					
					else if (TextPost.length < 20)
					{ // Если Основной текст неправильно указано 
						Fail = 'Основной текст не меньше 20 символов!';
					}	
					
					if(Fail != '')
					{ // Если в полях есть ошибки
						$('#messageError').html(Fail + "<section class='clear'></section>");
						$('#messageError').show(); // Показываем ошибку пользователю
					}
					else 
					{ // Если в полях нет ошибок													
						var form_data = new FormData(); // Создаем новый объект для хранения файлов получинных с формой
						form_data.append('namepost', NamePost); // Добавляем заголовок поста в наш объект
						form_data.append('minitext', MiniText); // Добавляем вводный текст в наш объект
						form_data.append('textpost', TextPost); // Добавляем основной текст в наш объект
						form_data.append('Id', <?=$NumbPost?>); // Добавляем id поста в наш объект
						form_data.append('file', ImagPost); // Добавляем загрузанную картинку в наш объект
									    
					    $.ajax({ // Отправка формы на сервер
								url: 'editpostform.php',
								type: 'POST',
								cache: false,
								contentType: false,
								processData: false,
								data: form_data,
								dataType: 'text',
								success: function (data) {
										$("#messageError").html(data + "<section class='clear'></section>");
										$('#messageError').show(); // Покаживаем сообщение о состояние сообщение
										
										if (data == "Пост успешно изменен!")
										{ // Если страница создалась
											$('#messageError').css("color", "green"); // Меняем цвет у информационного поля 		
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
				<a href="workpage.php" title="Работа со страничками"> Работа со страничками </a>
				<a href="workpost.php" class="Home" title="Посты"> Посты </a>
				<a href="setadmin.php" title="Настройки админа"> Настройки админа </a>
			</nav>
		</header>
		
		<section class="MainBlock">
			<div id="SubDiv">
				<p> Изменить пост </p>
				
				<form name="insertpost" action="testimg.php" enctype="multipart/form-data" method="post">
				<section id="messageError"> </section>	
					<label> Заголовок поста: </label>
					<input type="text" id="NamePost" name="namepost" value="<?=$Post["Title"]?>" placeholder="Ввидете заголовок поста" /> <br /><br />
					<label> Вводный текст поста: </label>
					<input type="text" id="MiniText" name="minitext" value="<?=$Post["Intro_text"]?>" placeholder="Ввидете вводный текст поста" /> <br />
					<p id="Text"> Основного текста поста: </p>
					
					<textarea cols="80" rows="10" id="TextPost" name="textpost"> <?=$Post["Full_text"]?> </textarea> <br /> <br />
					<label> Картинка поста: </label>
					<input type="file" id="ImagPost"  value="<?=$Post["imag"]?>" name="imagpost" /> <br />
					<input type="button" id="send" value="Изменить пост!" />
				</form>
			</div>				
		</section>
		 
		<p id="Avtor"> Данную CMS написал Чермантеев Камиль </p>


	</body>
</html>

<?php
		// Показываем Добавление новой постов пользователю
	}
	else {  // Иначи
			echo("Извините, но эта часть сайта Вам недоступна! <br >
			<a href='../index.php'> Назад к сайту </a>"); // Выводим информацию об ошибке и просем пользователя вернутся на главную страницу блога					
		}

?>