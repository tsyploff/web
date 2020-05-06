<?php
    require 'init.php';
    // error_reporting(E_ALL);
    $id = (int) $_GET['id'];
    if (isset($_GET['submit'])) {
    	$fio = $_GET['fio'];
    	$age = $_GET['age'];
    	mysqli_query($db, "UPDATE people SET fio = '$fio', age = '$age' WHERE id = '$id'");
    }
    $query = mysqli_query($db, "SELECT * FROM people WHERE id=$id"); //запрос на все данные таблицы people4
    $row = mysqli_fetch_assoc($query); //результат запроса
    $fio = $row['fio'];
    $age = $row['age'];
    $title = 'Редактировать: ' .$fio;
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8"> <!-- кодировка -->
        <title>People</title> <!-- название вкладки -->
    </head>
    <body>
    	<h1><?=$title?></h1>
        <a href="/people.php">Back</a> <!-- ссылка на главную страницу -->        
        
        <form>
        	<input type="hidden" name="id" value="<?=$id?>">
        	<label>Фамилия: </label><input name="fio" type="text" value="<?=$fio?>"><br>
        	<label>Возраст: </label><input name="age" type="text" value="<?=$age?>"><br>
        	<input type="submit" name="submit" value="Сохранить">
        </form>

    </body>
</html>
