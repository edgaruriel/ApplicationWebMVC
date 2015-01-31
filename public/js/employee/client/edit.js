window.onload = function() {
    document.getElementById("editBtn").onclick = function(){return validation()};
}

function validation(){
    var name = document.getElementById("name").value;
    var last_name = document.getElementById("last_name").value;
    var email = document.getElementById("email").value;
    var ife = document.getElementById("ife").value;

    if(name=="" || last_name=="" || email=="" || ife==""){
        alert("No pueden haber campos vacios");
        return false;
    }

    if(!isNaN(name)){
        alert("No se aceptan numeros en el nombre");
        return false;
    }

    if(!isNaN(last_name)){
        alert("No se aceptan numeros en el apellido");
        return false;
    }

    var expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if ( !expr.test(email) ){
        alert("Ingrese un correo valido");
        return false;
    }

    return true;
}