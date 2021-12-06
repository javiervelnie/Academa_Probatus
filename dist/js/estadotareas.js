document.querySelector("body").addEventListener("load", modificarColor());



function modificarColor(){
    var filaEstado = document.querySelectorAll(".filaEstado");
    filaEstado.forEach(element => {
        if(element.textContent == "Pendiente"){
            element.classList.add('pendiente');
        } 
        
        if(element.textContent == "Corregido"){
            element.classList.add('corregido');
        }
    });
}