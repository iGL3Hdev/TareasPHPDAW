

function emailValido(texto){

    if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3,4})+$/.test(texto)){

        alert("La dirección de email" + texto + "es correcta");

    }else{

        alert("La direción de email es incorrecta");

    }
}