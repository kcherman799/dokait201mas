<?php
	// Скрипт для обработки формы измениния поста на сайт
	require_once("Myfunctions.php"); // Подключаем наши функции

	$id = htmlspecialchars($_POST["Id"]); // Получаем id поста
	$Namepost = htmlspecialchars($_POST["namepost"]); // Получаем название поста
	$Minitext = htmlspecialchars($_POST["minitext"]); // Получаем вводный текст поста 
	$Textpost = htmlspecialchars($_POST["textpost"]); // Получаем основной текст поста
	
	
	if(isset($_FILES["file"]))
	{ // Если картинка загружана 
		$file = $_FILES["file"]; // Получаем картинку поста
		
		$Img = SaveImag($file); // Сохраняем картинку на сервере
	
		if($Img)
		{ // Если картика есть на серверы
			// Обрабатываем форму
			$rezult = changeRecFromNewsinfodb($id, $Namepost, $Minitext, $Textpost, $Img); // Изменяем данные в БД
		}
	}
	else
	{ // Иначе
		$file = null; // В переменную записываем постоту
		
		$rezult = changeRecFromNewsinfodb($id, $Namepost, $Minitext, $Textpost); // Изменяем данные в БД
	}
	
		
	

	if ($rezult)
	{ // Если информация измениласть  в БД
		echo ("Пост успешно изменен!"); // Выводим успешное сообщенние
	}
	else { // Если информация не измениласть в БД
		echo ("Извините, но пост не изменился!"); // Выводим сообщенние об ошибки
	}
	
	
	
	
?>