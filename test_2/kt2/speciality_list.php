
<?php
	//это страница для отображения таблицы
	require 'connect.php'; //подключение базы данных
?>

<!DOCTYPE html>
<html lang="ru">
	<head>
		<title>Специальности</title>
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
		<h1>Специальности</h1>
		<a href="/index.php">На главную страницу</a>
		<table>
			<thead style="font-weight: 600">	<!-- шапка таблицы -->
				<tr>
					<td>Специальность</td>
					<td>Количество</td>
					<td>Специальность</td>
				</tr>
			</thead>
			<tbody>
				<!-- тело таблицы -->
				<?php
					$query = mysqli_query($db, "SELECT 
						speciality.number AS job_name,
						COUNT(student.id) AS quantity,
						AVG(student.age) AS average FROM speciality LEFT JOIN 
						student ON student.speciality_id = speciality.id GROUP BY speciality.number"); //запрос на заполнение таблицы
	
					while ($row = mysqli_fetch_assoc($query)) {
						$name = $row['job_name'];		//ввод ФИО в нужную переменную
						$age  = $row['quantity'];		//ввод возраста в нужную переменную
						$job  = $row['average'];	//ввод профессии в нужную переменную
						echo "
						<tr>
							<td><a href='/kt2/student.php?max_age=100&specialities=$name'>$name</a></td>
							<td>$age</td>
							<td>$job</td>
						</tr>"; //вывод данных в таблицу
					}
				?>
			</tbody>
		</table>
		
	</body>
</html>
