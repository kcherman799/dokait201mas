<!doctype html>
	<html>
	<head>
		<meta charset="utf-8" />
		<title> Создание нового пароля для админа MyBlog! </title>
		<link rel="stylesheet" href="styleadmin.css" type="text/css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script>
			$(document).ready( function (){ 
				$("#mybutton").click(function ()
					{ // Форма для восстановление пароля
						$('#messageError').hide(); // Скрываем сообщение об ошибки
						$('#messageError').css("color", "#cf720e");

						var KeyConfirm = $("#KeyConfirm").val(); // Получаем значение поля Код подтведение
						var Newpass = $("#Newpass").val(); // Получаем значение поля Новыый пароль
						var Repass = $("#Repass").val(); // Получаем значение поля Проверка пароля

						var Fail = ''; // Переменная для ошибок 

						if (KeyConfirm.length < 5)
						{ // Если код подтведение неправильно указано 
							Fail = 'Код подтведение не меньше 7 символов!';
						}					
						else if (Newpass.length < 5)
						{ // Если новый пароль неправильно указано 
							Fail = 'Новый пароль не меньше 5 символов!';
						}
						else if (Newpass !== Repass)
						{ // Если пароли не совпадают
							Fail = 'Пароли не совпадают!';
						}


						if(Fail != "")
						{ // Если в полях есть ошибки
							$('#messageError').html(Fail + "<section class='clear'></section>");
							$('#messageError').show(); // Показываем ошибку пользователю
						}
						else { // Если в полях нет ошибок
								$.ajax({ // Отправка формы на сервер
								url: 'Createpass.php',
								type: 'POST',
								cache: false,
								data: {'Newpass': Newpass, 'KeyConfirm': KeyConfirm},
								dataType: 'html',
								success: function (data) {									
										if (data == "Неверный код подтвердение!" || data == "Пароль не сменился!" )
										{ // Если пользователь указал не правильно код подтвердение
											
											
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
				<h1> Создание нового пароля для админа </h1>
				<div class="adminBlock">
					<form name="formadmin" action="Createpass.php" method="post">
						<section id="messageError" style="color: red; font-size: 20px;"> </section>
						
						<section id="messag" style="color:#52b52f; font-size: 20px;">
								Пожалуйста, укажите ваш новый пароль.
						</section> <br />
									
						<label> Новый пароль: </label>
						<input id="Newpass" name="Newpass" value="" type="password" placeholder="Введете новый пароль" /> <br /> <br />
						<label> Введите еще раз свой новый пароль: </label>
						<input  id="Repass" value="" type="password" /> <br /> <br />	
								
						<label> Код подтведение: </label>
						<input id="KeyConfirm"  name="KeyConfirm"  value="" type="text" placeholder="Введете код подтведение" /> <br /> <br />
						<input type="button" name="done" id="mybutton"  value="Создать новый пароль!" />	
					</form>
				</div>
					
				<a href="myadmin.php"> Войти </a>
				<a href="../index.php"> Назад к сайту </a>
				
			</section>
		</section>
	</body>
	</html>
