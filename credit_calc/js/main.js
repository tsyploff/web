
function bntCalcClick() {
	var A = Number(document.querySelector("input[name='credit-sum']").value); 				//современная стоимость ренты
	var i = Number(document.querySelector("input[name='credit-per-cent']").value) / 1200; 	//процентная ставка (сразу переводится в мес. в доли)
	var n = Number(document.querySelector("input[name='credit-period']").value); 			//срок (мес)
	var R = A*i / (1 - (1 + i)**(-n)); 														//ежемесячный платёж
	document.querySelector("input[name='credit-monthly-payment']").value = R.toFixed(2); 	//вывод в input

	var table = document.querySelector("table.credit tbody"); 	//таблица в конце
	var tr, arrA = [];											//для заполнения таблицы
	table.innerHTML = "";										//очищаем таблицу
	R = parseFloat(R.toFixed(2)); 								//округляем платёж
	
	for (var j = 1; j <= n; j++) {								//определяем цикл для заполнения таблицы
		tr = table.insertRow();									//вставляем новую строку
		
		tr.insertCell().innerHTML = j;							//помещаем номер месяца в первый столбец
		
		A += A*i;												//долг увеличивает на процент
		A = parseFloat(A.toFixed(2)); 							//округляем долг
		tr.insertCell().innerHTML = A;							//помещаем долг с % во второй столбец
		
		if (j == n) 											//если месяц последний, 
			R = A.toFixed(2);									//то надо выплатить весь остаток
		tr.insertCell().innerHTML = R;							//помещаем платёж в третий столбец
		
		A -= R;													//долг уменьшается на платёж
		A = parseFloat(A.toFixed(2)); 							//округляем долг
		tr.insertCell().innerHTML = A;							//помещаем остаток долга после платежа в четвёртый столбец

		arrA.push(A) 											//сохраняем остаток долга
	}

	plot(arrA)	//рисуем график
}

function plot(arrA) {
	var ctx = document.querySelector(".plot canvas").getContext('2d'); 	//место, где будем рисовать
	var myChart = new Chart(ctx, {										//создаём объект Chart
		type: 'line',													//тип графика
		data: {															//данные
			labels:   range(arrA.length),								//метки на оси (?)
			datasets: [{												//линии
				label: 'Динамика долга',								//название линии
				data: arrA												//данные
			}]
		},
	});
}

function range(n) {
	return [...Array(n).keys()]; //делает список от одного до n
}