
<?php
	//это страница для отображения таблицы
	require 'connect.php'; //подключение базы данных
?>

<!DOCTYPE html>
<html lang="ru">
	<head>
		<title>Студенты</title>
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
		<h1>Студенты</h1>
		<a href="/index.php">На главную страницу</a>
		<table>
			<thead style="font-weight: 600">	<!-- шапка таблицы -->
				<tr>
					<td>ФИО</td>
					<td>Возраст</td>
					<td>Специальность</td>
				</tr>
			</thead>
			<tbody>
				<!-- тело таблицы -->
				<?php
					$query = mysqli_query($db, "SELECT 
						student.id AS id,
						student.fio AS name, 
						student.age AS age, 
						speciality.number AS job_name FROM student LEFT JOIN 
						speciality ON student.speciality_id = speciality.id ORDER BY student.fio"); //запрос на заполнение таблицы
	
					while ($row = mysqli_fetch_assoc($query)) {
						$id   = $row['id'];			//ввод идентификатора в нужную переменную
						$name = $row['name'];		//ввод ФИО в нужную переменную
						$age  = $row['age'];		//ввод возраста в нужную переменную
						$job  = $row['job_name'];	//ввод профессии в нужную переменную
						// $edit = "<a href=/php/append.php?id=$id style='color: green'>Edit</a>";
						// $del  = "<a href=/php/delete.php?id=$id style='color: red'>Delete</a>";
						echo "
						<tr>
							<td>$name</td>
							<td>$age</td>
							<td>$job</td>
						</tr>"; //вывод данных в таблицу

						// <td style='border: none'>$edit</td>
						// <td style='border: none'>$del</td>
					}
				?>
			</tbody>
		</table>
		<!-- <a href="/php/append.php?id=0">Добавить</a> -->
		<form method="GET" action="">
			<div><label>Введите максимальный возраст: </label><input type="text" name="max_age" value="0"></div>
			<div><label>Выберите специальность: </label><select name="specialities">
				<option>Все</option>
				<option>Экономика</option>
				<option>Менеджмент</option>
				<option>ПМ</option>
			</select></div>
			<div><input type="submit" value="Показать"></div>
			<table>
				<thead style="font-weight: 600">	<!-- шапка таблицы -->
					<tr>
						<td>ФИО</td>
						<td>Возраст</td>
						<td>Специальность</td>
					</tr>
				</thead>
				<tbody>
					<?php
						if (!isset($_GET['max_age'])) {
							die("");
						}
						
						$specialities = $_GET['specialities'];	//ввод спициальностей в переменную
						$max_age = $_GET['max_age'];			//ввод максимального возраста в переменную 
						
						if (strcasecmp($specialities, 'Все') != 0) {
							$query = mysqli_query($db, "SELECT 
								student.id AS id,
								student.fio AS name, 
								student.age AS age, 
								speciality.number AS job_name FROM student LEFT JOIN 
								speciality ON student.speciality_id = speciality.id WHERE 
								student.age <= '$max_age' AND speciality.number = '$specialities'"); //запрос на заполнение таблицы
						} else {
							$query = mysqli_query($db, "SELECT 
								student.id AS id,
								student.fio AS name, 
								student.age AS age, 
								speciality.number AS job_name FROM student LEFT JOIN 
								speciality ON student.speciality_id = speciality.id WHERE 
								student.age <= '$max_age'"); //запрос на заполнение таблицы
						}
						
						while ($row = mysqli_fetch_assoc($query)) {
							$id   = $row['id'];			//ввод идентификатора в нужную переменную
							$name = $row['name'];		//ввод ФИО в нужную переменную
							$age  = $row['age'];		//ввод возраста в нужную переменную
							$job  = $row['job_name'];	//ввод профессии в нужную переменную
							echo "
							<tr>
								<td>$name</td>
								<td>$age</td>
								<td>$job</td>
							</tr>"; //вывод данных в таблицу
						}
					?>
				</tbody>
			</table>
		</form>
	</body>
</html>
