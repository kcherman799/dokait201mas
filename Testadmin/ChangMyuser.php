<?php
	// Скрипт для смени данных своей учетной записей

	session_start(); // Устанавлеваем сессии для текувщей формы

	if(isset($_SESSION['User']['id']))
	{ // Если сессия открыта для данного пользователя
		require_once("Myfunctions.php"); // Подключаем наши функции
		
		$MyUser = getRecUser($_SESSION['User']['id']); // Получаем данные текущего пользователя
		
		
?>

<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title> Сменить данные своей учетной записи! </title>
		<link href="style.css" rel="stylesheet" type="text/css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>		
		
		<script>
			$(document).ready( function () {
				
				$("#send").click(function ()
				{ // Функция для обработки смени пароляот учетной записы
					$('#messageError').hide(); // Скрываем сообщение об ошибки
					$('#messageError').css("color", "red"); // Меняем цвет у информационного поля
										
					var Pass = $("#Pass").val(); // Получаем значение поля Пароль
					var Repass = $("#Repass").val(); // Получаем значение поля Повтор пароля
					var Email = $("#Email").val(); // Получаем значение поля Email
					
					var Fail = ''; // Переменная для ошибок 
					
					if (Pass.length < 5)
					{ // Если текущей пароль неправильно указано 
						Fail = 'Пароль не меньше 5 символов!';
					}					
					else if (Pass != Repass)
					{ // Если пароли не совпадают
						Fail = 'Пароли не совпадают!';
					}
					else if (Email.split('@').length-1 ==0 || Email.split('.').length-1 == 0)
					{ // Если Email неправильно указан 
						Fail = 'Вы ввели некорректный Email!';
					}
					
					if(Fail != "")
					{ // Если в полях есть ошибки
						$('#messageError').html(Fail + "<section class='clear'></section>");
						$('#messageError').show(); // Показываем ошибку пользователю
					}
					else { // Если в полях нет ошибок
							$.ajax({ // Отправка формы на сервер
							url: 'EditMyUser.php',
							type: 'POST',
							cache: false,
							data: {'pass': Pass, 'email': Email},
							dataType: 'html',
							success: function (data) {
									$('#messageError').html(data + "<section class='clear'></section>");
									$('#messageError').show(); // Показываем сообщение о состояние сообщение
									
									if (data == "Данные успешно изменились!")
									{ // Если пользователь создался
										$("#messageError").css("color", "green"); // Меняем цвет у информационного поля
										
										// Очищаем поля формы 
									    $("#Pass").val("");
 									    $("#Repass").val("");
									    $("#Email").val("");
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
				<p style="margin-left: -40px;"> Сменить данные своей учетной записи. </p>
				
				<form name="changMyuser" action="EditMyUser.php" method="post">
				<section id="messageError"> </section>	
					<label> Пароль: </label>
					<input id="Pass" type="password" /> <br /> <br />
					<label> Введите еще раз пароль: </label>
					<input  id="Repass" type="password" /> <br /> <br />
					<label> Email: </label>
					<input  id="Email" type="text" value="<?=$MyUser['Email']?>" /> <br /> <br />
					<input type="button" id="send" value="Сменить данные!" />					
			</div>				
		</section>
		 
		<p id="Avtor"> Данную CMS написал Чермантеев Камиль </p>


	</body>
</html>

<?php
		// Показываем Сменить пароль от учетной записы пользователю
	}
	else {  // Иначи
			echo("Извините, но эта часть сайта Вам недоступна! <br >
			<a href='../index.php'> Назад к сайту </a>"); // Выводим информацию об ошибке и просем пользователя вернутся на главную страницу блога					
		}

?>