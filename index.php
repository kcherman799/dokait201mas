<?php
	require_once("Testadmin/Myfunctions.php"); // Подключаем наши функции
 ?>

<!doctype html>
<html lang="ru">
<head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
	<meta name="Keywords" content="college, training, vocational training, distance learning, inclusive education, persons with nases" />
	<meta name="Description" content="Этот информационный портал о центре Дистанционного и Инклюзивного образования КАИТ №20" />
	<link href="css/style.css" rel="stylesheet" type="text/css" />
	<link href="img/icon.png" rel="shortcut icon" type="image/x-icon" />
	<title> Дистанционное образования в КАИТе №20 </title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
		$(document).ready(function () {
			$("#send").click(function ()
				{ // Функция для обработки формы заявки на участие в дни открытый дверый в коллежда
					$('#messageError').hide(); // Скрываем сообщение об ошибки
					$('#messageError').css("color", "red"); // Меняем цвет у информационного поля
				
					var Famile = $("#famile").val(); // Получаем значение поля Фамилие
					var Name = $("#name").val(); // Получаем значение поля Имя
					var Patron = $("#patron").val(); // Получаем значение поля Отчество
					var Email = $("#email").val(); // Получаем значение поля Емэль
					var Phone = $("#phone").val(); // Получаем значение поля Телефон
					var School = $("#school").val(); // Получаем значение поля Школа
					var Class = $("#class").val(); // Получаем значение поля Класс
					var DateViz = $("#dateviz").val(); // Получаем значение поля Дата
					var Time = $("#time").val(); // Получаем значение поля Время
					
					var Fail = ''; // Переменная для ошибок 
					
					if(Famile.length < 3)
					{ // Если фамилия неправильно указано
						Fail = 'Фамилия не меньше 3 символов!';
					}
					else if (Name.length < 3)
					{ // Если имя неправильно указано 
						Fail = 'Имя не меньше 3 символов!';
					}
					else if (Patron.length < 6)
					{ // Если отчество неправильно указано
						Fail = 'Отчество не меньше 6 символов!';
					}
					else if (Phone.length < 10)
					{ // Если телефон неправильно указан 
						Fail = 'Телефон не меньше 10 символов!';
					}
					else if (Email.split('@').length-1 ==0 || Email.split('.').length-1 == 0)
					{ // Если Email неправильно указан 
						Fail = 'Вы ввели некорректный Email!';
					}
					else if (School.len < 3)
					{ // Если школа неправильно указана
						Fail = 'Школа не меньше 3 символов!';
					}
					else if (Class == "")
					{ // Если класс неправильно указан
						Fail = 'Введите класс!';
					}
					else if (DateViz == "")
					{ // Если дата приезда неправильно указана 
						Fail = 'Укажите дату приезда в колледж';
					}
					else if (Time == "")
					{ // Если время приезда неправильно указана 
						Fail = 'Укажите время приезда в колледж';
					}
					
					if(Fail != "")
					{ // Если в полях есть ошибки
						// Покаживаем ошибку пользователю
						$('#messageError').html(Fail + "<section class='clear'></section>");
						$('#messageError').show();
						
					}

					else { // Если в полях нет ошибок
							$("#send").attr("disabled", "disabled"); // Блокироем кнопку отправки сообщение		
						
							$.ajax({ // Отправка формы на сервер
							url: 'Testadmin/formhandl.php',
							type: 'POST',
							cache: false,
							data: {'famile': Famile, 'name': Name, 'patron': Patron, 'phone': Phone, 'email': Email, 'school': School, 'class': Class, 'dateviz': DateViz, 'time': Time},
							dataType: 'html',
							success: function (data) {
									$('#messageError').html(data + "<section class='clear'></section>");
									$('#messageError').show(); // Покаживаем сообщение о состояние сообщение
									
									if (data == "Сообщение успешно отправлено!")
									{ // Если сообщение успешно отправлено
										
										$('#messageError').css("color", "green"); // Меняем цвет у информационного поля
										
										// Очищаем поля формы
										$("#famile").val("");
										$("#name").val("");
										$("#patron").val("");
										$("#phone").val("");
										$("#email").val("");
										$("#school").val("");
										$("#class").val("");
										$("#dateviz").val("");
										$("#time").val("");
									}
									
									$("#send").removeAttr("disabled"); // Разблокироем кнопку отправки сообщение					
								}
						    });
						}
				
				
				});
		});
	</script>
</head>

