<?php
	// Скрипт для обработки формы смены почты получение заявки на день открытых дверый с сайта
	session_start(); // Устанавлеваем сессии для текувщей формы
	require_once("Myfunctions.php"); // Подключаем наши функции

	$Oldmail = htmlspecialchars($_POST["Oldmail"]); // Получаем старую почту
	$Newmail = htmlspecialchars($_POST["Newmail"]); // Получаем новую почту
	$Pass = htmlspecialchars($_POST["Pass"]); // Получаем пароль пользователя
	$id = $_SESSION["id"]; // Получаем id пользователя
	
	// Обрабатываем форму
	$message = "Уважаемый администратор сайта, на ваш email: ".$Newmail.", будут отправляться заявки на день открытых дверей в Каите №20!"; // Текст сообщение
	$to = $Newmail; // Кому
	$from = $Oldmail; // От кого
	$subjct = "День открытых дверей в КАИТЕ"; // Тема сообшение
	$header ='From:'. $from . "\r\n" . 'Reply-To:'. $to .  "\r\n" . 'X-Mailer: PHP/' . phpversion(); // Заголовок сообшение, (от кого, перенос на новую строку, кому мы будем отвечать, перенос на новую строку, запокоеваем сообшение с помощью php, версия Php)
     
  
     $Password = PassHesh($Pass); // Шифруем пароль 
     
     $rezult = Changmail($id, $Oldmail, $Newmail, $Password); // Занёсем данные в БД     
    
    if ($rezult)
     { // Если данные изменились в БД
	    $SentEmail = mail($to, $subjct, $message); // Отправляем данные на email нового админа
	 }
	 else { // Иначе
		$SentEmail = false;
	}
    
     
    if ($SentEmail)
	{ // Если данные записены в БД и отправлены на email нового админа 
		echo('Почта админа успешно сменилась!');
	}
	else { // Иначе
		echo('Извините, но почта админа не сменилась!');
	}
	
	
?>