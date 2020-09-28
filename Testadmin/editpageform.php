<?php
	// Скрипт для обработки формы измениния страницы на сайт
	session_start(); // Устанавлеваем сессии для текувщей формы

	if(isset($_SESSION['User']['id']))
	{ // Если сессия открыта для данного пользователя
		require_once("Myfunctions.php"); // Подключаем наши функции
		
		$id = htmlspecialchars($_POST["Id"]); // Получаем id странички
		$Namepage = htmlspecialchars($_POST["namepage"]); // Получаем название странички
		$Headerpage = htmlspecialchars($_POST["headerpage"]); // Получаем заголовок странички
		$Textpage = htmlspecialchars($_POST["textpage"]); // Получаем текст странички
		
		$Page = getEditPage($id); // Получаем одну страницу по номеру страничкиапр
		$Oldname = $Page["Namepage"]; // Получаем старое имя страницы 
		
		// Обрабатываем форму
		$Oldfile = getHrefUrl($Oldname); // Получаем старое имя файла
		$Newfile = getHrefUrl($Namepage); // Получаем новое имя файла
		
		$ChangFile = rename($Oldfile, $Newfile); // Переименоваем файл
		
		$UrlPage = createFileName($Namepage); // Получаем url страницы 		
		
		if ($ChangFile)
		{
			$rezult = EditPage($id, $Namepage, $Headerpage, $Textpage, $UrlPage); // Изменяем данные в БД
		
			if ($rezult)
			{ // Если информация измениласть  в БД
				echo ("Страница успешно изменена!"); // Выводим успешное сообщенние
			}
			else { // Если информация не измениласть в БД
				echo ("Извините, но страница не изменилась!"); // Выводим сообщенние об ошибки
			}
			
			
		}
		
	}	
		
?>