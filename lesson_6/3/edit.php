<?php
   require 'init.php';
  // error_reporting(E_ALL);
  
   $id = mysqli_real_escape_string($db,$_GET['id']);
   $table = mysqli_real_escape_string($db,$_GET['table']);
   if ( isset($_GET['submit']) ) {
     $table_flds = table_form_fields($table);
     $vals = [];
     foreach($table_flds as $fld=>$dummy) {
       if ($fld != 'id' && isset($_GET[$fld])) {
          $vals[$fld] = mysqli_real_escape_string($db, $_GET[$fld]);
       }
     }
     if ($id) { // INSERT
       // fio='$fio', age='$age', job_id='$job_id'
       $str = '';
       foreach($vals as $fld=>$val) {
         $str .=  "$fld='$val', ";
       }
       $str = substr($str, 0, -2);
       $sql = "UPDATE $table SET $str WHERE id = '$id'";
     } else { // UPDATE
       $str_flds = '';
       $str_vals = '';
       foreach($vals as $fld=>$val) {
         $str_flds .= "$fld, ";
         $str_vals .= "'$val', ";
       }
       $str_flds = substr($str_flds, 0, -2);
       $str_vals = substr($str_vals, 0, -2);
       
       $sql = "INSERT INTO $table($str_flds) VALUES($str_vals)"; 
     }
     echo $sql;
     $result = mysqli_query($db, $sql);
     if (!$result) {
       echo mysqli_error($db);
       die("Error!");
     }
     if (!$id) {
       $id = mysqli_insert_id($db);
     }
   }
   $query = mysqli_query($db, "select * from $table where id = $id ");
   $fio = $age = $job_id = "";
   if ($row = mysqli_fetch_assoc($query)) {
     $title = 'Edit record'; 
   } else {
     $title = 'Add New Record'; 
   }
   $flds = table_form_fields($table);


?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <title><?=$title?></title>
  <meta charset="UTF-8">
</head>
<body> 
  <h1><?=$title?></h1>
  <form>
  <input type="hidden" name="table" value="<?=$table?>">
  <? foreach ($flds as $fld): ?>  
      <? $fld_name = $fld['name']; ?>
	  <label><?=$fld['label']?></label>
      <? if ($fld['type'] == 'select') : ?>
          <select name="<?=$fld_name?>">
             <?=print_options($fld['options_table'],$row[$fld_name]) ?>
          </select>   
      <? else :?>
   		  <input name="<?=$fld_name?>" type="<?=$fld['type']?>" value="<?=$row[$fld_name]?>"> <br>
     <? endif ?>  
  <? endforeach ?>  
  <input type="submit" name="submit" value="Save">
  </form>
  <a href="/people.php">Вернуться к списку людей</a>
 </body>
 </html>