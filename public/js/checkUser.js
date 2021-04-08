var emailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

$(document).ready(function(){
    //boton y form
    const boton = document.getElementById("boton");
    const form = document.getElementById("formulario");
    //recuperar informacion del formulario
    const nameForm = document.getElementById("name");
    const fullnameForm = document.getElementById("fullname");
    const emailForm = document.getElementById("email");
    const passwordForm = document.getElementById("password");
    const password_confirmationForm = document.getElementById("password_confirmation");
    const ciForm = document.getElementById("ci");
    const addressForm = document.getElementById("address");
    const phoneForm = document.getElementById("phone");
    //const is_adminForm = document.getElementById("is_admin");    

    //escuchamos el evento clik
    boton.addEventListener("click", async(e)=>{
        e.preventDefault();


        const name= nameForm.value;
        const fullname= fullnameForm.value;
        const email= emailForm.value;
        const password= passwordForm.value;
        const password_confirmation = password_confirmationForm.value;
        const ci= ciForm.value;
        const address= addressForm.value;
        const phone= phoneForm.value;
  

        if(vacio(name)){
            alert("Por favor introducir un Nombre");
        };
        if(vacio(fullname)){
            alert("Por favor introducir un Nombre Completo");
        };
        if(vacio(email)){
            alert("Por favor introducir un valor en email");
        }else if(!validarEmail(email)){
            alert("Por favor introducir un email valido");
        };
        if(vacio(password)){
            alert("Por favor introducir un password");
        };
        if(vacio(address)){
            alert("Por favor introducir su direccion");
        };
        if(vacio(password_confirmation)){
            alert("Por favor debe confirmar su password");
        };
        if(vacio(ci)){
            alert("Por favor introducir su CI");
        };
        if(vacio(phone)){
            alert("Por favor introducir un teléfono");
        };

        

        if (!vacio(name) &&
            !vacio(fullname) &&
            validarEmail(email) &&
            !vacio(password) &&
            !vacio(password_confirmation) &&
            !vacio(ci) &&
            !vacio(address) &&
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