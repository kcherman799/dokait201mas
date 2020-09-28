<!doctype html>
	<html>
	<head>
		<meta charset="utf-8" />
		<title> Восстановления пароля для админа MyBlog! </title>
		<link rel="stylesheet" href="styleadmin.css" type="text/css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script>
			$(document).ready( function (){ 
				$("#mybutton").click(function ()
					{ // Форма для восстановление пароля
						var email = $("#Myemail").val(); // Получаем email пользователя
									
						var error = ''; // Переменная для храниние ошибок 
						
						if (email.split('@').length-1 == 0 || email.split('.').length-1 == 0)
						{ // Если Email неправильно указан 
							error = 'Вы ввели некорректный Email!';
						}	
									
						if(error != "")
						{ // Если в полях есть ошибки
							$('#messageError').html(error + "<section class='clear'></section>"); // Записываем информацию в блок для ошибок
							$('#messageError').show(); // Показываем сообщение об ошибке
						}
						else { // Если в полях нет ошибок
								$.ajax({ // Отправка формы на сервер
								url: 'recovpass.php',
								type: 'POST',
								cache: false,
								data: {'Myemail': email},
								dataType: 'html',
								success: function (data) {									
										if (data == "Пользователь с таким email не найден!")
										{ // Если пользователь указал не правильно логин или пароль
											$('#messageError').html(data + "<section class='clear'></section>");
											$('#messageError').show(); // Покаживаем сообщение о состояние сообщение
										}
										else { // Иначе
											window.location.href = "newpass.php";
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
				<h1> Восстановление пароля для админа </h1>
				<div class="adminBlock">
					<form name="formadmin" action="consoleadmint.php" method="post">
						<section id="messageError" style="color: red; font-size: 20px;"> </section>
						
						<section id="messag" style="color:#52b52f; font-size: 20px;">
								Пожалуйста, введите ваш e-mail. Вы получите письмо со ссылкой для создания нового пароля.
						</section> <br />
												
						<label> Email: </label> <br />
						<input type="text" name="Myemail" value="Hom@mail.ru" id="Myemail" class="inpunData" /> <br /> <br />
						 
						<input type="button" name="done" id="mybutton"  value="Получить новый пароль!" /> 
					</form>
				</div>
					
				<a href="myadmin.php"> Войти </a>
				<a href="../index.php"> Назад к сайту </a>
				
			</section>
		</section>
	</body>
	</html>
