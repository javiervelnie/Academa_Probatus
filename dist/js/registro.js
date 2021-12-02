//FUNCION PARA QUE EL BOTON DEL LOGIN TE REGRESE AL LOGIN
const cancelButton = document.querySelector("#btn_cancelar");
cancelButton.addEventListener("click", redirigirToLogin);

function redirigirToLogin() {
    window.location.href = "login.php";
}

function corregirErrorVisual() {
    var parrafos = document.querySelectorAll("p");
    console.log("🚀 ~ file: registro.js ~ line 11 ~ corregirErrorVisual ~ parrafos", parrafos)

    parrafos.forEach(element => {
        if (element.textContent == '') {
            //console.log("hola")
            element.classList.add('noHayErrores');
            element.innerHTML="algo"
        }
    });
}


document.querySelector("body").addEventListener("load", corregirErrorVisual());