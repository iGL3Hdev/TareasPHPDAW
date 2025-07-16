<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Tarea 2 DAW</title>
</head>
<body>

    <?php

        session_start();

        $dni = $_POST['nif'];
        $numDNI= substr($dni, 0, -1);
        $letraDNI = substr($dni, -1, 1);

        $letras = 'TRWAGMYFPDXBNJZSQVHLCKET';

        $indice = $numDNI % 23;
        $letraCalc = substr($letras, $indice, 1);

        if($letraDNI != $letraCalc){
            $_SESSION['error'] = "El NIF no es correcto";
            header('Location: Datos.php');
        }else{

            $_SESSION['num_solicitud'] = $_SESSION['num_solicitud'] + 1;


            $baremo = array(
                "Universitario Superior" => 10,
                "Universitario Medio" => 8,
                "FP" => 6,
                "Bachillerato" => 6, 
                "Prueba Acceso" => 4,
                "Familia Numerosa" => 4,
                "Renta" => 4,
                "Paro" => 4,
                "Minusvalia" => 5,
                "Monoparental" => 5
            );

            $diferencia = date_diff(date_create($_POST['fecha_nac']), date_create());
            $edad = $diferencia -> format('%y');
    }

    ?>

    <form action="datos.php" method="POST">

    <fieldset>
        <legend>BAREMACIÓN AL <?php echo date_format(date_create(), 'd-m-Y') ?></legend>

        <p>
            <b>SOLICITANTE: <?php echo $_POST['nombre'] . ' ' . $_POST['apellidos'] . ' NIF: ' . $_POST['nif']; ?> </b>
        </p>
        <p>
            <b>Edad en el año <?php echo date("Y") ?>: <?php echo $edad?> </b>
        </p>
        <p>
            <b>Puntos por titulación: </b>

            <ul>
                <li><?php echo $_POST['form_acceso']?>: <?php echo $baremo[$_POST['form_acceso']]; ?></li>
            </ul>
        </p>
        <p>
            <b>Acceso preferente: </b>
            <?php 
            $totalAccesoPref = 0;
            if(isset($_POST['acceso_pref'])){
                ?>
                <ul><?php
                        foreach($_POST['acceso_pref'] as $key => $value){
                            ?>
                                <li><?php echo $value . ':' . $baremo[$value]; ?></li>
                            <?php
                            $totalAccesoPref = $totalAccesoPref + $baremo[$value];
                        } 
                    ?>
                </ul>
                <?php
            }
            
            ?>
        </p>

        <p>
            <b>Puntos por acceso preferente: <?php echo $totalAccesoPref?></b>

        </p>

        <p>
            <b>Total Puntos obtenidos: <?php echo $totalAccesoPref + $baremo[$_POST['form_acceso']]; ?></b>

        </p>




        <input type="submit" value="Volver">
    </fieldset>
    </form>
    


</body>
</html>