<?php
	// Скрипт для обработки формы добавление нового поста на сайт
	session_start(); // Устанавлеваем сессии для текувщей формы
	
	if(isset($_SESSION['User']['id']))
	{ // Если сессия открыта для данного пользователя
		require_once("Myfunctions.php"); // Подключаем наши функции
	
		$Namepost = htmlspecialchars($_POST["namepost"]); // Получаем название поста
		$Minitext = htmlspecialchars($_POST["minitext"]); // Получаем вводный текст поста 
		$Textpost = htmlspecialchars($_POST["textpost"]); // Получаем основной текст поста
		$file = $_FILES["file"]; // Получаем картинку поста
		$datetime = new DateTime(); // Создаем объект для работы с датой и времяны
		$date_time = $datetime->format('Y-m-d H:i:s'); // Получаем текувшее дату и время
		
		$Img = SaveImag($file); // Сохраняем картинку на сервере
		
		if($Img)
		{ // Если картика есть на серверы
			// Обрабатываем форму
			$rezult = contrRecFromNewsinfodb($Namepost, $date_time, $Minitext, $Textpost, $Img); // Занёсем данные в БД
		}
	
		
		
		if ($rezult)
		{ // Если информация добавилась в БД
			echo ("Пост успешно создан!"); // Выводим успешное сообщенние
		}
		else { // Если информация не добавилась в БД
			echo ("Извините, но пост не создан!"); // Выводим сообщенние об ошибки
		}
		
	}
	
?>