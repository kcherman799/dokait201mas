<?php
	// Скрипт для обработки формы добавление нового пользователя
	
	session_start(); // Устанавлеваем сессии для текувщей формы
	
	if(isset($_SESSION['User']['id']) && $_SESSION['User']["role"] == "Admin")
	{ // Если сессия открыта для данного пользователя
		require_once("Myfunctions.php"); // Подключаем наши функции

		$Userlogin = htmlspecialchars($_POST["newlogin"]); // Получаем логин пользователя
		$Pass = htmlspecialchars($_POST["pass"]); // Получаем пароль пользователя
		$Email = htmlspecialchars($_POST["email"]); // Получаем email пользователя
		$Role = htmlspecialchars($_POST["role"]); // Получаем роль пользователя
	
		// Обрабатываем форму
		$message = "Уважаемый пользователь сайта, вас зарегистрировали в админ панели Блога Каит №20!\n Ваш логин: ".$Userlogin .", ваш пароль: ". $Pass .", ваша роль: ". $Role ."\n Для перехода в админ панель Блога Каит №20, пожалуйста передите по ссылки: https://dokait201mas.000webhostapp.com/Testadmin/myadmin.php"; // Текст сообщение
		$to = $Email; // Кому
		$from = "kchermanteev2015@gmail.com"; // От кого
		$subjct = "Регистрация в админ панель Блога Каит №20"; // Тема сообшение
		$header ='From:'. $from . "\r\n" . 'Reply-To:'. $to .  "\r\n" . 'X-Mailer: PHP/' . phpversion(); // Заголовок сообшение, (от кого, перенос на новую строку, кому мы будем отвечать, перенос на новую строку, запокоеваем сообшение с помощью php, версия Php)
	     
	  
	     $Password = PassHesh($Pass); // Шифруем пароль 
	     
	     $NewLogin = getLoginUser($Userlogin); // Получаем всех пользователей по логины
		 $NewEmail = getEmailUser($Email); // Получаем всех пользователей по email 
		
		if($NewLogin == false)
		{ // Если такого логина нет в БД 
			if($NewEmail == false)
			{ // Если такого email нет в БД 
				$rezult = insertNewUser($Userlogin, $Password, $Email, $Role); // Занёсем данные в БД     
	    
			    if ($rezult)
			     { // Если данные добавились в БД
				    $SentEmail = mail($to, $subjct, $message); // Отправляем данные на email нового пользователю
				 }
				 else { // Иначе
					$SentEmail = false;
				  }
				
				if ($rezult AND $SentEmail)
				{ // Если информация добавилась в БД и данные отправились на email нового пользователю
					echo ("Пользователь успешно создан!"); // Выводим успешное сообщенние
				}
				else { // Иначе
					echo ("Извините, но пользователь не создан!"); // Выводим сообщенние об ошибки
				}     
			}
			else { // Иначе
				echo ("Этот email уже занят, придумаете другой email!"); // Выводим сообщенние об ошибки
			}	
		}
		else { // Иначе
			echo ("Этот логин уже занят, придумаете другой логин!"); // Выводим сообщенние об ошибки
		}	
	}
?>