<?php
	// Скипт для динамический вывода странички из БД
	require_once("Testadmin/Myfunctions.php"); // Подключаем наши функции
	
	$TestPage = $_SERVER['PHP_SELF']; // Получаем имя странички из адресной строки
	$PageName = trim($TestPage, '/'); // Убираем все лишные символи 
	
	$MyPage = getRecPage($PageName); // Выводим страничку из БД  по ее url
	$Name = $MyPage["Namepage"]; //Получаем имя текущей страницу

 ?>
 
<!doctype html>
<html lang="ru">
<head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
	<meta name="Keywords" content="college, training, vocational training, distance learning, inclusive education, persons with nases" />
	<meta name="Description" content="Этот информационный портал о центре Дистанционного и Инклюзивного образования КАИТ №20" />
	<link href="css/style.css" rel="stylesheet" type="text/css" />
	<link href="img/icon.png" rel="shortcut icon" type="image/x-icon" />
	<title> <?=$Name?> </title>
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
					<a href="index.php" title="На главную"> На главную </a>
				</li>
				<?php
					$Menu = getListPage(); // Получаем меню сайта
					
					for($i = 0; $i<count($Menu); $i++)
					{ // Цикл для вывода меню
						$Url = createFileName($Menu[$i]["Namepage"]); // Получаем путь к страницы
						
						$NamePage = $Menu[$i]["Namepage"];  // Получаем имя страницы
						
						if($Name == $NamePage)
						{  // Если тукущая страница - это
							echo("<li> <a href=\"$Url\" title=\"$NamePage\" class=\"home\"> $NamePage </a>	</li>"); // Выводим пункт меню на экран как активное			
						}
						else 
						{ // Иначе
							echo("<li> <a href=\"$Url\" title=\"$NamePage\"> $NamePage </a>	</li>"); // Выводим пункт меню на экран
						}
					}
					
				?>
			</nav>		
		</header> <br />
		
			<?php
				// Выводим страницу										
					echo("
					<section class='Main_section'>". $MyPage["header"]  ."<hr />
					</section>
					<section class='Pagehome'>
						<section class='MainBlock'>
							<section class='about_block'>". htmlspecialchars_decode($MyPage["Textpage"]));
			?>


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