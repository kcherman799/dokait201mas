<?php
	// Скрипт для Редактирование пользователя блога

	session_start(); // Устанавлеваем сессии для текувщей формы
	
	if(isset($_SESSION['User']['id']) && $_SESSION['User']["role"] == "Admin")
	{ // Если сессия открыта для данного пользователя
		
		require_once("Myfunctions.php"); // Подключаем наши функции
		
		
		$UserNumb = substr($_SERVER['QUERY_STRING'], 3); // Получаем номер страницы со адресной строки
		$UserNumb *=1; // Певращаем номер страницы в числу
		
		$MyUser = getRecUser($UserNumb); // Получаем одого пользователя из БД
	?>

<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title> Редактировать пользователя! </title>
		<link href="style.css" rel="stylesheet" type="text/css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		
		
		<script>
			$(document).ready( function () { 
				
				$("select[name='Role']").val("<?=$MyUser['Role']?>"); // Устанавлеваем роль пользователя
				
				$("#send").click(function ()
				{ // Функция для обработки добавление новый странички
					$('#messageError').hide(); // Скрываем сообщение об ошибки
					$('#messageError').css("color", "red"); // Меняем цвет у информационного поля
										
					var LoginUser = $("#NameUser").val(); // Получаем значение поля Логин
					var Email = $("#Email").val(); // Получаем значение поля Email
					var Role = $("select[name='Role']").val(); // Получаем значение поля Роль
					
					var Fail = ''; // Переменная для ошибок 
					
					if (LoginUser.length < 7)
					{ // Если имя пользователя неправильно указано 
						Fail = 'Логин не меньше 7 символов!';
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
							url: 'Edituserform.php',
							type: 'POST',
							cache: false,
							data: {'id': <?=$MyUser['id']?>, 'loginuser': LoginUser, 'email': Email, 'role': Role},
							dataType: 'html',
							success: function (data) {
									$("#messageError").html(data + "<section class='clear'></section>");
									$("#messageError").show(); // Покаживаем сообщение о состояние сообщение
									
									if (data == "Пользователь успешно обновлен")
									{ // Если пользователь создался
										$("#messageError").css("color", "green"); // Меняем цвет у информационного поля
										
										// Очищаем поля формы
										$("#NameUser").val("");
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
				<p> Редактировать пользователя </p>
				
				<form name="Updateuser" action="Edituserform.php" method="post">
					<section id="messageError"> </section>					
					<label> Логин: </label>
					<input id="NameUser" name="nameuser" type="text" placeholder="Ввидете имя пользователя" value="<?=$MyUser['Login']?>" /> <br /> <br />					
					<label> Email: </label>
					<input id="Email" type="text" value="<?=$MyUser['Email']?>" /> <br /> <br />
					<label> Роль: </label>
					<select name="Role">
						<option value="" selected="selected"> </option>
						<option value="Admin"> Админ </option>
						<option value="Redactor"> Редактор </option>
					</select> <br /> <br />
					<input type="button" id="send" value="Изменить пользователя!" />
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