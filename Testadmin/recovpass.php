<?php
	// Скрипт для обработке форме восстановление пароля админа
	
	require_once("Myfunctions.php"); // Подключаем наши функции
	
	$UserEmail = $_POST["Myemail"]; // Получаем email пользователя
	
	$EmailAdmin = getEmailUser($UserEmail); // Получаем одного пользователя сайт		

	function randomKey($lenKey) 
	{ // Функция для генерации секретного, случайного ключа для восстановление пароля
		return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $lenKey); // Функция str_shuffle() перемешивает символы в строке. Выбирается одна возможная перестановка из всех возможных 
	}
	//echo($EmailAdmin["Email"]);
	
	if ($EmailAdmin["Email"])
	{ // Если есть пользователь с таким Email
		$KeyConfirm = randomKey(7); // Генериюем код подтверждение 
		
		// Отправляем код подтверждения на email пользователя 
		$message = "Уважаемый пользователь, кто-то запросил сброс пароля для вашей учётной записи админ панели блога КАИТ 20! Ваш логин: ".$EmailAdmin["Login"].", чтобы сбросить пароль, введите этот код подтверждение: $KeyConfirm! \nЕсли вы не восстанавливали пароль, просто проигнорируйте это письмо, и ничего не произойдёт."; // Текст сообщение
		$to = $UserEmail; // Кому
		$subjct = "Восстановление пароля для админа блога КАИТ 20!"; // Тема сообшение
		
		$SendEmail = mail($to, $subjct, $message); // Отправляем код подтверждения на email пользователя 
		
		if ($SendEmail)
		{ // Если письмо отправилость пользователю
			session_start(); // Создаюм сессию для проверке кода подтверждения по email пользователя
			
			$_SESSION['confirm'] = array(
		 	'email' => $_POST["Myemail"],
		 	'login' => $EmailAdmin["Login"],
		 	'id' => $EmailAdmin["id"],
		 	'code' => $KeyConfirm
		 	); // Записываем в сессию данные о пользователя
		}
	}
	else
	{ // Иначе
		echo("Пользователь с таким email не найден!");
	}

?>