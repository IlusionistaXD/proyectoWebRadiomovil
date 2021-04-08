var emailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

$(document).ready(function(){
    //boton y form
    const boton = document.getElementById("boton");
    const form = document.getElementById("formulario");
    //recuperar informacion del formulario
    const nameForm = document.getElementById("name");
    const descriptionForm = document.getElementById("description");

    //escuchamos el evento clik
    boton.addEventListener("click", async(e)=>{
        e.preventDefault();
        
        const name = nameForm.value;
        const description = descriptionForm.value;

        if(vacio(name)){
            alert("Por favor introducir un nombre");
        };
        if(vacio(description)){
            alert("Por favor introducir una descripcion");
        };

        
        if (!vacio(name) &&
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