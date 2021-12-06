var overlay = document.getElementById('overlay'),
	popup = document.getElementById('popup'),
	btnCerrarPopup = document.getElementById('btn-cerrar-popup');

const btnAbrirPopup = document.querySelectorAll('.btn-abrir-popup');
/*
btnAbrirPopup.addEventListener('click', function () {
	overlay.classList.add('active');
	popup.classList.add('active');
});*/



btnAbrirPopup.forEach(element => {
	element.addEventListener('click', function (event) {
		overlay.classList.add('active');
		popup.classList.add('active');
		const button = event.target;
		const item = button.closest('.fila');

		/*VALORES DEL POP-UP */
		const itemId = document.querySelector(".id-value");
		const itemAsignatura = document.querySelector(".asignatura-value");
		const itemDescripcion = document.querySelector(".descripcion-value");
		const itemEstado = document.querySelector(".estado-value");
		const itemArchivo = document.querySelector(".tarea-value");
		const itemFechacreacion = document.querySelector(".fcreacion-value");

		/*AÑADO A LOS VALORES DE LA TABLA AL POP-UP*/
		itemId.value = item.querySelector(".id-hidden").textContent;
		itemAsignatura.value = item.querySelector(".btn-abrir-popup").textContent;
		itemDescripcion.innerHTML = item.querySelector(".descripcion").textContent;
		itemEstado.value = item.querySelector(".estado").textContent;
		if(item.querySelector(".estado").textContent == "Pendiente"){
			itemEstado.classList.add('pendiente');
		} else {
			itemEstado.classList.add('corregido');
		}
		
		if(item.querySelector(".archivo").textContent = null){
			itemArchivo.innerHTML = "<input type='file'>";
		}
		itemFechacreacion.value = item.querySelector(".fechacreacion").textContent;
        
		const itemCabeceraTarea = document.querySelector('.cabeceratarea');
		itemCabeceraTarea.innerHTML = "Actualizar tarea de " + item.querySelector(".btn-abrir-popup").textContent;
	});
});

btnCerrarPopup.addEventListener('click', function (e) {
	e.preventDefault();
	overlay.classList.remove('active');
	popup.classList.remove('active');
});