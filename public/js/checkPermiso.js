var emailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

$(document).ready(function(){
    //boton y form
    const boton = document.getElementById("boton");
    const form = document.getElementById("formulario");
    //recuperar informacion del formulario
    const id_userForm = document.getElementById("id_user");
    const motivoForm = document.getElementById("motivo");
    const fec_iniForm = document.getElementById("fec_ini");
    const fec_finForm = document.getElementById("fec_fin");



    //escuchamos el evento clik
    boton.addEventListener("click", async(e)=>{
        e.preventDefault();
        
        const id_user = id_userForm.value;
        const motivo = motivoForm.value;
        const fec_ini = fec_iniForm.value;
        const fec_fin = fec_finForm.value;

        if(!validate_fechaMayorQue(fec_ini,fec_fin)){
            alert("La fecha final no es mayor a la fecha inicial");
        };
        if(vacio(id_user)){
            alert("Por favor introducir un nombre valido");
        };
        if(vacio(motivo)){
            alert("Por favor introducir un tramo valido");
        };
        if(vacio(fec_ini)){
            alert("Por favor introducir la fecha de inicio");
        };
        if(vacio(fec_fin)){
            alert("Por favor introducir la fecha de fin");
        };
        

        if (!vacio(id_user) &&
            !vacio(motivo) &&
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