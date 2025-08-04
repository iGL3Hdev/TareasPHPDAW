<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Tarea 2</title>
</head>
<body onload="document.getElementsByName('nombre')[0].focus()">

    <?php
        function existe($miArray, $miNom) {
            $posicion = array_search($miNom, $miArray, false);
            return $posicion;
        }

        if (!empty($_POST['personas'])) {
            $array = explode(",", $_POST['personas']);
            $pos = count($array);
        } else {
            $array = array();
            $pos = 0;
        }

        if (!empty($_POST['nombre'])) {
            $nom = strtolower($_POST['nombre']);
            $si = existe($array, $nom);

            if (!empty($_POST['telefono'])) {
                $tel = $_POST['telefono'];

                if ($si !== false) {
                    $array[$si + 1] = $tel;
                    echo "<div class='altoDch1'><p>Teléfono Cambiado</p></div>";
                } else {
                    $array[$pos] = $nom;
                    $array[$pos + 1] = $tel;
                    echo "<div class='altoDch1'><p>Datos Añadidos</p></div>";
                }
            } else {
                $tel = null;

                if ($si !== false) {
                    unset($array[$si]);
                    unset($array[$si + 1]);
                    $array = array_values($array);
                    echo "<div class='altoDch1'><p>Dato Eliminado</p></div>";
                } else {
                    echo "<div class='altoDch2'><p>Falta el Teléfono</p></div>";
                }
            }
        } else {
            $nom = null;

            if (!empty($_POST['telefono'])) {
                echo "<div class='altoDch2'><p>Falta el nombre</p></div>";
            } else {
                echo "<div class='altoDch2'><p>No ha introducido datos</p></div>";
            }
        }

        if (count($array) > 1) {
            echo "<h1>Listado telefónico:</h1>";
            echo "<table><tr align='center'><th>Nombre</th><th>Teléfono</th></tr>";
            for ($i = 0; $i < count($array); $i += 2) {
                if (isset($array[$i]) && isset($array[$i + 1]))
                    echo "<tr><td>" . htmlspecialchars($array[$i]) . "</td><td>" . htmlspecialchars($array[$i + 1]) . "</td></tr>";
            }
            echo "</table>";
        }
    ?>

    <div class="bajoDch">
        <form name="formulario" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <table style="border: 0px;">
                <tr style="background-color: #8080ff;">
                    <td colspan="2">Introduzca los datos a añadir al listado</td>
                </tr>
                <tr>
                    <td>
                        <fieldset>
                            <legend>Nombre</legend>
                            <input name="nombre" type="text">
                        </fieldset>
                    </td>
                    <td>
                        <fieldset>
                            <legend>Teléfono</legend>
                            <input name="telefono" type="text">
                        </fieldset>
                    </td>
                </tr>
            </table>
            <input name="personas" type="hidden" value="<?php if (isset($array)) echo implode(",", $array); ?>">
            <input type="submit" value="Aplicar cambios">
        </form>
    </div>

</body>
</html>