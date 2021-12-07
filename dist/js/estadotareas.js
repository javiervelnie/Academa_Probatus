document.querySelector("body").addEventListener("load", modificarColor());



function modificarColor(){
    var filaEstado = document.querySelectorAll(".estado");
    filaEstado.forEach(element => {
        if(element.textContent == "Pendiente"){
            element.classList.add('pendiente');
        } 
        
        if(element.textContent == "Corregido"){
            element.classList.add('corregido');
        }
    });
}