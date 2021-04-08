var emailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

$(document).ready(function(){
    //boton y form
    const boton = document.getElementById("boton");
    const form = document.getElementById("formulario");
    //recuperar informacion del formulario
    const fec_iniForm = document.getElementById("fec_ini");
    const fec_finForm = document.getElementById("fec_fin");
    const id_servicioForm = document.getElementById("id_servicio");

    //cant.style.display = "none";



    //escuchamos el evento clik
    boton.addEventListener("click", async(e)=>{
        e.preventDefault();

        const fec_ini = fec_iniForm.value;
        const fec_fin = fec_finForm.value;
        const servicio = id_servicioForm.value;
        
        
        
    
        if(servicio=="3"){
            form.submit();
        }else{

            if(servicio!="3"){
                if(vacio(fec_ini)){
                    alert("Por favor introducir la fecha de inicio");
                };
                if(vacio(fec_fin)){
                    alert("Por favor introducir la fecha de fin");
                };
            }
            
            if (validate_range(fec_ini, fec_fin) &&
            !vacio(fec_ini) &&
            !vacio(fec_fin)) {     
                form.submit();
            };
        };

        
        

    });

});

function validate_range(fechaInicial,fechaFinal){
        let ini = new Date (fechaInicial);
        let fin = new Date (fechaFinal);

        var difference = fin.getTime()-ini.getTime();

        var days = difference/(1000*60*60*24);
        
        if (days<0){
            alert ('La fecha final no debe ser menor a la inicial');
            return false;
        };
        if (days>10){
            alert ('Por favor el rango seleccionado no debe ser mayor a 10 dias');
            return false;
        };
        return true;
}

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