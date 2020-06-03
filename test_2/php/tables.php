
<?php
	//это страница для отображения таблицы
	require 'connect.php'; //подключение базы данных
?>

<!DOCTYPE html>
<html lang="ru">
	<head>
		<title>Таблицы</title>
		<meta charset="UTF-8">
		<style type="text/css">
			table {
				margin: 15px 0px;			/*вертикальные отступы*/
				border-collapse: collapse;	/*стиль границ таблицы*/
			}

			th, td {
				border: 1px solid black;	/*стиль границ таблицы*/
				padding: 15px;				/*отступы внутри ячеек*/
				text-align: left;			/*выравнивание текста*/
			}

			a {
				color: blue;				/*цвет текста*/
				font-weight: 600;			/*жирный шрифт*/
			}
		</style>
	</head>
	<body>
		<h1>Люди</h1>
		<a href="/index.php">На главную страницу</a>
		<table>
			<thead style="font-weight: 600">	<!-- шапка таблицы -->
				<tr>
					<td>ФИО</td>
					<td>Возраст</td>
					<td>Пол</td>
					<td>Профессия</td>
				</tr>
			</thead>
			<tbody>
				<!-- тело таблицы -->
				<?php
					$query = mysqli_query($db, "SELECT 
						people.id AS id,
						people.name AS name, 
						people.age AS age, 
						sex.sex AS sex, 
						job.job AS job_name FROM people LEFT JOIN 
						sex ON people.sex_id = sex.id LEFT JOIN
						job ON people.job_id = job.id"); //запрос на заполнение таблицы
	
					while ($row = mysqli_fetch_assoc($query)) {
						$id   = $row['id'];			//ввод идентификатора в нужную переменную
						$name = $row['name'];		//ввод ФИО в нужную переменную
						$age  = $row['age'];		//ввод возраста в нужную переменную
						$sex  = $row['sex'];		//ввод пола в нужную переменную
						$job  = $row['job_name'];	//ввод профессии в нужную переменную
						$edit = "<a href=/php/append.php?id=$id style='color: green'>Edit</a>";
						$del  = "<a href=/php/delete.php?id=$id style='color: red'>Delete</a>";
						echo "
						<tr>
							<td>$name</td>
							<td>$age</td>
							<td>$sex</td>
							<td>$job</td>
							<td style='border: none'>$edit</td>
							<td style='border: none'>$del</td>
						</tr>"; //вывод данных в таблицу
					}
				?>
			</tbody>
		</table>
		<a href="/php/append.php?id=0">Добавить</a>
	</body>
</html>
