var emailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

$(document).ready(function(){
    //boton y form
    const boton = document.getElementById("boton");
    const form = document.getElementById("formulario");
    //recuperar informacion del formulario
    const id_userForm = document.getElementById("id_user");
    const id_servicioForm = document.getElementById("id_servicio");
    const id_movilForm = document.getElementById("id_movil");


    //escuchamos el evento clik
    boton.addEventListener("click", async(e)=>{
        e.preventDefault();
        
        const id_user = id_userForm.value;
        const id_servicio = id_servicioForm.value;
        const id_movil = id_movilForm.value;

        if(vacio(id_user)){
            alert("Por favor introducir un precio valido");
        };
        if(vacio(id_servicio)){
            alert("Por favor introducir un id de proramacion");
        };
        if(vacio(id_movil)){
            alert("Por favor introducir un nombre de servicio valido");
        };
        

        if (!vacio(id_user) &&
            !vacio(id_servicio) &&
            !vacio(id_movil)) {       
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