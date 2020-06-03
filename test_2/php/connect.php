
<?php
	$db = mysqli_connect("localhost", "u11", "magenta_july", "u11_test_2"); //подключение базы данных

	if (!$db) //обработка ошибки подключения
		echo "error!" . mysqli_connect_error();
	
	mysqli_set_charset($db, 'utf8'); //установка кодировки
