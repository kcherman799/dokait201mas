<?php

	function getRecFromNewsinfodb ($id)
		{ // Функция №1 для получение записей из таблице newsinfodb
			$linkDB = mysqli_connect('localhost', 'root', '', 'dokait201masdb'); // Подключаемся к БД dokait201masdb

			$queryDB = mysqli_query($linkDB, 'SET NAMES `UTF8`'); // Устанавливаем кодировку для БД dokait201masdb

			if (!$linkDB or !$queryDB)
			{ // Если у нас есть ошибки в подключение к БД
				echo ("Ошибка в подключение к БД"); // Выводим сообщенние об ошибки
			}

			$mySQLdb = mysqli_query($linkDB, "SELECT * FROM `newsinfodb` WHERE 'id'= $id ORDER BY $id DESC"); // Получаем одно запись из таблицы newsinfodb, БД dokait201masdb, которое упорядочени по полу id, по убивание

			$mySQLarray = array(); // Создаем массив для храниние всех записей таблицы newsinfodb, БД dokait201masdb
			$rec = true; // Переменная для получиние записей из таблицы newsinfodb, БД dokait201masdb
			$i = 0;

			while ($rec)
			{ // Цикл для первращиния всех записей newsinfodb, БД dokait201masdb в ассоциативный массив (В ассоциативном массивы, индексы элементов могуть быть записаны в виды названий полей ) и записываем массив в переменную reс
				$rec = mysqli_fetch_array($mySQLdb); // Первращаем одну запись в ассоциативный массив
				$mySQLarray[$i] = $rec; // Записываем каждую запись в виде массива (rec) в новый массив mySQLarray
				$i++; // Переходим к следеющей записы таблици
			}

			return($mySQLarray[]); // Возвращаем массив
		}

	function contrRecFromNewsinfodb ($title, $Intro_text, $Full_text)
		{ // Функция №2 для записы в таблицу newsinfodb
			$linkDB = mysqli_connect('localhost', 'root', '', 'dokait201masdb'); // Подключаемся к БД dokait201masdb

			$queryDB = mysqli_query($linkDB, 'SET NAMES `UTF8`'); // Устанавливаем кодировку для БД dokait201masdb

			if (!$linkDB or !$queryDB)
			{ // Если у нас есть ошибки в подключение к БД
				echo ("Ошибка в подключение к БД"); // Выводим сообщенние об ошибки
			}
			
			$result = mysqli_query($linkDB, "INSERT INTO newsinfodb (Title, Intro_text, Full_text) VALUES ('$title', '$Intro_text', '$Full_text')"); // Занёсем данные из формы в БД 
			
			if ($result == true)
				{ // Если информация занеслась в БД
					/*return*/ echo ("Информация занесена в базу данных"); // Выводим успешное сообщенние
				}
				else { // Если информация не занеслась в БД
					echo "Информация не занесена в базу данных"; // Выводим сообщенние об ошибки
				}
			
		}


	function getRecFromUser ($Userlogin, $Userpassword)
		{ // Функция №3 для получение записей из таблице user
			$linkDB = mysqli_connect('localhost', 'root', '', 'dokait201masdb'); // Подключаемся к БД dokait201masdb

			$queryDB = mysqli_query($linkDB, 'SET NAMES `UTF8`'); // Устанавливаем кодировку для БД dokait201masdb

			if (!$linkDB or !$queryDB)
			{ // Если у нас есть ошибки в подключение к БД
				echo ("Ошибка в подключение к БД"); // Выводим сообщенние об ошибки
			}

			$Myusers = mysqli_query($linkDB, "SELECT * FROM `user` WHERE ('Login'= $Userlogin) AND ('Password'= $Userpassword"); // Получаем одну запись из таблицы user, БД dokait201masdb 
	
			$mySQLarray = array(); // Создаем массив для храниние всех записей таблицы newsinfodb, БД dokait201masdb

			$rec = true; // Переменная для получиние записей из таблицы newsinfodb, БД dokait201masdb
			$i = 0;
			while ($rec)
			{ // Цикл для первращиния всех записей newsinfodb, БД dokait201masdb в ассоциативный массив и записываем массив в переменную reс
				$rec = mysqli_fetch_array($Myusers); // Первращаем одну запись в ассоциативный массив
				$mySQLarray[$i] = $rec; // Записываем каждую запись в виде массива (rec) в новый массив mySQLarray
				$i++;
			}
			
			return($mySQLarray[]); // Возвращаем массив
		}

	function regicFromRegwelcon ($Famile, $Name, $Patron, $Phone, $Email, $Shkool, $Class, $Date, $Time)
		{ // Функция №2.1 для регистации на участие в дни открый дверый в коллежда и записы в таблицу regwelcon ???
			$linkDB = mysqli_connect('localhost', 'root', '', 'dokait201masdb'); // Подключаемся к БД dokait201masdb

			$queryDB = mysqli_query($linkDB, 'SET NAMES `UTF8`'); // Устанавливаем кодировку для БД dokait201masdb

			if (!$linkDB or !$queryDB)
			{ // Если у нас есть ошибки в подключение к БД
				echo ("Ошибка в подключение к БД"); // Выводим сообщенние об ошибки
			}
			
			$result  = mysqli_query($Mydbconnect, "INSERT INTO regwelcon (Famile, Name, Patron, Phone, Email, Shkool, Class, Date, Time) VALUES ('$Famile', '$Name', '$Patron', '$Phone', '$Email', '$Shkool', '$Class', '$Date', '$Time')"); // Занёсем данные из формы в БД 
			
			if ($result == true)
				{ // Если информация занеслась в БД
					/*return*/ echo ("Информация занесена в базу данных"); // Выводим успешное сообщенние
				}
				else { // Если информация не занеслась в БД
					echo "Информация не занесена в базу данных"; // Выводим сообщенние об ошибки
				}
			
		}


?>