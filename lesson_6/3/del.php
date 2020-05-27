<?php
require "init.php";
$id = (int) $_GET['id'];
$table = mysqli_real_escape_string($db,$_GET['table']);
mysqli_query($db,"delete from `$table` where id = '$id'");
?>
  
<h1>Запись удалена</h1>
<a href="/people.php">Назад к списку</a>