<body>
	<section id="pade">
		<header>
			<section class="logo">
				<a href="index.php">
					<img src="img/kait20.jpg" alt="Логотип" title="На главную"/>
				</a>
				<div> Дистанционное образования в КАИТе №20 </div>
			</section>
			<nav>
				<li>
					<a href="index.php" class="home" title="На главную"> На главную </a>
				</li>
				<?php
					$Menu = getListPage(); // Получаем меню сайта
					
					for($i = 0; $i<count($Menu); $i++)
					{ // Цикл для вывода меню
						$Url = createFileName($Menu[$i]["Namepage"]); // Получаем путь к страницы
						
						$Name = $Menu[$i]["Namepage"];  // Получаем имя страницы
						
						echo("<li> <a href=\"$Url\" title=\"$Name\"> $Name </a>	</li>"); // Выводим меню на экран
						
						
					}
					
				?>	
			</nav>
		</header> <br />
		<section class="Main_section">
			Последние новости <hr />
		</section>
		<section class="Pagehome">
			<section class="MainBlock">
				<?php
				// Скипт для вывод статей из БД
					$mySQLarray = getRecFromNewsinfodb(); // Получаем все посты
					
					for ($i = 0; $i<3; $i++) // Переменная $i, - индекс массивы $mySQLarray, последная запись имеет индекс нуль!
						{ // Цикл для вывода статей из БД					
							$curntrec = $mySQLarray[$i]; // В переменную mass записываем текущую запись из БД
							$Imag = PublishHrefImg($curntrec["imag"]); // Получаем публичный путь к картинки
							
							echo("
								<article>
									<img src='". $Imag. "' alt='". $curntrec["Title"]. "' title='". $curntrec["Title"]. "' />
									<h2>". $curntrec["Title"]. "</h2>
									<p>". $curntrec["Intro_text"]. "</p>
									<a href=\"article.php?id=".$curntrec["id"]." \" title=\"Посмотреть статью\"> Читать далее </a>
								</article>
								"); // Вывод статей из БД на экран
						}

					?>
			</section>
		</section>

			<section id="center_main">
				<section id="center_main_in">
					<h2>
						Уважаемые абитуриенты, приходите к нам <br /> на день открытых дверей!
					</h2>
					<p>
						Будем ради видеть Вас в нашим колледже <br />
						Заполните пожалуйста данную форму!
					</p>

					
					<form name="regwelcon" action="Testadmin/formhandl.php" method="post">
						<fieldset>
							<div>
								* - Обязательные поля для заполнения!
							</div>
							<legend align="center"> Контактная информация: </legend>
								<label for="famile"> Фамилия <em>*</em>:  </label>
								<input type="text" name="famile" id="famile" /> <br />
								<label for="name"> Имя <em>*</em>: </label>
								<input type="text" name="name" id="name" /> <br />
								<label for="patron"> Отчество <em>*</em>: </label>
								<input type="text" name="patron" id="patron" /> <br />
								<label for="phone"> Телефон <em>*</em>: </label>
								<input type="text" name="phone" id="phone" />	<br />
								<label for="email"> E-mail <em>*</em> :</label>
								<input type="email" name="email" id="email" /> <br />
								<label for="school"> Школа <em>*</em>: </label>
								<input type="text" name="school" id="school" />	<br />
								<label for="class"> Класс <em>*</em> :</label>
								<input type="text" name="class" id="class" />
						</fieldset>
						<fieldset>
							<legend align="center"> Выбор дня для поездки в колледж: </legend>
							<label for="dateviz"> Выбрать дату <em>*</em>:  </label>
								<input type="date" name="dateviz" id="dateviz" /> <br />
								<label for="time"> Время : </label>
								<input type="time" name="time" id="time" />
						</fieldset>
						
						<input type="button" id="send" value="Отправить форму!" />
						<section id="messageError" style="color: red; font-size: 20px;"> </section>
					</form>

				</section>
			</section>

		<section class="Pagehome">
			<section class="MainBlock">
				<?php
				// Скипт для вывод статей из БД
					for ($i = 3; $i<6; $i++) // Переменная $i, - индекс массивы $mySQLarray, последная запись имеет индекс нуль!
						{ // Цикл для вывода статей из БД
							$curntrec = $mySQLarray[$i]; // В переменную mass записываем текущую запись из БД
							$Imag = PublishHrefImg($curntrec["imag"]); // Получаем публичный путь к картинки
							
							echo("
								<article>
									<img src='". $Imag. "' alt='". $curntrec["Title"]. "' title='". $curntrec["Title"]. "' />
									<h2>". $curntrec["Title"]. "</h2>
									<p>". $curntrec["Intro_text"]. "</p>
									<a href=\"article.php?id=".$curntrec["id"]." \" title=\"Посмотреть статью\"> Читать далее </a>
								</article>
								"); // Вывод статей из БД на экран
						}
						
						
						// Выводим навигацию постов
						/* 1) Получаем количество страниц с постами
						   2) Перебираем  количество страниц с постами
						   	3) формируем ссылки для каждой страницы
						  4) Закончиваем перебор					
						*/
						$CountPost = count($mySQLarray)-1; // Получаем количество постов
						$CountArticle =ceil($CountPost / 6); // Получаем количество страниц с постами
						echo("<section class=\"Navig\">");
						
						for ($i = 1; $i<=$CountArticle; $i++)
						  { // Цикл для вывода навигации постов 
							 	if ($i == 1)
							 	{ // Если текувщая страница главная
								 	echo("<span> $i </span>"); // Выводим меню на экран
							 	}
							 	else
							 	{ // Иначе
								 	echo("<a href=\"page.php?p=$i\" title=\"Перейти на страницу $i\" > $i </a>"); // Выводим меню на экран
							 	}  
						  }

					?>
					</section>
			</section>
		</section>
		</section>
	</section>
	<footer>
		<section class="contact">
			<p> Соц. сети </p>
		  <a href="https://vk.com/distance_inclusive" target="_blank">
			  <img src="img/vk.png" alt="Группа Вконтакте" title="Группа Вконтакте"/>
	    </a>
	    <a id="fb" href="https://www.facebook.com/distanceinclusive/" target="_blank">
	    	<img src="img/facebook.png" alt="Группа  в facebook" title="Группа в facebook"/>
	    </a>
	   </section>

		<p id="avtor">
			Все права защищены &copy; 2018-2022.
		</p>
	</footer>
</body>
</html>