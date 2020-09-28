<?php
	// Скрипт для функции блога

    $mysqli = new mysqli('localhost', '', '', ''); // Создаем объект mysqli и подключаемся к БД dokait201masdb	

	$queryDB = $mysqli->query('SET NAMES `UTF8`'); // Устанавливаем кодировку для БД dokait201masdb

	if ( !$mysqli AND !$queryDB)
	{ // Если у нас есть ошибки в подключение к БД
		echo ("Ошибка в подключение к БД"); // Выводим сообщенние об ошибки
	}

	$homeHref = $_SERVER['DOCUMENT_ROOT']; // Переменная, которая хранить корневой путь к папке сайта

	function getRecFromNewsinfodb ()
		{ // Функция №1 для вывода постов из таблице newsinfodb
			global $mysqli; // Подключаемся к БД dokait201masdb, вызываем объект для работы с БД

			$mySQLdb = $mysqli->query("SELECT * FROM `newsinfodb` ORDER BY `id` DESC "); // Получаем все записы из таблицы newsinfodb, БД dokait201masdb, которое упорядочени по полу id, по убивание

			$mySQLarray = array(); // Создаем массив для храниние всех записей таблицы newsinfodb, БД dokait201masdb
			$rec = true; // Переменная для получиние записей из таблицы newsinfodb, БД dokait201masdb
			$i = 0;

			while ($rec)
			{ // Цикл для первращиния всех записей newsinfodb, БД dokait201masdb в ассоциативный массив (В ассоциативном массивы, индексы элементов могуть быть записаны в виды названий полей ) и записываем массив в переменную reс
				$rec = $mySQLdb->fetch_assoc(); // Первращаем одну запись в ассоциативный массив
				$mySQLarray[$i] = $rec; // Записываем каждую запись в виде массива (rec) в новый массив mySQLarray
				$i++; // Переходим к следеющей записы таблици
			}
			return($mySQLarray); // Возвращаем массив с новостями
		}


	function contrRecFromNewsinfodb ($title, $date, $Intro_text, $Full_text, $Href_file)
		{ // Функция №2 для добавление постов в таблицу newsinfodb
			global $mysqli; // Подключаемся к БД dokait201masdb, вызываем объект для работы с БД

			$InfoNews = $mysqli->prepare("INSERT INTO newsinfodb (Title, Date_time, Intro_text, Full_text, imag) VALUES (?, ?, ?, ?, ?)"); // Подготавлеваем запрос на вставку данных
			$InfoNews->bind_param('sssss', $title, $date, $Intro_text, $Full_text, $Href_file); // Привязывает переменные к параметрам запроса - проверяет их тип и корректность.
			$result = $InfoNews->execute(); // Занёсем данные из формы в БД

			return $result;	// Возвращаем результать вставки (Истина или ложь)
		}

	function changeRecFromNewsinfodb ($id, $title, $Intro_text, $Full_text, $Href_file = null)
		{ // Функция №3 для измениние постов в таблицу newsinfodb
			global $mysqli; // Подключаемся к БД dokait201masdb, вызываем объект для работы с БД

			if($Href_file)
			{ // Если картинка загружана
				$Newsinfo = $mysqli->prepare("UPDATE newsinfodb SET Title = ?, Intro_text = ?, Full_text = ?, imag = ? WHERE id = ?"); // Подготавлеваем запрос на обновление данных
				$Newsinfo->bind_param('ssssi', $title, $Intro_text, $Full_text, $Href_file, $id); // Привязывает переменные к параметрам запроса - проверяет их тип и корректность.
				$result = $Newsinfo->execute(); // Обновляем данные из формы в БД
			}

			else{ // Иначе
				$Newsinfo = $mysqli->prepare("UPDATE newsinfodb SET Title = ?, Intro_text = ?, Full_text = ? WHERE id = ?"); // Подготавлеваем запрос на обновление данных
				$Newsinfo->bind_param('sssi', $title, $Intro_text, $Full_text, $id); // Привязывает переменные к параметрам запроса - проверяет их тип и корректность.
				$result = $Newsinfo->execute(); // Обновляем данные из формы в БД
			}


			return $result;	// Возвращаем результать обновление (Истина или ложь)
		}

	function delRecFromNewsinfodb ($id)
		{ // Функция №4 для удаление постов из таблице newsinfodb
			global $mysqli; // Подключаемся к БД dokait201masdb, вызываем объект для работы с БД

			$post = $mysqli->prepare("DELETE FROM newsinfodb WHERE id = ?"); // Подготавлеваем запрос на удаление данных
			$post->bind_param('i', $id); // Привязывает переменные к параметрам запроса - проверяет их тип и корректность.

			$result = $post->execute(); // Удаляем данные из формы в БД

			return $result;	// Возвращаем результать удаление (Истина или ложь)
		}

	function regicFromRegwelcon ($Famile, $Name, $Patron, $Phone, $Email, $Shkool, $Class, $Date, $Time)
		{ // Функция №5 для регистации на участие в дни открый дверый в коллежда и записы в таблицу regwelcon ???
			global $mysqli; // Подключаемся к БД dokait201masdb, вызываем объект для работы с БД

			$Regwelcon = $mysqli->prepare("INSERT INTO regwelcon (Famile, Name, Patron, Phone, Email, Shkool, Class, Date, Time) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"); // Подготавлеваем запрос на вставку данных
			$Regwelcon->bind_param('ssssssiss', $Famile, $Name, $Patron, $Phone, $Email, $Shkool, $Class, $Date, $Time); // Привязывает переменные к параметрам запроса - проверяет их тип и корректность.
			$result = $Regwelcon->execute(); // Занёсем данные из формы в БД

			return $result;	// Возвращаем результать вставки (Истина или ложь)
		}

	function insertNewUser ($Userlogin, $Userpassword, $Email, $Role)
		{ // Функция №6 для добавление нового пользователя в БД
			global $mysqli; // Подключаемся к БД dokait201masdb, вызываем объект для работы с БД

			$UserInsert= $mysqli->prepare("INSERT INTO user (Login, Password, Email, Role) VALUES (?, ?, ?, ?)"); // Подготавлеваем запрос на вставку данных
			$UserInsert->bind_param('ssss', $Userlogin, $Userpassword, $Email, $Role); // Привязывает переменные к параметрам запроса - проверяет их тип и корректность.
			$result = $UserInsert->execute(); // Занёсем данные из формы в БД

			return $result;	// Возвращаем результать вставки (Истина или ложь)

		}

	function changeRecFromUser ($id, $Oldpass, $Newpass)
		{ // Функция №7 для измениние учетной записе
			global $mysqli; // Подключаемся к БД dokait201masdb, вызываем объект для работы с БД

			$User = getRecUser($id); // Получаем одного пользователя

			if($User["Password"] == $Oldpass)
			{ // Если старый пароль введен верно

				$newpass = $mysqli->prepare("UPDATE user SET Password = ? WHERE id = ?"); // Подготавлеваем запрос на обновление данных
				$newpass->bind_param('si', $Newpass, $id); // Привязывает переменные к параметрам запроса - проверяет их тип и корректность.
				$rezul = $newpass->execute(); // Обновляем данные из формы в БД

				return $rezul;	// Возвращаем результать обновление (Истина или ложь)
			}
			else { // Иначе
				$rezul = false; // Возвращаем ложь
			}

			return $rezul; // Возвращаем результать
		}

	function getRecFromUser ($Userlogin, $Userpassword)
		{ // Функция №8 для авторизации пользователя в админке
			global $mysqli; // Подключаемся к БД dokait201masdb, вызываем объект для работы с БД

			$user = $mysqli->prepare("SELECT * FROM user WHERE Login = ? AND Password = ?"); // Подготавлеваем запрос
			$user->bind_param('ss', $Userlogin, $Userpassword); // Привязывает переменные к параметрам запроса - проверяет их тип и корректность.

			$user->execute(); // Выполняем запрос

			$rez = $user->get_result(); // Получаем результать
			$User = $rez->fetch_assoc(); // Получаем результать в виде ассотивного массива

			return($User); // Возвращаем массив с одним пользователем
		}

	function delUser ($id)
			{ // Функция №9 для удаление пользователя из БД
				global $mysqli; // Подключаемся к БД dokait201masdb, вызываем объект для работы с БД

				$User = $mysqli->prepare("DELETE FROM user WHERE id = ?"); // Подготавлеваем запрос на удаление данных
				$User->bind_param('i', $id); // Привязывает переменные к параметрам запроса - проверяет их тип и корректность.
				$result = $User->execute(); // Удаляем данные из формы в БД

				return $result;	// Возвращаем результать удаление (Истина или ложь)
			}

	function getArticleFromNewsinfodb ($id)
		{ // Функция №10 для вывода одного поста из таблице newsinfodb
			global $mysqli; // Подключаемся к БД dokait201masdb, вызываем объект для работы с БД

			$post = $mysqli->prepare("SELECT * FROM newsinfodb WHERE id= ?"); // Подготавлеваем запрос
			$post->bind_param('i', $id); // Привязывает переменные к параметрам запроса - проверяет их тип и корректность.

			$post->execute(); // Выполняем запрос

			$rez = $post->get_result(); // Получаем результать
			$Post = $rez->fetch_assoc(); // Получаем результать в виде ассотивного массива

			return($Post); // Возвращаем массив с одним постом
		}

	function EditPage($id, $Namepage, $Headerpage, $Textpage, $Url)
		{ // Функция №11 для обновление страниц сайта
				global $mysqli; // Подключаемся к БД dokait201masdb, вызываем объект для работы с БД

				$page = $mysqli->prepare("UPDATE PageBlog SET Namepage = ?, header = ?, Textpage = ?, Url = ? WHERE id  = ?"); // Подготавлеваем запрос на обновление данных
				$page->bind_param('ssssi', $Namepage, $Headerpage, $Textpage, $Url, $id); // Привязывает переменные к параметрам запроса - проверяет их тип и корректность.
				$result = $page->execute(); // Обновляем данные из формы в БД

				return $result;	// Возвращаем результать обновление (Истина или ложь)

			 }

	function newPage($Namepage, $Headerpage, $Textpage, $Url)
		{ // Функция №12 для добавление страниц на сайт
			global $mysqli; // Подключаемся к БД dokait201masdb, вызываем объект для работы с БД

			$PageBlog = $mysqli->prepare("INSERT INTO PageBlog (Namepage, header, Textpage, Url) VALUES (?, ?, ?, ?)"); // Подготавлеваем запрос на вставку данных

			$PageBlog->bind_param('ssss', $Namepage, $Headerpage, $Textpage, $Url); // Привязывает переменные к параметрам запроса - проверяет их тип и корректность.

			$resul = $PageBlog->execute(); // Занёсем данные из формы в БД

			return $resul;	// Возвращаем результать вставки (Истина или ложь)
		}

	function delPage ($id)
			{ // Функция №13 для уданиние страницы из БД
				global $mysqli; // Подключаемся к БД dokait201masdb, вызываем объект для работы с БД  // Подключаемся к БД dokait201masdb

				$page = $mysqli->prepare("DELETE FROM PageBlog WHERE id = ?"); // Подготавлеваем запрос на удаление данных
				$page->bind_param('i', $id); // Привязывает переменные к параметрам запроса - проверяет их тип и корректность.
				$result = $page->execute(); // Удаляем данные из формы в БД

				return $result;	// Возвращаем результать удаление (Истина или ложь)

			}

			function getListPage()
			{ // Функция №14, для вывода списка страничек
				global $mysqli; // Подключаемся к БД dokait201masdb, вызываем объект для работы с БД  // Подключаемся к БД dokait201masdb

				$mySQLdb = $mysqli->query("SELECT * FROM PageBlog"); // Получаем все странички из БД dokait201masdb

				$ListPage = array(); // Создаем массив для храниние всех страничек блога
				$rec = true; // Переменная для получиние странички блога
				$i = 0;

				while ($rec)
				{ // Цикл для первращиния всех страничек блога в ассоциативный массив и записы массива в переменную ListPage
					$rec = $mySQLdb->fetch_assoc(); // Первращаем одну запись в ассоциативный массив
					$ListPage[$i] = $rec; // Записываем каждую запись в виде массива (rec) в новый массив mySQLarray
					$i++; // Переходим к следующей записы странички блога
				}

				return($ListPage); // Возвращаем список страниц

			}

			function getEditPage($id)
			{ // Функция №15, для вывода одной страницы
				global $mysqli; // Подключаемся к БД dokait201masdb, вызываем объект для работы с БД  // Подключаемся к БД dokait201masdb

				$page = $mysqli->prepare("SELECT * FROM PageBlog WHERE id= ?"); // Подготавлеваем запрос
				$page->bind_param('i', $id); // Привязывает переменные к параметрам запроса - проверяет их тип и корректность.

				$page->execute(); // Выполняем запрос

				$rez = $page->get_result(); // Получаем результать
				$Page = $rez->fetch_assoc(); // Получаем результать в виде ассотивного массива

				return($Page); // Возвращаем массив с одной станицей

			}

			function getListEnroll()
			{ // Функция №16, для вывода списка заявок от абитурентов
				global $mysqli; // Подключаемся к БД dokait201masdb, вызываем объект для работы с БД  // Подключаемся к БД dokait201masdb

				$mySQLdb = $mysqli->query("SELECT * FROM regwelcon"); // Получаем одну страничку из БД dokait201masdb

				$ListEnroll = array(); // Создаем массив для храниние списка заявок от абитурентов
				$rec = true; // Переменная для получиние списка заявок от абитурентов
				$i = 0;

				while ($rec)
				{ // Цикл для первращиния списка заявок от абитурентов в ассоциативный массив и записы массива в переменную ListEnroll
					$rec = $mySQLdb->fetch_assoc(); // Первращаем одну запись в ассоциативный массив
					$ListEnroll[$i] = $rec; // Записываем каждую запись в виде массива (rec) в новый массив ListEnroll
					$i++; // Переходим к следующей записы странички блога
				}

				return($ListEnroll); // Возвращаем список страниц

			}

			function getEditEnroll($id)
			{ // Функция №17, для вывода одной заявки
				global $mysqli; // Подключаемся к БД dokait201masdb, вызываем объект для работы с БД

				$applic = $mysqli->prepare("SELECT * FROM regwelcon WHERE id= ?"); // Подготавлеваем запрос
				$applic->bind_param('i', $id); // Привязывает переменные к параметрам запроса - проверяет их тип и корректность.

				$applic->execute(); // Выполняем запрос

				$rez = $applic->get_result(); // Получаем результать
				$Applic = $rez->fetch_assoc(); // Получаем результать в виде ассотивного массива

				return($Applic); // Возвращаем массив с одной заявкой

			}

			function delEncoll ($id)
			{ // Функция №18 для уданиния абитуреинта из БД
				global $mysqli; // Подключаемся к БД dokait201masdb, вызываем объект для работы с БД  // Подключаемся к БД dokait201masdb

				$applic = $mysqli->prepare("DELETE FROM regwelcon WHERE id = ?"); // Подготавлеваем запрос на удаление данных
				$applic->bind_param('i', $id); // Привязывает переменные к параметрам запроса - проверяет их тип и корректность.
				$result = $applic->execute(); // Удаляем данные из формы в БД

				return $result;	// Возвращаем результать удаление (Истина или ложь)				return $result;

			}

		function ChangUser($id, $Pass, $Email)
			{ // Функция №19 для измениние данных от учетной записы пользователя
				global $mysqli; // Подключаемся к БД dokait201masdb, вызываем объект для работы с БД

				$User = getRecUser($id); // Получаем одного пользователя по id

				if($User)
				{ // Если пользователь такой есть
					$user = $mysqli->prepare("UPDATE user SET Password = ?, Email = ? WHERE id = ?"); // Подготавлеваем запрос на обновление данных
					$user->bind_param('ssi', $Pass, $Email, $id); // Привязывает переменные к параметрам запроса - проверяет их тип и корректность.
					$rezul = $user->execute(); // Обновляем данные из формы в БД
				}
				else { // Иначе
					$rezul = false; // Возвращаем ложь
				}

				return $rezul;	// Возвращаем результать обновление (Истина или ложь)
			}


		function saveFile($NamePage)
			{ // Функция №20 для сохранения файла
				global $homeHref; // Корневой путь

				$namepageX = $NamePage; // Получаем имя страниц
				$FileName = createFileName($namepageX); // Создаем имя файла
				$FileContent = contentPage($namepageX, $FileName); // Создаем разметку странички
				$FileName = $homeHref. "/". $FileName; // Путь к файлу на сервере
				$CreateFile = fopen($FileName, 'a'); // Создаем файл на сервере
				fwrite($CreateFile, $FileContent); 	// Записываем информацию в файл
				fclose($CreateFile); // Закрываем файл

				$chek= file_exists($FileName); // Проверяем создался ли файл

				return($chek); // Возвращаем проверку файла

			}

		function createFileName($NamePageOne)
			{ // Функция №21 для создание имяны файла
				$namepage = $NamePageOne; // Получаем имя страницы
				$EnglishName = rus2translit($namepage); // Переводим имя файлова на латинский аналог

				$NameFile = $EnglishName. ".php"; // Создаем имя файл

				return($NameFile); // Возвращаем имя файла

			}

		function rus2translit($NameRus)
			{ // Функция №22 для перевода имяны файла
				$namerus = mb_strtolower($NameRus, 'UTF-8'); // Получаем имя страниц в нижным регистре
				$nametranslit = ""; // Переменная для латинского имени странице

				$Translit = array(); // Массив для латинского алфавита

				// Заполняем массив
				$Translit["а"] = "a";
				$Translit["б"] = "b";
				$Translit["в"] = "v";
				$Translit["г"] = "g";
				$Translit["д"] = "d";
				$Translit["е"] = "e";
				$Translit["ё"] = "e";
				$Translit["ж"] = "j";
				$Translit["з"] = "z";
				$Translit["и"] = "i";
				$Translit["й"] = "i";
				$Translit["к"] = "k";
				$Translit["л"] = "l";
				$Translit["м"] = "m";
				$Translit["н"] = "n";
				$Translit["о"] = "o";
				$Translit["п"] = "p";
				$Translit["р"] = "r";
				$Translit["с"] = "s";
				$Translit["т"] = "t";
				$Translit["у"] = "y";
				$Translit["ф"] = "f";
				$Translit["х"] = "x";
				$Translit["ц"] = "c";
				$Translit["ч"] = "ch";
				$Translit["ш"] = "sh";
				$Translit["щ"] = "sc";
				$Translit["ъ"] = "";
				$Translit["ы"] = "y";
				$Translit["ь"] = "";
				$Translit["э"] = "e";
				$Translit["ю"] = "iu";
				$Translit["я"] = "ya";
				$Translit[" "] = "_";


				for ($i = 0; $i<mb_strlen($namerus, "UTF-8"); $i++)
				{ // Цикл для перевода имяни файла на латинский язык
					$str = mb_substr($namerus, $i, 1, "UTF-8"); // Обрезаем строку до одного символа
					$nametranslit = $nametranslit. $Translit[$str]; // Переводям один символ на латинский язык
				}


					return($nametranslit); // Возвращаем строку
			}

		function delFile($NameFileDel)
			{ // Функция №23 для удаление файла
				global $homeHref; // Корневой путь
				$namefile = $NameFileDel; // Получаем имя файла

				$nameFile = "$homeHref/". $namefile; // Путь к файлу на сервере

				$rez = unlink($nameFile); // Удаляем файл с сервера
				return($rez); // Возвращаем проверку удаление файла

			}

	function contentPage($RusName, $EngName)
			{ // Функция №24 для создание разметки файла
				$Runame = $RusName; // Получаем русское имя страницы
				$Engname = $EngName; // Получаем английское имя страницы
				$Page = "<?php
	// Скипт для динамический вывода странички из БД
	require_once(\"Testadmin/Myfunctions.php\"); // Подключаем наши функции

	\$TestPage = \$_SERVER['PHP_SELF']; // Получаем имя странички из адресной строки
	\$PageName = trim(\$TestPage, '/'); // Убираем все лишные символи

	\$MyPage = getRecPage(\$PageName); // Выводим страничку из БД  по ее url
	\$Name = \$MyPage[\"Namepage\"]; //Получаем имя текущей страницу

 ?>

<!doctype html>
<html lang=\"ru\">
<head>
	<meta http-equiv=\"Content-Type\" content=\"text/html\" charset=\"utf-8\" />
	<meta name=\"Keywords\" content=\"college, training, vocational training, distance learning, inclusive education, persons with nases\" />
	<meta name=\"Description\" content=\"Этот информационный портал о центре Дистанционного и Инклюзивного образования КАИТ №20\" />
	<link href=\"css/style.css\" rel=\"stylesheet\" type=\"text/css\" />
	<link href=\"img/icon.png\" rel=\"shortcut icon\" type=\"image/x-icon\" />
	<title> <?=\$Name?> </title>
</head>

<body>
	<section id=\"pade\">
		<header>
			<section class=\"logo\">
				<a href=\"index.php\">
					<img src=\"img/kait20.jpg\" alt=\"Логотип\" title=\"На главную\"/>
				</a>
				<div> Дистанционное образования в КАИТе №20 </div>
			</section>
			<nav>
				<li>
					<a href=\"index.php\" title=\"На главную\"> На главную </a>
				</li>
				<?php
					\$Menu = getListPage(); // Получаем меню сайта

					for(\$i = 0; \$i<count(\$Menu); \$i++)
					{ // Цикл для вывода меню
						\$Url = createFileName(\$Menu[\$i][\"Namepage\"]); // Получаем путь к страницы

						\$NamePage = \$Menu[\$i][\"Namepage\"];  // Получаем имя страницы
						\$h='\"home\"'; // Переменная для класса у пункта меню

						if(\$Name == \$NamePage)
						{  // Если текущая страница - это
							echo(\"<li> <a href=\". \$Url. \" title=\". \$NamePage. \" class=\". \$h .\">\". \$NamePage .\"</a>	</li>\"); // Выводим пункт меню на экран как активное
						}
						else
						{ // Иначе
							echo(\"<li> <a href=\". \$Url. \" title=\". \$NamePage.\">\". \$NamePage .\"</a>	</li>\"); // Выводим пункт меню на экран
						}
					}

				?>
			</nav>
		</header> <br />

			<?php
				// Выводим страницу
					echo(\"
					<section class='Main_section'>\". \$MyPage[\"header\"]  .\"<hr />
					</section>
					<section class='Pagehome'>
						<section class='MainBlock'>
							<section class='about_block'>\". htmlspecialchars_decode(\$MyPage[\"Textpage\"]));
			?>


				</section>
			</section>
		</section>

	</section>
	<footer>
		<section class=\"contact\">
			<p> Соц. сети </p>
		  <a href=\"https://vk.com/distance_inclusive\" target=\"_blank\">
			  <img src=\"img/vk.png\" alt=\"Группа Вконтакте\" title=\"Группа Вконтакте\"/>
	    </a>
	    <a id=\"fb\" href=\"https://www.facebook.com/distanceinclusive/\" target=\"_blank\">
	    	<img src=\"img/facebook.png\" alt=\"Группа  в facebook\" title=\"Группа в facebook\"/>
	    </a>
	   </section>

		<p id=\"avtor\">
			Все права защищены &copy; 2018-2022.
		</p>
	</footer>
</body>
</html>"; //

			return($Page);

			}


		function SaveImag($file)
			{ // Функция №25, для загрузки картинке на сервер
				global $homeHref; // Корневой путь

				$UrlImg = "img/". $file["name"]; // Путь к картинки на сайте
				$folder= "$homeHref/". $UrlImg; // Путь к папке с картинками на серверы

				$rezul = move_uploaded_file($file["tmp_name"], $folder); // Сохраняем картинку на сервере

				if($rezul)
				{ // Если файл сохранился на серверы
					return($UrlImg); // Возвращаем публичный путь к картинке на серверы
				}
				else {
					return($rezul); // Возвращаем ложь
				}

			}

	function getEmalAdmin ()
		{ // Функция №26 для получение емайл админа
			global $mysqli; // Подключаемся к БД dokait201masdb, вызываем объект для работы с БД

			$mySQLdb = $mysqli->query("SELECT Email FROM `user` WHERE Role = 'admin'"); // Получаем емайле админов из таблицы user, БД dokait201masdb

			$ListMail = array(); // Создаем массив для храниние списка емайлов
			$rec = true; // Переменная для получиние списка емайлов
			$i = 0;

			while ($rec)
			{ // Цикл для первращиния списка емайлов в ассоциативный массив и записы массива в переменную ListMail
				$rec = $mySQLdb->fetch_assoc(); // Первращаем одну запись в ассоциативный массив
				$ListMail[$i] = $rec; // Записываем каждую запись в виде массива (rec) в новый массив ListMail
				$i++; // Переходим к следующей записы странички блога
			}

			return($ListMail); // Возвращаем список емайлов
		}


/*
		function delFile1($NameImag)
			{ // Функция №27 для удаление файла
				$nameimag = $NameImag; // Получаем путь к картинки

				$rez = unlink($nameimag); // Удаляем картинку с сервера
				return($rez); // Возвращаем проверку удаление картинки
			}
*/

		function getRecUser($id)
		{ // Функция №28 для получение пользователя по id
			global $mysqli; // Подключаемся к БД dokait201masdb, вызываем объект для работы с БД

			$user = $mysqli->prepare("SELECT * FROM user WHERE id = ?"); // Подготавлеваем запрос
			$user->bind_param('i', $id); // Привязывает переменные к параметрам запроса - проверяет их тип и корректность.

			$user->execute(); // Выполняем запрос

			$rez = $user->get_result(); // Получаем результать
			$result = $rez->fetch_assoc(); // Получаем результать в виде ассотивного массива

			return($result); // Возвращаем массив с одним пользователем
		}

		function getEmailUser($Email)
		{ // Функция №29 для получение пользователя по email
			global $mysqli; // Подключаемся к БД dokait201masdb, вызываем объект для работы с БД

			$user = $mysqli->prepare("SELECT * FROM user WHERE Email = ?"); // Подготавлеваем запрос
			$user->bind_param('s', $Email); // Привязывает переменные к параметрам запроса - проверяет их тип и корректность.

			$user->execute(); // Выполняем запрос

			$rez = $user->get_result(); // Получаем результать
			$Email = $rez->fetch_assoc(); // Получаем результать в виде ассотивного массива

			return($Email); // Возвращаем массив с одним пользователем по email пользователя
		}

	function getNoMyUser($id)
		{ // Функция №30 для получение всех пользоватей, кроме текущего
			global $mysqli; // Подключаемся к БД dokait201masdb, вызываем объект для работы с БД

			$user = $mysqli->prepare("SELECT * FROM user WHERE id != ?"); // Подготавлеваем запрос
			$user->bind_param('i', $id); // Привязывает переменные к параметрам запроса - проверяет их тип и корректность.

			$user->execute(); // Выполняем запрос

			$rez = $user->get_result(); // Получаем результать


			$Users = array(); // Создаем массив для храниние списка емайлов
			$rec = true; // Переменная для получиние списка емайлов
			$i = 0;

			while ($rec)
			{ // Цикл для первращиния списка емайлов в ассоциативный массив и записы массива в переменную ListMail
				$rec = $rez->fetch_assoc(); // Первращаем одну запись в ассоциативный массив
				$Users[$i] = $rec; // Записываем каждую запись в виде массива (rec) в новый массив ListMail
				$i++; // Переходим к следующей записы странички блога
			}

			return($Users); // Возвращаем массив с одним пользователем по email пользователя
		}

		function getLoginUser($Login)
		{ // Функция №31 для получение пользователя по логину
			global $mysqli; // Подключаемся к БД dokait201masdb, вызываем объект для работы с БД

			$User = $mysqli->prepare("SELECT Login FROM user WHERE Login = ?"); // Подготавлеваем запрос
			$User->bind_param('s', $Login); // Привязывает переменные к параметрам запроса - проверяет их тип и корректность.

			$User->execute(); // Выполняем запрос

			$rez = $User->get_result(); // Получаем результать
			$Login = $rez->fetch_assoc(); // Получаем результать в виде ассотивного массива

			return($Login); // Возвращаем массив с одним пользователем по логину пользователя
		}

		function PassHesh ($Password)
		{ // Функция №32, для шифрование пароля
			$hash = "p7qxrqwovw321rsqey"; // Соль
			$Pass = md5($Password. $hash); // Шифруем паполь

			return($Pass); // Возвращаем зашифрованний пароль
		}

		function recovPassUser($Login, $NewPass, $Email)
			{ // Функция №34 для востановления пароля пользователя
				global $mysqli; // Подключаемся к БД dokait201masdb, вызываем объект для работы с БД

				$recovPass = $mysqli->prepare("UPDATE user SET Password = ? WHERE Login = ? AND Email = ?"); // Подготавлеваем запрос на обновление данных
				$recovPass->bind_param('sss', $NewPass, $Login, $Email); // Привязывает переменные к параметрам запроса - проверяет их тип и корректность.
				$result = $recovPass->execute(); // Обновляем данные из формы в БД

				return $result;	// Возвращаем результать обновление (Истина или ложь)
			}


		function editUser($id, $Login, $Email, $Role)
		{ // Функция №35 для измениния учетной записе пользователя
			global $mysqli; // Подключаемся к БД dokait201masdb, вызываем объект для работы с БД

			$recovPass = $mysqli->prepare("UPDATE user SET Login = ?, Email = ?, Role = ? WHERE id = ?"); // Подготавлеваем запрос на обновление данных
			$recovPass->bind_param('sssi', $Login, $Email, $Role, $id); // Привязывает переменные к параметрам запроса - проверяет их тип и корректность.
			$result = $recovPass->execute(); // Обновляем данные из формы в БД

			return $result;	// Возвращаем результать обновление (Истина или ложь)
		}

		function getNoMyLoginUser($id, $Login)
		{ // Функция №36 для получение всех пользователей по логину, кроме текущего
			global $mysqli; // Подключаемся к БД dokait201masdb, вызываем объект для работы с БД

			$User = $mysqli->prepare("SELECT Login FROM user WHERE Login = ? AND id != ? "); // Подготавлеваем запрос
			$User->bind_param('si', $Login, $id); // Привязывает переменные к параметрам запроса - проверяет их тип и корректность.

			$User->execute(); // Выполняем запрос

			$rez = $User->get_result(); // Получаем результать
			$Login = $rez->fetch_assoc(); // Получаем результать в виде ассотивного массива

			return($Login); // Возвращаем массив с одним пользователем по логину пользователя
		}

	function getNoMyEmailUser($id, $Email)
		{ // Функция №37 для получение всех пользователей по email, кроме текущего
			global $mysqli; // Подключаемся к БД dokait201masdb, вызываем объект для работы с БД

			$User = $mysqli->prepare("SELECT Email FROM user WHERE Email = ? AND id != ? "); // Подготавлеваем запрос
			$User->bind_param('si', $Email, $id); // Привязывает переменные к параметрам запроса - проверяет их тип и корректность.

			$User->execute(); // Выполняем запрос

			$rez = $User->get_result(); // Получаем результать
			$Email = $rez->fetch_assoc(); // Получаем результать в виде ассотивного массива

			return($Email); // Возвращаем массив с одним пользователем по логину пользователя
		}

		function getHrefUrl($Filename)
		{ // Функция №38 для получение пути к файлу на сервере
			global $homeHref; // Корневой путь

			$NameFile = createFileName($Filename); // Получаем имя файла на латыне
			$folder= "$homeHref/". $NameFile; // Путь к папке с страницами на серверы

			return($folder); // Возвращаем публичный путь к страницами на сервере
		}

		function getRecPage($Url)
			{ // Функция №39, для вывода одной страницы по ее url
				global $mysqli; // Подключаемся к БД dokait201masdb, вызываем объект для работы с БД

				$page = $mysqli->prepare("SELECT * FROM PageBlog WHERE Url = ?"); // Подготавлеваем запрос
				$page->bind_param('s', $Url); // Привязывает переменные к параметрам запроса - проверяет их тип и корректность.

				$page->execute(); // Выполняем запрос

				$rez = $page->get_result(); // Получаем результать
				$Page = $rez->fetch_assoc(); // Получаем результать в виде ассотивного массива

				return($Page); // Возвращаем массив с одной станицей

			}

		function getLimilRecNewsinfodb($id)
		{ // Функция №40 для вывода шести постов из таблице newsinfodb
			global $mysqli; // Подключаемся к БД dokait201masdb, вызываем объект для работы с БД

			$Post = $mysqli->prepare("SELECT * FROM `newsinfodb` ORDER BY `id` DESC LIMIT ?, 6"); // Подготавлеваем запрос
			$Post->bind_param('i', $id); // Привязывает переменные к параметрам запроса - проверяет их тип и корректность.

			$Post->execute(); // Выполняем запрос

			$rez = $Post->get_result(); // Получаем результать

			$Postarray = array(); // Создаем массив для храниние всех записей таблицы newsinfodb, БД dokait201masdb
			$rec = true; // Переменная для получиние записей из таблицы newsinfodb, БД dokait201masdb
			$i = 0;

			while ($rec)
			{ // Цикл для первращиния всех записей newsinfodb, БД dokait201masdb в ассоциативный массив (В ассоциативном массивы, индексы элементов могуть быть записаны в виды названий полей ) и записываем массив в переменную reс
				$rec = $rez->fetch_assoc(); // Первращаем одну запись в ассоциативный массив
				$Postarray[$i] = $rec; // Записываем каждую запись в виде массива (rec) в новый массив mySQLarray
				$i++; // Переходим к следеющей записы таблици
			}

			return($Postarray); // Возвращаем массив с постами
		}

		function PublishHrefImg($UrlFile)
		{ // Функция №41, получение публичного пути к файлу для сайта
			$HrefImg = $UrlFile; // Получаем имя файла

			$PublishHref= "https://". $_SERVER['SERVER_NAME']. "/". $UrlFile; // Публичный путь к картинке

			return($PublishHref); // Возвращаем публичный путь к картинке
		}


?>
