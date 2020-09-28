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
					$numb = substr($_SERVER['QUERY_STRING'], 2); // Получаем номер статье со адресной строки
					$numb *=1; // Певращаем номер статьи в числу
					
					
					$NumbPrevArt = $numb - 1; // Получаем номер предыдущей страницы
					
					$NumbPost = $NumbPrevArt*6; // Получаем номер первый статье на текущей страницы

					
					$Posts = getLimilRecNewsinfodb($NumbPost); // Получаем 6 постов из БД
										
					for ($i = 0; $i<count($Posts)-1; $i++) 
					{ // Цикл для вывода статей из БД
						$Post = $Posts[$i]; // В переменную mass записываем текущую запись из БД
						$Imag = PublishHrefImg($Post["imag"]); // Получаем публичный путь к картинки
						
						echo("
							<article>
								<img src='". $Imag. "' alt='". $Post["Title"]. "' title='". $Post["Title"]. "' />
								<h2>". $Post["Title"]. "</h2>
								<p>". $Post["Intro_text"]. "</p>
								<a href=\"article.php?id=".$Post["id"]." \" title=\"Посмотреть статью\"> Читать далее </a>
							</article>
							"); // Вывод статей из БД на экран
													
					}
						
						
						// Выводим навигацию постов
						/* 1) Получаем количество страниц с постами
						   2) Перебираем  количество страниц с постами
						   	3) формируем ссылки для каждой страницы
						  4) Закончиваем перебор					
					*/	
					
					$mySQLarray = getRecFromNewsinfodb(); // Получаем все посты
					
					$CountArticle =ceil(count($mySQLarray) / 6); // Получаем количество страниц с постами
					
					echo("<section class=\"Navig\">");
					for ($i = 1; $i <$CountArticle; $i++)
					  { // Цикл для вывода навигации постов 
					 	if ($i == 1)
					 	{ // Если текувщая станица главная
						 	echo("<a href=\"index.php\" title=\"Перейти на страницу $i\" > $i </a>"); // Выводим меню на экран
					 	}
					 	else if ($i == $numb)
					 	{ // Если текувщая станица главная
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
</htmll>