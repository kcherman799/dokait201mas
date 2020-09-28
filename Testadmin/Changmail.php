<?php
	// Скрипт для Добавление новый страницы

	session_start(); // Устанавлеваем сессии для текувщей формы

	if(isset($_SESSION["id"]))
	{ // Если сессия открыта для данного пользователя
?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title> Сменить почту! </title>
		<link href="style.css" rel="stylesheet" type="text/css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>		
		
		<script>
			$(document).ready( function () { 
				//$("#TextPage").htmlarea();
				
				$("#send").click(function ()
				{ // Функция для обработки добавление новый странички
					$('#messageError').hide(); // Скрываем сообщение об ошибки
					$('#messageError').css("color", "red"); // Меняем цвет у информационного поля
										
					var Oldmail = $("#Oldmail").val(); // Получаем значение поля Старая почта
					var Newmail = $("#Newmail").val(); // Получаем значение поля Новая почта
					var Pass = $("#Pass").val(); // Получаем значение поля Проверка пароля
					
					var Fail = ''; // Переменная для ошибок 
					
					if (Oldmail.split('@').length-1 ==0 || Oldmail.split('.').length-1 == 0)
					{ // Если Email неправильно указан 
						Fail = 'Вы ввели некорректный Email старый почты!';
					}
					else if (Newmail.split('@').length-1 ==0 || Newmail.split('.').length-1 == 0)
					{ // Если Email неправильно указан 
						Fail = 'Вы ввели некорректный Email новый почты!';
					}
					else if (Pass.length < 5)
					{ // Если пароль неправильно указано 
						Fail = 'Пароль не меньше 5 символов!';
					}
					
					
					if(Fail != "")
					{ // Если в полях есть ошибки
						$('#messageError').html(Fail + "<section class='clear'></section>");
						$('#messageError').show(); // Показываем ошибку пользователю
					}
					else { // Если в полях нет ошибок
							$.ajax({ // Отправка формы на сервер
							url: 'Editmail.php',
							type: 'POST',
							cache: false,
							data: {'Oldmail': Oldmail, 'Newmail': Newmail, 'Pass': Pass},
							dataType: 'html',
							success: function (data) {
									$('#messageError').html(data + "<section class='clear'></section>");
									$('#messageError').show(); // Показываем сообщение о состояние сообщение
									//alert(data);
									
									if (data == "Почта админа успешно сменилась!")
									{ // Если страница создалась
										$("#messageError").css("color", "green"); // Меняем цвет у информационного поля
										
										// Очищаем поля формы 
									    $("#Oldmail").val()="";
									    $("#Newmail").val()="";
 									    ("#Pass").val()="";
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
				<a href="workpost.php" title="Посты"> Посты </a>
				<a href="setadmin.php" class="Home" title="Настройки админа"> Настройки админа </a>
			</nav>
		</header>
		
		<section class="MainBlock">
			<div id="SubDiv">
				<p style="margin-left: -40px;"> Сменить почту, для получение формы от абитуриентов </p>
				
				<form name="changmail" action="#" method="post">
				<section id="messageError"> </section>	
					<label> Старая почта: </label>
					<input id="Oldmail" type="email" values="kchermanteev2015@gmail.com" placeholder="Ввидете старую почту" /> <br /> <br />
					<label> Новая почта: </label>
					<input id="Newmail" type="email" placeholder="Ввидете новую почту" /> <br /> <br />
					<label> Введите еще раз пароль от админки: </label>
					<input  id="Pass" type="password" /> <br /> <br />
					<input type="button" id="send" value="Сменить почту!" />					
			</div>				
		</section>
		 
		<p id="Avtor"> Данную CMS написал Чермантеев Камиль </p>


	</body>
</html>
<?php
		// Показываем Смену пароля пользователю
	}
	else {  // Иначи
			echo("Извините, но эта часть сайта Вам недоступна! <br >
			<a href='../index.php'> Назад к сайту </a>"); // Выводим информацию об ошибке и просем пользователя вернутся на главную страницу блога					
		}

?>