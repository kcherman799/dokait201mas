<?php
	// Скрипт для обработки формы добавление новой страницы на сайт
	session_start(); // Устанавлеваем сессии для текувщей формы
	
	if(isset($_SESSION['User']['id']))
	{ // Если сессия открыта для данного пользователя
		require_once("Myfunctions.php"); // Подключаем наши функции
		
		$Namepage = htmlspecialchars($_POST["namepage"]); // Получаем название странички
		$Headerpage = htmlspecialchars($_POST["headerpage"]); // Получаем заголовок странички
		$Textpage = htmlspecialchars($_POST["textpage"]); // Получаем текст странички
	
		// Обрабатываем форму
		$Newfile = getHrefUrl($Namepage); // Получаем путь к файлу
		
		$NameFile = createFileName($Namepage); // Получаем имя файла на латын
		
		$fileTest = file_exists($Newfile); // Проверяем есть ли такой файл
		
		if(!$fileTest)
		{ // Если файла нет
			$rezul = newPage($Namepage, $Headerpage, $Textpage, $NameFile); // Занёсем данные в БД
			
			if($rezul)
			{ // Если данные занеслись в БД
				$file = saveFile($Namepage); // Создаем файл на серверы
			}
			
			if ($rezul AND $file)
			{ // Если информация добавилась в БД
				echo ("Страница успешно создана!"); // Выводим успешное сообщенние
			}
			else { // Если информация не добавилась в БД
				echo ("Извините, но страница не создана!"); // Выводим сообщенние об ошибки
			}
			
		}
		else { // Иначе
				echo ("Извините, но страница с таким названием уже есть!"); // Выводим сообщенние об ошибки
			}				
		

	}
?>