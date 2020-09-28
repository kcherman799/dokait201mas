<?php
	// Скрипт для обработки формы смены пароля от учетной записы
	
	require_once("Myfunctions.php"); // Подключаем наши функции

	session_start(); // Устанавлеваем сессии для текувщей формы
	
	$KeyConfitm = htmlspecialchars($_POST["KeyConfirm"]); // Получаем значение поля Код подтведение
	$NewPassword = htmlspecialchars($_POST["Newpass"]); // Получаем значение поля Новый пароль
	$Newpass = PassHesh($NewPassword); // Шефруем новый пароль
	
	if($_SESSION['confirm']['code'] == $KeyConfitm)
	{ // Если код подтвердение совпадает

		$id = $_SESSION['confirm']['id']; // Получаем id пользователя
		$Login = $_SESSION['confirm']['login']; // Получаем логин пользователя
		$Email = $_SESSION['confirm']['email']; // Получаем Email пользователя
				
		$UpdatePass = recovPassUser($Login, $Newpass, $Email); // Обновляем пароль
		//echo($id);		
		if($UpdatePass)
		{ // Если пароль сминился
			$_SESSION["id"] = $id; // Открываем сессию для данного пользователя
		}
		else 
			{ // Иначе
				echo("Пароль не сменился!");
			}

	}
	else 
	{ // Иначе
		echo("Неверный код подтвердение!");
	}
?>