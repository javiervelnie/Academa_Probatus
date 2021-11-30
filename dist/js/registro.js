//FUNCION PARA QUE EL BOTON DEL LOGIN TE REGRESE AL LOGIN
const cancelButton = document.querySelector("#btn_cancelar");
cancelButton.addEventListener("click", redirigirToLogin);

function redirigirToLogin() {
    window.location.href = "login.php";
}