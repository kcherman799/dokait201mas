<?php
	// Скрипт для обработки формы удаление поста с сайта

	session_start(); // Устанавлеваем сессии для текувщей формы
	
	if(isset($_SESSION['User']['id']))
	{ // Если сессия открыта для данного пользователя
		require_once("Myfunctions.php"); // Подключаем наши функции
		$NumbPost = substr($_SERVER['QUERY_STRING'], 3); // Получаем номер поста со адресной строки
		$NumbPost *=1; // Певращаем номер поста в числу
		
		// Обрабатываем форму
		$RemovePost = getArticleFromNewsinfodb($NumbPost); // Выводим пост из БД
		
		$ImgRemove = delFile($RemovePost["imag"]); // Удаляем картинку с сервера
	
		$RecRemove = delRecFromNewsinfodb($NumbPost); // Удаляем данные из БД
		
		if ($ImgRemove AND $RecRemove)
		{ // Если информация удалена из БД
			echo ("Пост успешно удален <br >
				<a href='delpost.php'> Назад </a>"); // Выводим успешное сообщенние
		}
		else { // Если информация не удалиласть в БД
				echo ("Извините, но пост не удален <br >
				<a href='delpost.php'> Назад </a>"); // Выводим сообщения об ошибки
			}
	}
?>