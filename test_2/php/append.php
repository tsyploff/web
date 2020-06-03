
<?php
	require "connect.php";		//подключение базы данных
	require "functions.php";	//подключение дополнительных функций
	$id = (int) $_GET['id'];	//идентификатор для обновления
	$row = get_row_by_id($id);	//текущие данные
?>

<!DOCTYPE html>
<html lang="ru">
	<head>
		<title><?= ($id) ? "Обновление" : "Добавление"?></title>
		<meta charset="UTF-8">
		<style type="text/css">
			a {
				color: blue;			/*цвет текста*/
				font-weight: 600;		/*жирный шрифт*/
			}

			label, input {
				display: inline-block; 	/*волшебная кнопка чтобы всё заработало*/
			}

			label {
				min-width: 200px; 		/*минимальная ширина блока*/
			}

			input {
				min-width: 300px; 		/*минимальная ширина блока*/
			}

			.form-person {
				margin-bottom: 10px; 	/*отступы после input*/
			}
		</style>
	</head>
	<body>
		<a href="/php/tables.php">Назад к списку</a>
		<h1><?= ($id) ? "Обновление старой записи" : "Новая запись"?></h1>
		<form method="POST" action="">
			<div class="form-person"><label>Введите ФИО: </label><input type="text" name="name" <?php 
				if ($id) {
					echo "value='" . $row['name'] . "'";
				} else {
					echo "value='Иванов Иван Иванович'";
				}
				?>></div>
			<div class="form-person"><label>Введите возраст: </label><input type="text" name="age" value=<?= ($id) ? $row['age'] : "20"?>></div>
			<div class="form-person"><label>Введите пол: </label><input type="text" name="sex" value=<?= ($id) ? $row['sex'] : "M"?>></div>
			<div class="form-person"><label>Введите профессию: </label><input type="text" name="job" <?php 
				if ($id) {
					echo "value='" . $row['job_name'] . "'";
				} else {
					echo "value='Дворник'";
				}
				?>></div>
			<input type="submit" value="Отправить">
			<?php
				//обработка пустого $_POST
				if (!isset($_POST['name']) || !isset($_POST['age']) || !isset($_POST['sex']) || !isset($_POST['job'])) {
					die("");
				}

				//ввод данных в переменные
				$name = $_POST['name'];
				$age  = $_POST['age'];
				$sex  = $_POST['sex'];
				$job  = $_POST['job'];
				
				//запрос идентификаторов пола и работы
				$sex_id = ($sex == 'Ж') ? 0 : 1;
				$job_id = get_job_id($job);

				if ($id) {
					//запрос на обновление элемента в базе
					mysqli_query($db, "UPDATE people SET name = '$name', age = '$age', sex_id = '$sex_id', job_id = '$job_id' WHERE id = '$id'");
				} else {
					//запрос на добавление элемента в базу
					mysqli_query($db, "INSERT INTO people(name, age, sex_id, job_id) VALUES ('$name', '$age', '$sex_id', '$job_id')");
				}
			?>
		</form>
	</body>
</html>
