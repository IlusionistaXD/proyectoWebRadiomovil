var emailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

$(document).ready(function(){
    //boton y form
    const boton = document.getElementById("boton");
    const form = document.getElementById("formulario");
    //recuperar informacion del formulario
    const placaForm = document.getElementById("placa");
    const modeloForm = document.getElementById("modelo");
    const anioForm = document.getElementById("anio");
    const descriptionForm = document.getElementById("description");

    //escuchamos el evento clik
    boton.addEventListener("click", async(e)=>{
        e.preventDefault();
        
        const placa = placaForm.value;
        const modelo = modeloForm.value;
        const anio = anioForm.value;
        const description = descriptionForm.value;
  

        if(vacio(placa)){
            alert("Por favor introducir la placa");
        };
        if(vacio(modelo)){
            alert("Por favor introducir el modelo");
        };
        if(vacio(anio)){
            alert("Por favor introducir el año");
        };
        if(vacio(description)){
            alert("Por favor introducir una descripcion");
        };
        

        if (!vacio(placa) &&
            !vacio(modelo) &&
            !vacio(anio) &&
            !vacio(description)) {       
        form.submit();
        }
        

    });

});

//Funciones
function vacio(dato) {
    return dato === "";
}

function validarEmail(email){
    if(email.match(emailformat)){
        return true;
    };
    return false;
}