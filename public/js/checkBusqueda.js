var emailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

$(document).ready(function(){
    //boton y form
    const boton = document.getElementById("boton_busqueda");
    const form = document.getElementById("form_busqueda");
    //recuperar informacion del formulario
    const dataForm = document.getElementById("dato");
    const rolForm = document.getElementById("rolvalue");

    let output = document.getElementById('output');
    rolForm.style.display = 'none';

    const rol = rolForm.value;

    //escuchamos el evento clik
    boton.addEventListener("click", async ()=>{
        output.innerHTML = '';
        const datoSend = dataForm.value;
        
        if ((datoSend!="")&&(rol!=="")){

            let url = "https://www.tecnoweb.org.bo/inf513/grupo12sa/proy2/public/busquedas/"+datoSend+"/"+rol;
            const dataRequest = {
                method: 'GET',
            };

            let response = await fetch(url, dataRequest);
            
            let result= await response.json();
            
            var size = Object.keys(result).length;

            let i=0;
            let tabla;

            while (i<size){
                entry=result[i];
                i=i+1;
                output.innerHTML += "<p> "+ "  "+ i +". <a href='" + entry[0]+ "'>" + datoSend + " se encontro en la Tabla " + entry[1] + "</a> </p>";
            }

        };

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