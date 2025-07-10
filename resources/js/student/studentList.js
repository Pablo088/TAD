 function confirmar(){
    let respuesta = confirm("¿Estás seguro? Esta acción no se puede deshacer");
    
    if(respuesta == true){
        return true;
    } else{
        return false;
    }
}

/*function EnviarSearch(){
    let form = document.getElementById("form-input");
    form.submit();
}*/
