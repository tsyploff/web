<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
     </head>
     <body>
<?php
   require 'init.php';
  // error_reporting(E_ALL);
   echo '<h1>People</h1>';
   $table = 'people';


   $query = mysqli_query($db, "select p.*, job.name as job_name from people p left join job on p.job_id = job.id");
   echo "<table>";
   echo "<tr><th>fio</th><th>age</th><th>sex</th><th>job</th><th>Action</th></tr>";
   while ($row = mysqli_fetch_assoc($query)) {
      $fio = $row['fio'];
      $age = $row['age'];
      $sex = $row['sex']==1 ? 'M' : 'F';
      $job = $row['job_name'];
      $id = $row['id'];
      $edit_link = "<a href='/edit.php?id=$id&table=people'>Edit</a>";
      $del_link = "<a href='/del.php?id=$id&table=people'>Del</a>";
     echo "<tr><td>$fio<td>$age<td>$sex<td>$job<td>$edit_link $del_link</tr>";
   }
   echo '</table>';
?>
     <a href="/edit.php?id=0&table=<?=$table?>">Добавить</a>
      </body>
</html>