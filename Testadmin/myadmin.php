<?php

	require_once("Myfunctions.php"); // Подключаем наши функции

 ?>

<!doctype html>
	<html>
	<head>
		<meta charset="utf-8" />
		<title> Вход в админ панель MyBlog! </title>
		<link rel="stylesheet" href="styleadmin.css" type="text/css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script>
			$(document).ready( function (){ 
				$("#mybutton").click(function ()
					{ // Форма для входа в админ панель
						var login = $("#Mylogin").val(); // Получаем логин пользователя
						var password = $("#Mypassword").val(); // Получаем пароль пользователя
						var rememble = $("#rememble").val(); // Получаем чексбок				
						var error = ''; // Переменная для храниние ошибок 
						
						if(login == "")
						{ // Если пользователь не ввел логин
							error = 'Введите пожалуйста логин!'; // Записываем информацию об ошибки
						}
						else if(password == "")
						{ // Если пользователь не ввел пароль
							error = 'Введите пожалуйста пароль!'; // Записываем информацию об ошибки
						}
						
						if(error != "")
						{ // Если в полях есть ошибки
							$('#messageError').html(error + "<section class='clear'></section>"); // Записываем информацию в блок для ошибок
							$('#messageError').show(); // Показываем сообщение об ошибке
						}
						else { // Если в полях нет ошибок
								$.ajax({ // Отправка формы на сервер
								url: 'consoleadmint.php',
								type: 'POST',
								cache: false,
								data: {'Mylogin': login, 'Mypassword': password, 'rememble': rememble},
								dataType: 'html',
								success: function (data) {									
										if (data == "Извините, Вы вели не правильно логин или пароль!")
										{ // Если пользователь указал не правильно логин или пароль
											$('#messageError').html(data + "<section class='clear'></section>");
											$('#messageError').show(); // Покаживаем сообщение о состояние сообщение
										}
										else { // Иначе
											window.location.href = "main.php"; // Открываем админку
										}
									}
								});
							}
				
				
				
					});
			});
			
			
		</script>
	</head>
	
	<body>
		<section id="Page">
			<section class="mainBlock">
				<img src="logo.png" />
				<h1> Вход в админ панель </h1>
				<div class="adminBlock">
					<form name="formadmin" action="consoleadmint.php" method="post">
						<section id="messageError" style="color: red; font-size: 20px;"> </section>
						<label> Логин или email: </label> <br />
						<input type="text" name="Mylogin" id="Mylogin" class="inpunData" value="<?=@$_COOKIE['UserLogin']?>" /> <br /> <br /> 
						<label id="label"> Пароль: </label> <br />
						<input type="password" name="Mypassword" id="Mypassword" value="<?=@$_COOKIE['UserPass']?>" class="inpunData" /> <br /><br />
						<input type="checkbox" checked="checked" name="rememble" id="rememble" /> Запомнить меня
						<input type="button" name="done" id="mybutton"  value="Войти" /> 
					</form>
				</div>
					
				<a href="recoverpass.php"> Забыли пароль? </a>
				<a href="../index.php"> Назад к сайту </a>
				
			</section>
		</section>
	</body>
	</html>

