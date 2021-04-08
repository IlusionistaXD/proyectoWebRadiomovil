var emailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

$(document).ready(function(){
    //boton y form
    const boton = document.getElementById("boton");
    const form = document.getElementById("formulario");
    //recuperar informacion del formulario
    const nameForm = document.getElementById("name");
    const fullnameForm = document.getElementById("fullname");
    const addressForm = document.getElementById("address");
    const ciForm = document.getElementById("ci");
    const phoneForm = document.getElementById("phone");
                                         




    //escuchamos el evento clik
    boton.addEventListener("click", async(e)=>{
        e.preventDefault();

        const name= nameForm.value;
        const fullname= fullnameForm.value;
        const ci= ciForm.value;
        const phone= phoneForm.value;
        const address= addressForm.value;    

        if(vacio(name)){
            alert("Por favor introducir un Nombre");
        };
        if(vacio(fullname)){
            alert("Por favor introducir un Nombre Completo");
        };
        if(vacio(address)){
            alert("Por favor introducir una Direccion");
        };
        if(vacio(ci)){
            alert("Por favor introducir su CI");
        };
        if(vacio(phone)){
            alert("Por favor introducir un teléfono");
        };
        

        if (!vacio(name) &&
            !vacio(fullname) &&
            !vacio(ci) &&
            !vacio(phone)) {
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