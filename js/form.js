
// Отправка данных на сервер
function send(event, php){
	console.log("Отправка запроса");
	event.preventDefault ? event.preventDefault() : event.returnValue = false;
	var req = new XMLHttpRequest();
	req.open('POST', php, true);
	req.onload = function() {
		if (req.status >= 200 && req.status < 400) {
		json = JSON.parse(this.response); 
			console.log(json);
			 // ЗДЕСЬ УКАЗЫВАЕМ ДЕЙСТВИЯ В СЛУЧАЕ УСПЕХА ИЛИ НЕУДАЧИ
			if (json.result == "success") {
				 // Если сообщение отправлено
				const form = document.getElementById('form');
				const thank = document.querySelector('.thanks');
				const thankClose = document.querySelector('.thanks__close');
				thankClose.classList.add('thk');
				thank.classList.add('thank-you');
				form.reset();
			} else {
				 // Если произошла ошибка
				alert("Ошибка. Сообщение не отправлено");
			}
		 // Если не удалось связаться с php файлом
		} else {alert("Ошибка сервера. Номер: "+req.status);}}; 
	
	// Если не удалось отправить запрос. Стоит блок на хостинге
	req.onerror = function() {alert("Ошибка отправки запроса");};
	req.send(new FormData(event.target));
	}