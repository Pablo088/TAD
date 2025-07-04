 function confirmar(){
    let respuesta = confirm("¿Estás seguro? Esta acción no se puede deshacer");
    
    if(respuesta == true){
        return true;
    } else{
        return false;
    }
}

function enviar(){
    let form = document.getElementById("filter-form");
    form.submit();
}