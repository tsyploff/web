<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"> <!-- кодировка -->
        <title>People</title> <!-- название вкладки -->
    </head>
    <body>
        <a href="/people.php">Back</a> <!-- ссылка на главную страницу -->

        <?php
            require 'init.php';
            // error_reporting(E_ALL);
            echo '<h1>People</h1>'; //заголовок страницы
            $id = (int) $_GET['id'];
            $query = mysqli_query($db, "SELECT * FROM people WHERE id=$id"); //запрос на все данные таблицы people4
            $row = mysqli_fetch_assoc($query); //результат запроса
            $fio = $row['fio'];
            $age = $row['age'];
        ?>

        <label>Фамилия: </label><input name="fio" type="text" value="<?=$fio?>"><br>
        <label>Возраст: </label><input name="fio" type="text" value="<?=$age?>"><br>
    </body>
</html>
