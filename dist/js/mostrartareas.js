const overlay = document.querySelector('#overlay');

/*
btnAbrirPopup.addEventListener('click', function () {
	overlay.classList.add('active');
	popup.classList.add('active');
});*/

const btnAbrirPopup = document.querySelectorAll('.btn-abrir-popup');
const divPopup = document.querySelector('#popup');

btnAbrirPopup.forEach(element => {
	element.addEventListener('click', function () {
		addToCartClicked();
		overlay.classList.add('active');
		divPopup.classList.add('active');
	});
});

/**************************************************/

function addToCartClicked(event) {
	const button = event.target;
	const item = button.closest(".fila"); //El elemento mas cercano al boton sobre el que clicamos que tenga la clase piezas

	const itemAsignatura = item.querySelector("td .btn-abrir-popup").textContent;
	const itemDescripcion = item.querySelector("td .descripcion").textContent;
	const itemFechaCorreccion = item.querySelector("td .fechacreacion").textContent;
	const itemEstado = item.querySelector("td .filaEstado").textContent;
	const itemTarea = item.querySelector("td .archivo").textContent;

	addItemToShoppingCart(itemAsignatura, itemDescripcion, itemFechaCorreccion, itemEstado, itemTarea);
	
}

function addItemToShoppingCart(itemAsignatura, itemDescripcion, itemFechaCorreccion, itemEstado, itemTarea) {

	const tareaContent = `
	<a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
				<h3>Actualizar tarea de </h3>
				<h4>Detalles</h4>
				<form id="principal" action="" method="POST" name="formulario">
	
					<div class="contenedor-inputs lado-izquierdo">
						<table id="tabla">
							<tr>
								<td class="title">Asignatura</td>
								<td class="value">${itemAsignatura}</td>
							</tr>
							<tr>
								<td class="title">Estado</td>
								<td class="value">${itemEstado}</td>
							</tr>
							<tr>
								<td class="title">Fecha de creacion</td>
								<td class="value">${itemFechaCorreccion}</td>
							</tr>
							<tr>
								<td class="title">Tarea</td>
								<td class="value"><input type="file" name="archivo" id="archivo">${itemTarea}</td>
							</tr>
						</table>
					</div>
	
					<div class="contenedor-inputs lado-derecho">
						<div>
							<h5 class="descripcion">Descripcion</h5>
							<textarea>${itemDescripcion}</textarea>
						</div>
					</div>
	
	
					<div class="divBotones">
						<button>Actualizar</button>
					</div>
	
				</form>
	`;

	divPopup.append(tareaContent);

	const	btnCerrarPopup = document.querySelector('#btn-cerrar-popup');

	btnCerrarPopup.addEventListener('click', function (e) {
		e.preventDefault();
		overlay.classList.remove('active');
		divPopup.classList.remove('active');
	});
}