<?php
	// Скрипт для обработке форме входа в админ панель
	require_once("Myfunctions.php"); // Подключаем наши функции
	
	$Userlogin = $_POST["Mylogin"]; // Получаем логин пользователя
	$Userpassword = $_POST["Mypassword"]; // Получаем пароль пользователя
	$rememble = $_POST["rememble"]; // Получаем чексбок

	$Userpass = PassHesh($Userpassword); // Шефруем пароль

	$UserAdmin = getRecFromUser($Userlogin, $Userpass); // В переменную $getRecUser получаем одного пользователя сайта

	// Обрабатываем форму входа в админ панель 
	
	if ($Userlogin == $UserAdmin["Login"] && $Userpass == $UserAdmin["Password"])
		{ // Если пара логин-пароль, совпадают
			session_start(); // Устанавлеваем сессии для текувщей формы
			
			$_SESSION['User'] = array('id' => $UserAdmin["id"], 'role' => $UserAdmin["Role"]); // Записываем в сессию данные о пользователя
			
			if($_POST["rememble"])
			{ // Если выбрана функция Запомнить меня
				setcookie('UserLogin', $_POST["Mylogin"], strtotime('+30 days'), "/"); // Записываем логин в куки
				setcookie('UserPass', $_POST["Mypassword"], strtotime('+30 days'), "/"); // Записываем пароль в куки
			}
			else { // Если не выбрана функция Запомнить меня
				setcookie('UserLogin', $_POST["Mylogin"], strtotime('-30 days')); // Записываем логин в куки
				setcookie('UserPass', $_POST["Mypassword"], strtotime('-30 days')); // Записываем пароль в куки
			}			
		
			exit(); // Останавливаем скрипт
		}
		else {  // Если пара логин-пароль, не совпадают
			echo("Извините, Вы вели не правильно логин или пароль!"); // Выводим информацию об ошибке 
		}
		
		
		

?>цию об ошибке 
		}
		
		

?>