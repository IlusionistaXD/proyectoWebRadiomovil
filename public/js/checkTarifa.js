var emailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

$(document).ready(function(){
    //boton y form
    const boton = document.getElementById("boton");
    const form = document.getElementById("formulario");
    //recuperar informacion del formulario
    const nameForm = document.getElementById("name");
    const tramoForm = document.getElementById("tramo");
    const precioForm = document.getElementById("precio");
    const id_promocionForm = document.getElementById("id_promocion");
    const id_servicioForm = document.getElementById("id_servicio");



    //escuchamos el evento clik
    boton.addEventListener("click", async(e)=>{
        e.preventDefault();
        
        const name = nameForm.value;
        const tramo = tramoForm.value;
        const precios = precioForm.value;
        const id_promocion = id_promocionForm.value;
        const id_servicio = id_servicioForm.value;

        if(vacio(name)){
            alert("Por favor introducir un nombre");
        };
        if(vacio(tramo)){
            alert("Por favor introducir un tramo");
        };
        if(vacio(precios)){
            alert("Por favor introducir el precio");
        };
        if(vacio(id_promocion)){
            alert("Por favor introducir una promocion");
        };
        if(vacio(id_servicio)){
            alert("Por favor introducir un servicio");
        };
        

        if (!vacio(name) &&
            !vacio(tramo) &&
            !vacio(precios) &&
            !vacio(id_servicio) &&
            !vacio(id_promocion)) {       
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