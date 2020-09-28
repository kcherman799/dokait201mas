<?php
	// Скрипт для обработки формы измениния пользователя
	
	session_start(); // Устанавлеваем сессии для текувщей формы
	
	if(isset($_SESSION['User']['id']) && $_SESSION['User']["role"] == "Admin")
	{ // Если сессия открыта для данного пользователя
		require_once("Myfunctions.php"); // Подключаем наши функции
	
		$id = htmlspecialchars($_POST["id"]); // Получаем id пользователя
		$LoginUser = htmlspecialchars($_POST["loginuser"]); // Получаем логин пользователя
		$Email = htmlspecialchars($_POST["email"]); // Получаем email пользователя
		$Role = htmlspecialchars($_POST["role"]); // Получаем роль пользователя
	
		// Обрабатываем форму
		$message = "Уважаемый пользователь сайта, ваша учетная запись от админ панели Блога Каит №20 изменилась!n Ваш логин: ".$LoginUser .", ваш пароль остался старым, ваша роль: ". $Role ."\n Для перехода в админ панель Блога Каит №20, пожалуйста передите по ссылки: https://dokait201mas.000webhostapp.com/Testadmin/recoverpass.php";
		$to = $Email; // Кому
		$from = "kchermanteeev2015@gmail.com"; // От кого
		$subjct = "Учетная запись от админ панели Блога Каит №20"; // Тема сообшение
		$header ='From:'. $from . "\r\n" . 'Reply-To:'. $to .  "\r\n" . 'X-Mailer: PHP/' . phpversion(); // Заголовок сообшение, (от кого, перенос на новую строку, кому мы будем отвечать, перенос на новую строку, запокоеваем сообшение с помощью php, версия Php)
	
	     
		$MyLogin = getNoMyLoginUser($id, $LoginUser); // Получаем всех пользователей по логины, кроме текущего 
		$MyEmail = getNoMyEmailUser($id,$Email); // Получаем всех пользователей по email, кроме текущего
		 
		if($MyLogin == false)
		{ // Если такого логина нет в БД 
			if($MyEmail == false)
			{ // Если такого email нет в БД 
				$rezult = editUser($id, $LoginUser, $Email, $Role); // Занёсем данные в БД     
	    
			    if ($rezult)
			     { // Если данные добавились в БД
				    $SentEmail = mail($to, $subjct, $message); // Отправляем данные на email нового пользователю
				 }
				 else { // Иначе
					$SentEmail = false;
				  }
				
				if ($rezult AND $SentEmail)
				{ // Если информация изменилась  в БД и данные отправились на email пользователю
					echo ("Пользователь успешно обновлен!"); // Выводим успешное сообщенние
				}
				else { // Иначе
					echo ("Извините, но пользователь не обновлен!"); // Выводим сообщенние об ошибки
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