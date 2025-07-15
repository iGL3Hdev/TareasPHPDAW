<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Tarea DWES V3</title>
</head>
<body>

<?php

    session_start();

    if(!isset($_SESSION['contactos'])){
        $_SESSION['contactos'] = array();
    }

    $aviso = "";

    if(isset($_POST['aniadir'])){

        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];

        if(empty($nombre)){
            $aviso = "El nombre es obligatorio!!!";
        }else if(!isset($_SESSION['contactos'][$nombre]) && empty($telefono)){
            $aviso = "El telefono es obligatorio";
        }else if(isset($_SESSION['contactos'][$nombre]) && empty($telefono)){
            $aviso = "El contacto ha sido borrado";
            unset($_SESSION['contactos'][$nombre]);
        }else{

             $contacto = array(
            "nombre" => $nombre,
            "telefono" => $telefono,
            );

            if(isset($_SESSION['contactos'][$nombre])){
                $aviso = "El contacto ha sido actualizado";
            }else{
                $aviso = "El contacto ha sido creado";
            }


            $_SESSION['contactos'][$nombre] = $contacto;
        }

    }

    if(isset($_GET['vaciar'])){

        $aviso = "Todos los contactos han sido borrados ";
        $_SESSION['contactos'] = array();

    }

    if(!empty($aviso)){
        ?>
        <p class="aviso"><?php echo $aviso; ?></p>
        <?php
    }


?>

<div class="agenda">

    <h4>Agenda</h4>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

        <?php
            if(count($_SESSION['contactos']) > 0){
                ?>
                <fieldset>
                    <legend>Datos Agenda</legend>
                        <table>
                            <?php
                            foreach($_SESSION['contactos'] as $key => $value){
                                ?>
                                <tr>
                                    <td><?php echo $value['nombre']; ?></td>
                                    <td><?php echo $value['telefono']; ?></td>
                                </tr>
                                <?php
                            } 
                        ?>
                        </table>  
                </fieldset>
                <?php
            }
        ?>
        

        <fieldset>
            <legen>Nuevo Contacto</legen>

            <table>
                <tr>
                    <td>
                        <label for="nombre">Nombre</label>
                    </td>
                    <td>
                        <input type="text" name="nombre" id="nombre">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="telefono">Teléfono</label>
                    </td>
                    <td>
                        <input type="text" name="telefono" id="telefono">
                    </td>
                </tr>
            </table>
           

            <button type="submit" name="aniadir">Añadir contacto</button>
            <button type="reset">Limpiar campos</button>
        </fieldset>

    </form>

    <?php

        if(count($_SESSION['contactos']) > 0){
            ?>

                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
                    <fieldset>
                    <legend>Vaciar Agenda</legend>
                    <button type="submit" name="vaciar" value="1">Vaciar</button>
                </fieldset>
    
                </form>

            <?php
        }

    ?>

</div>
    
</body>
</html>