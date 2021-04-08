var emailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

$(document).ready(function(){
    //boton y form
    const boton = document.getElementById("boton");
    const form = document.getElementById("formulario");
    //recuperar informacion del formulario
    const nameForm = document.getElementById("name");
    const descriptionForm = document.getElementById("description");
    const fec_iniForm = document.getElementById("fec_ini");
    const fec_finForm = document.getElementById("fec_fin");



    //escuchamos el evento clik
    boton.addEventListener("click", async(e)=>{
        e.preventDefault();
        
        const name = nameForm.value;
        const description = descriptionForm.value;
        const fec_ini = fec_iniForm.value;
        const fec_fin = fec_finForm.value;

        if(!validate_fechaMayorQue(fec_ini,fec_fin)){
            alert("La fecha final no es mayor a la fecha inicial");
        };
            
        if(vacio(name)){
            alert("Por favor introducir un nombre");
        };
        if(vacio(description)){
            alert("Por favor introducir una descripcion");
        };
        if(vacio(fec_ini)){
            alert("Por favor introducir la fecha de inicio");
        };
        if(vacio(fec_fin)){
            alert("Por favor introducir la fecha de fin");
        };
        

        if (!vacio(name) &&
            !vacio(description) &&
            validate_fechaMayorQue(fec_ini, fec_fin) &&
            !vacio(fec_ini) &&
            !vacio(fec_fin)) {       
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

function validate_fechaMayorQue(fechaInicial,fechaFinal)
{
    valuesStart=fechaInicial.split("-");
    valuesEnd=fechaFinal.split("-");
    // Verificamos que la fecha no sea posterior a la actual
    var dateStart=new Date(valuesStart[0],(valuesStart[1]-1),valuesStart[2]);
    var dateEnd=new Date(valuesEnd[0],(valuesEnd[1]-1),valuesEnd[2]);

    if(dateStart>=dateEnd)
    {
        return false;
    }
    return true;
}