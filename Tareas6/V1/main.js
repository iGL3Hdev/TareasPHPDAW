function init() {

    document.getElementById("pais").addEventListener("change", function() {   
        
            let pais  = document.getElementById("pais").value;  
            getProvincias(pais);

    })

    document.getElementById("provincia").addEventListener("change", function() {   
        
            let pais  = document.getElementById("pais").value; 
            let provincia  = document.getElementById("provincia").value;  
            getLocalidades(pais, provincia);

    })
}

function getProvincias(idPais){

    if(idPais != "-1"){

        let llamada = new XMLHttpRequest();
   
   let url = "load-data.php";

   let datos = {

        "metodo":"provincias",
        "idPais":idPais

   };

   let params = "datos=" + JSON.stringify(datos);

   llamada.onreadystatechange = function(){

        if(this.readyState === 4 && this.status === 200){

            console.log(this.responseText);
            let datos = JSON.parse(this.responseText);
            let selectProvincia = document.getElementById("provincia");
            selectProvincia.innerHTML = "";
            datos.forEach(provincia => {
                
                let option = document.createElement("option");
                option.setAttribute("value", provincia.idprovincia);

                let textoProvincia = document.createTextNode(provincia.nombre);
                option.appendChild(textoProvincia);

                selectProvincia.appendChild(option);
            });

            getLocalidades(datos[0].idPais, datos[0].idprovincia);  

        }

    }

    llamada.open("POST", url, true);
    llamada.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    llamada.send(params);

    }else{

        document.getElementById("provincia").innerHTML = "";
        document.getElementById("localidad").innerHTML = "";
    }

}

function getLocalidades(idPais, idProvincia){

    let llamada = new XMLHttpRequest();
   
   let url = "load-data.php";

   let datos = {

        "metodo":"localidades",
        "idPais":idPais,
        "idProvincia":idProvincia

   };

   let params = "datos=" + JSON.stringify(datos);

   llamada.onreadystatechange = function(){

        if(this.readyState === 4 && this.status === 200){

            console.log(this.responseText);
            let datos = JSON.parse(this.responseText);
            let selectLocalidades = document.getElementById("localidad");
            selectLocalidades.innerHTML = "";
            datos.forEach(localidad => {
                
                let option = document.createElement("option");
                option.setAttribute("value", localidad.idLocalidad);

                let textoLocalidad = document.createTextNode(localidad.nombreLocalidad);
                option.appendChild(textoLocalidad);

                selectLocalidades.appendChild(option);
            });

            getLocalidades(datos[0].idPais, datos[0].idprovincia);  
        
        }

    }

    llamada.open("POST", url, true);
    llamada.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    llamada.send(params);

}

window.onload = init;