<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarea 6 DWES</title>
    <script src="main.js"></script>
</head>

<body>

    <?php
        require "conexion.php";
        require "dao.php";
        require "Alumno.php";

        try {
            $dao = new Dao($db);
        } catch (Exception $e) {
            $dao = null;
            echo "<p>Error al conectar con la base de datos: " . $e->getMessage() . "</p>";
        }

        if (isset($_POST['enviar']) && $dao) {
            $dni = $_POST['dni'];
            $nombre = $_POST['nombre'];
            $apellido1 = $_POST['apellido1'];
            $apellido2 = $_POST['apellido2'];
            $edad = $_POST['edad'];

            if ($_POST['pais'] != "-1") {
                $pais = $_POST['pais'];
                $provincia = $_POST['provincia'] ?? '';
                $localidad = $_POST['localidad'] ?? '';

                $alumno = new Alumno($dni, $nombre, $apellido1, $apellido2, $edad, $pais, $provincia, $localidad);
                $dao->insertarAlumno($alumno);
            } else {
                echo "<h3>Debes seleccionar un país</h3>";
            }
        }
    ?>

    <form method="POST" name="formulario">

        <label for="dni">Escribe tu DNI</label>
        <input type="text" name="dni" id="dni">
        <br> <br>
        <label for="nombre">Escribe tu Nombre</label>
        <input type="text" name="nombre" id="nombre">
        <br> <br>
        <label for="apellido1">Escribe tu primer apellido</label>
        <input type="text" name="apellido1" id="apellido1">
        <br> <br>
        <label for="apellido2">Escribe tu segundo apellido</label>
        <input type="text" name="apellido2" id="apellido2">
        <br> <br>
        <label for="edad">Escribe tu edad</label>
        <input type="text" name="edad" id="edad">
        <br> <br>
        <label for="pais"> Indica tu país </label>
        <select name="pais" id="pais">
            <option value="-1">Seleccione un pais</option>
            <?php
                    $paises = $dao->listarPaises();
                    foreach ($paises as $key => $pais) {
                        echo "<option value='" . $pais->idPais . "'>" . $pais->nombrePais . "</option>";
                    }       
                  
            ?>
        </select>
        <br> <br>
        <label for="provincia"> Indica tu provincia </label>
        <select name="provincia" id="provincia">

        </select>
        <br> <br>
        <label for="localidad"> Indica tu localidad </label>
        <select name="localidad" id="localidad">

        </select>

        <br> <br>
        <input type="submit" name="enviar" value="Insertar alumno" />

    </form>

</body>

</html>