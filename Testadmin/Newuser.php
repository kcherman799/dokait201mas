<?php
	// Скрипт для Добавление нового пользователя

	session_start(); // Устанавлеваем сессии для текувщей формы

	if(isset($_SESSION['User']['id']) && $_SESSION['User']["role"] == "Admin")
	{ // Если сессия открыта для данного пользователя
?>

<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title> Добавить нового пользователя! </title>
		<link href="style.css" rel="stylesheet" type="text/css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		
		
		<script>
			$(document).ready( function () { 
				
				$("#send").click(function ()
				{ // Функция для обработки добавление новый странички
					$('#messageError').hide(); // Скрываем сообщение об ошибки
					$('#messageError').css("color", "red"); // Меняем цвет у информационного поля
										
					var NameUser = $("#NameUser").val(); // Получаем значение поля Пользователь
					var Pass = $("#Pass").val(); // Получаем значение поля Пароль
					var Repass = $("#Repass").val(); // Получаем значение поля Повтор пароля
					var Email = $("#Email").val(); // Получаем значение поля Email
					var Role = $("select[name='Role']").val(); // Получаем значение поля Роль
					
					var Fail = ''; // Переменная для ошибок 
					
					if (NameUser.length < 7)
					{ // Если логин пользователя неправильно указано 
						Fail = 'Логин пользователя не меньше 7 символов!';
					}
					else if (Pass.length < 5)
					{ // Если текущей пароль неправильно указано 
						Fail = 'Пароль не меньше 5 символов!';
					}					
					else if (Pass !== Repass)
					{ // Если пароли не совпадают
						Fail = 'Пароли не совпадают!';
					}
					else if (Email.split('@').length-1 ==0 || Email.split('.').length-1 == 0)
					{ // Если Email неправильно указан 
						Fail = 'Вы ввели некорректный Email!';
					}
					else if (!Role)
					{ // Если роль пользователя не указана
						Fail = 'Укажите роль пользователя!';
					}					
					
					if(Fail != "")
					{ // Если в полях есть ошибки
						$('#messageError').html(Fail + "<section class='clear'></section>");
						$('#messageError').show(); // Показываем ошибку пользователю
					}
					else { // Если в полях нет ошибок
							$.ajax({ // Отправка формы на сервер
							url: 'Newuserform.php',
							type: 'POST',
							cache: false,
							data: {'newlogin': NameUser, 'pass': Pass, 'email': Email, 'role': Role},
							dataType: 'html',
							success: function (data) {
									$("#messageError").html(data + "<section class='clear'></section>");
									$("#messageError").show(); // Покаживаем сообщение о состояние сообщение
									
									if (data == "Пользователь успешно создан!")
									{ // Если пользователь создался
										$("#messageError").css("color", "green"); // Меняем цвет у информационного поля
										
										// Очищаем поля формы
										$("#NameUser").val("");
										$("#Pass").val("");
										$("#RePass").val("");
										$("#Email").val("");
										$("select[name='Role']").val("");
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
				<p> Добавить нового пользователя </p>
				
				<form name="insertuser" action="Newuserform.php" method="post">
					<section id="messageError"> </section>					
					<label> Логин: </label>
					<input id="NameUser" name="nameuser" type="text" placeholder="Ввидете логин пользователя" /> <br /> <br />					
					<label> Пароль: </label>
					<input id="Pass" type="password" /> <br /> <br />
					<label> Введите еще раз пароль: </label>
					<input  id="Repass" type="password" /> <br /> <br />					
					<label> Email: </label>
					<input id="Email" type="text" /> <br /> <br />
					<label> Роль: </label>
					<select name="Role">
						<option value="" selected="selected"> </option>
						<option value="Admin"> Админ </option>
						<option value="Redactor"> Редактор </option>
					</select> <br /> <br />
					<input type="button" id="send" value="Добавить пользователя!" />
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
