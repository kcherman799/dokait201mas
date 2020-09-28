<?php

	require_once("Testadmin/Myfunctions.php"); // Подключаем наши функции
		
	$numb = substr($_SERVER['QUERY_STRING'], 3); // Получаем номер статье со адресной строки
	$numb *=1; // Певращаем номер статьи в чисke
	
	$article = getArticleFromNewsinfodb($numb); // Получаем одну статью по номеру статьи
	$Name = $article["Title"]; // Получаем название текущий статье

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
			Новостная статья <hr />
		</section>
		<section class="Pagehome">
			<section class="MainBlock">
				<section class="about_block">
				
				<?php
				// Скипт для вывода одной статье из БД
										
					echo ("
					<img id='newimg' src='img/abilimpiks.jpg' alt='". $article["Title"]. ".' title='". $article["Title"]. ".' />
				<h2 id='Harticle'>". $article["Title"]. "</h2>
				<p id='Date_time'>". 
					$article["Date_time"] 
				."</p>
				<p id='parag'>". 
					htmlspecialchars_decode($article["Full_text"])
				."</p>");
				
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
</html>па  в facebook" title="Группа в facebook"/>
	    </a>
	   </section>
		
		<p id="avtor">
			Все права защищены &copy; 2018-2022.
		</p>
	</footer>
</body>
</html>