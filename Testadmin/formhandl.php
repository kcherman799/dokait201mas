<?php
// Скипт для обработки формы заявки на участие в дни открытый дверый в коллежда 
	require_once("Myfunctions.php"); // Подключаем наши функции

	$Famile = htmlentities($_POST["famile"]); // Получаем данные о фамилие
	$Name = htmlentities($_POST["name"]); // Получаем данные о имяне
	$Patron = htmlentities($_POST["patron"]); // Получаем данные о отчестве
	$Phone = htmlentities($_POST["phone"]); // Получаем данные о телефоне
	$Email = htmlentities($_POST["email"]); // Получаем данные о email
	$School = $_POST["school"]; // Получаем данные о школы
	$Class = htmlentities($_POST["class"]); // Получаем данные о классе
	$Dateviz = htmlentities($_POST["dateviz"]); // Получаем данные о дате
	$Time = htmlentities($_POST["time"]); // Получаем данные о времяне
	
	
	// Отправка формы на email админа и записываем данные в БД
	 
	$message = "ФИО: ".$Famile. " ". $Name. " ". $Patron. ".\n Телефон: ".$Phone. ".\n Email: ".$Email.  ".\n Школа: ".$School. ". Класс: ".$Class.  ".\n Дата и время приезда в коллежд: ". $Dateviz. ", в ".$Time; // Само сообщение
	
	$from = $Email; // От кого
	$subjct = "День открытых дверей в КАИТЕ"; // Тема сообшение
     
	$SentBD = regicFromRegwelcon ($Famile, $Name, $Patron, $Phone, $Email, $School, $Class, $Dateviz, $Time); // Записываем данный в БД
	$admin = getEmalAdmin(); // Получаем список emailов администраторов 
	
	for($i=0; $i<count($admin); $i++)
	{ // Цикл для отправки формы админу сайта
		$EmailAdmin = $admin[$i]; // Получаем одного админа
		$to = $EmailAdmin["Email"]; // Кому
		$header ='From:'. $from . "\r\n" . 'Reply-To:'. $to .  "\r\n" . 'X-Mailer: PHP/' . phpversion(); // Заголовок сообшение, (от кого, перенос на новую строку, кому мы будем отвечать, перенос на новую строку, запокоеваем сообшение с помощью php, версия Php)
		$SentEmail[$i] = mail($to, $subjct, $message, $header); // Отправляем данные на email админа 
	}
     
    if ($SentBD && $SentEmail)
	{ // Если данные записены в БД и отправлены на email админа 
		echo('Сообщение успешно отправлено!');
	}
	else { // Иначе
		echo('Сообщение не отправлено!');
	}

?>