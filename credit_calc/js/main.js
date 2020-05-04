
function bntCalcClick() {
	var A = Number(document.querySelector("input[name='credit-sum']").value); 				//современная стоимость ренты
	var i = Number(document.querySelector("input[name='credit-per-cent']").value) / 1200; 	//процентная ставка (сразу переводится в мес. в доли)
	var n = Number(document.querySelector("input[name='credit-period']").value); 			//срок (мес)
	var R = A*i / (1 - (1 + i)**(-n)); 														//ежемесячный платёж
	document.querySelector("input[name='credit-monthly-payment']").value = R.toFixed(2); 	//вывод в input

	document.querySelector("input[name='overpay']").value = (R*n - A).toFixed(2);					//перплата
	document.querySelector("input[name='overpay-percent']").value = ((R*n - A)/A * 100).toFixed(2);	//процент переплаты

	var table = document.querySelector("table.credit tbody"); 	//таблица в конце
	var tr, perc, arrA = [], arrR = [], arrPerc = [];			//для заполнения таблицы
	table.innerHTML = "";										//очищаем таблицу
	R = parseFloat(R.toFixed(2)); 								//округляем платёж
	
	for (var j = 1; j <= n; j++) {								//определяем цикл для заполнения таблицы
		tr = table.insertRow();									//вставляем новую строку
		
		tr.insertCell().innerHTML = j;							//помещаем номер месяца в первый столбец
		
		perc = A*i;												//процент
		A += perc;												//долг увеличивает на процент
		A = parseFloat(A.toFixed(2)); 							//округляем долг
		tr.insertCell().innerHTML = A;							//помещаем долг с % во второй столбец
		
		if (j == n) 											//если месяц последний, 
			R = A.toFixed(2);									//то надо выплатить весь остаток
		tr.insertCell().innerHTML = R;							//помещаем платёж в третий столбец
		
		A -= R;													//долг уменьшается на платёж
		A = parseFloat(A.toFixed(2)); 							//округляем долг
		tr.insertCell().innerHTML = A;							//помещаем остаток долга после платежа в четвёртый столбец

		arrR.push(R)											//сохраняем платёж
		arrPerc.push(perc)										//сохраняем процент
		arrA.push(A) 											//сохраняем остаток долга
	}

	debt_dynamics_plot(arrA);						//рисуем график динамики долга
	payment_and_interest_schedule(arrR, arrPerc);	//рисуем график платежей и процентов
}

function debt_dynamics_plot(arrA) {
	var ctx = document.querySelector(".first-plot canvas").getContext('2d'); 	//место, где будем рисовать
	var myChart = new Chart(ctx, {												//создаём объект Chart
		type: 'line',															//тип графика
		data: {																	//данные
			labels:   range(arrA.length),										//метки на оси (?)
			datasets: [{														//линии
				label: 'Динамика долга',										//название линии
				data: arrA,														//данные
				borderColor: 'green'											//цвет
			}]
		},
	});
}

function payment_and_interest_schedule(arrR, arrPerc) {
	var ctx = document.querySelector(".second-plot canvas").getContext('2d'); 	//место, где будем рисовать
	var myChart = new Chart(ctx, {												//создаём объект Chart
		type: 'line',															//тип графика
		data: {																	//данные
			labels:   range(arrR.length),										//метки на оси (?)
			datasets: [{														//линии
				label: 'Платёж',												//название линии
				data: arrR,														//данные
				borderColor: 'orange'											//цвет
			}, {														
				label: 'Проценты',												//название линии
				data: arrPerc,													//данные
				borderColor: 'green'											//цвет
			}]
		},
	});
}

function range(n) {
	return [...Array(n).keys()]; //делает список от одного до n
}
