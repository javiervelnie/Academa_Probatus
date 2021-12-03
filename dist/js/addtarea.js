const cancelButton = document.querySelector("#btn_cancelar");
cancelButton.addEventListener("click", refrescarPagina);

function refrescarPagina(){
    window.location.href = "addtarea.php";
}