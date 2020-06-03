
<?php
	//файл с импортируемыми функциями
	function get_job_id($job)
	{
		#возвращает идентификатор професии (если такого нет, то создаёт новый)
		global $db;
		$check_job_id = mysqli_query($db, "SELECT id FROM job WHERE job = '$job'"); //запрос на id професии
		if ($row = mysqli_fetch_assoc($check_job_id)) {	//если профессия уже есть в БД
			return $row['id'];						//запись идентификатора в переменную
		} else {
			mysqli_query($db, "INSERT INTO job(job) VALUES ('$job')");	//запрос на добавление профессии
			$check_job_id = mysqli_query($db, "SELECT id FROM job WHERE job = '$job'");
			$row = mysqli_fetch_assoc($check_job_id);	//поиск идентификатора
			return $row['id'];						//запись идентификатора в переменную
		}
	}

	function get_row_by_id($id)
	{
		#возвращает name, age, sex и job_id
		if ($id) {
			global $db;
			$query = mysqli_query($db, "SELECT 
				people.id AS id,
				people.name AS name, 
				people.age AS age, 
				sex.sex AS sex, 
				job.job AS job_name FROM people LEFT JOIN 
				sex ON people.sex_id = sex.id LEFT JOIN
				job ON people.job_id = job.id WHERE people.id = '$id'"); //запрос на заполнение формы
			return mysqli_fetch_assoc($query); //массив данных
		} else {
			return $id;
		}
	}
