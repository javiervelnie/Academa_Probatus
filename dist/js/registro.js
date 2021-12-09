//FUNCION PARA QUE EL BOTON DEL LOGIN TE REGRESE AL LOGIN
const cancelButton = document.querySelector("#btn_cancelar");
cancelButton.addEventListener("click", redirigirToLogin);

document.querySelector("body").addEventListener("load", corregirErrorVisual());

function redirigirToLogin() {
    window.location.href = "index.php";
}

function corregirErrorVisual() {
    var parrafos = document.querySelectorAll("p");

    parrafos.forEach(element => {
        if (element.textContent == '') {
            //console.log("hola")
            element.classList.add('noHayErrores');
            element.innerHTML="algo"
        }
    });
}