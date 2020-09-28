<?php
	// Скрипт для обработки формы смены данных своей учетной записы
	session_start(); // Устанавлеваем сессии для текувщей формы
	
	if(isset($_SESSION['User']['id']))
	{ // Если сессия открыта для данного пользователя
		require_once("Myfunctions.php"); // Подключаем наши функции

		$id = $_SESSION['User']['id']; // Получаем id пользователя
	
		$Pass = htmlspecialchars($_POST["pass"]); // Получаем пароль пользователя 
		$Email = htmlspecialchars($_POST["email"]); // Получаем email пользователя
		
		// Обрабатываем форму
		$message = "Уважаемый пользователь сайта, ваша учетная запись от админ панели Блога Каит №20 изменилась! \n Ваш пароль: ".$Pass .", ваш email: ". $Email .". \n Для перехода в админ панель Блога Каит №20, пожалуйста передите по ссылки: <a href=\"https://dokait201mas.000webhostapp.com/Testadmin/myadmin.php\" title=\"Админ панель\"> https://dokait201mas.000webhostapp.com/Testadmin/myadmin.php </a>"; // Текст сообщение
		$to = $Email; // Кому
		$from = "kchermanteeev2015@gmail.com"; // От кого
		$subjct = "Учетная запись от админ панели Блога Каит №20"; // Тема сообшение
		$header ='From:'. $from . "\r\n" . 'Reply-To:'. $to .  "\r\n" . 'X-Mailer: PHP/' . phpversion(); // Заголовок сообшение, (от кого, перенос на новую строку, кому мы будем отвечать, перенос на новую строку, запокоеваем сообшение с помощью php, версия Php)
	     
	  
	    $Password = PassHesh($Pass); // Шифруем пароль 
	    
	    $User = getNoMyUser($id); // Получаем всех пользоватей, кроме текущего
	    
	    $Myemail = in_array($Email, $User); // Ищим текущей email в БД    
	    
	    if($Myemail == false)
			{ // Если такого email нет в БД 
				$rezult = ChangUser($id, $Password, $Email); // Обновляем данные в БД     
	    
			    if ($rezult)
			     { // Если данные обновилась в БД
				    $SentEmail = mail($to, $subjct, $message); // Отправляем данные на email текущего пользователя
				 }
				 else { // Иначе
					$SentEmail = false;
				}
				
				if ($rezult AND $SentEmail)
				{ // Если информация обновилась в БД и данные отправились 
					echo ("Данные успешно изменились!"); // Выводим успешное сообщенние
				}
				else { // Иначе
					echo ("Извините, но данные не изменились!"); // Выводим сообщенние об ошибки
				}
	 
			}
			else { // Иначе
				echo ("Этот email уже занят, придумаете другой email!"); // Выводим сообщенние об ошибки
			}	
		}
?>