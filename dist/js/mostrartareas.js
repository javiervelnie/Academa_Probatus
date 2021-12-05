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
	element.addEventListener('click', function () {
		overlay.classList.add('active');
		popup.classList.add('active');
	});
});

btnCerrarPopup.addEventListener('click', function (e) {
	e.preventDefault();
	overlay.classList.remove('active');
	popup.classList.remove('active');
});