
<?php
	require "connect.php";		//подключение базы данных
	$id = (int) $_GET['id'];	//идентификатор для удаления
	mysqli_query($db, "DELETE FROM people WHERE id = '$id'"); //запрос на удаление
?>

<!DOCTYPE html>
<html lang="ru">
	<head>
		<title>Удаление</title>
		<meta charset="UTF-8">
		<style type="text/css">
			a {
				color: blue;		/*цвет текста*/
				font-weight: 600;	/*жирный шрифт*/
			}
		</style>
	</head>
	<body>
		<h1>Запись удалена</h1>
		<a href="/php/tables.php">Назад к списку</a>
	</body>
</html>
