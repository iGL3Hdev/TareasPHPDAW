<?php

    $datosRecibidos = json_decode($_POST['datos']);

    require "dao.php";
    require "conexion.php";
    $dao = new Dao($db);

    if($datosRecibidos->metodo == "provincias"){

        $datosDevolver = $dao->listarProvincias($datosRecibidos->idPais); 

    }else if($datosRecibidos->metodo == "localidades"){

        $datosDevolver = $dao->listarLocalidades($datosRecibidos->idPais, $datosRecibidos->idProvincia); 
    }

    echo json_encode($datosDevolver);

?> 