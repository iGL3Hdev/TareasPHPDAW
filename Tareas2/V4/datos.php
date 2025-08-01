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

    if (!isset($_SESSION['num_solicitud'])) {
        $_SESSION['num_solicitud'] = 1;
    }

    if (isset($_SESSION['error'])) {
    ?>
        <p><?php echo $_SESSION['error']; ?></p>
    <?php
        unset($_SESSION['error']);
    }
    ?>


    <form action="procesa.php" method="POST">
        <fieldset>
            <legend>Datos al <?php echo date_format(date_create(), 'd-m-Y') ?> Número de solicitud: <?php echo $_SESSION['num_solicitud'] ?></legend>

            <h4>Datos Personales</h4>

            <table class="datos-personales">
                <tr>
                    <td>
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" required>
                    </td>
                    <td>
                        <label for="apellidos">Apellidos</label>
                        <input type="text" name="apellidos" id="apellidos" required>
                    </td>
                    <td>
                        <label for="nombre">NIF</label>
                        <input type="nif" name="nif" id="nif" required>
                    </td>
                    <td>
                        <label for="fecha_nac">Fecha Nacimiento:</label>
                        <input type="date" name="fecha_nac" id="fecha_nac" required>
                    </td>
                    <td>
                        <label for="email">Correo Electronico</label>
                        <input type="email" name="email" id="email" required>
                    </td>
                </tr>
            </table>

            <h4>Forma de Acceso</h4>

            <p class="no-margin">
                <input type="radio" name="form_acceso" id="est_uni_sup" value="Universitario Superior" checked>
                <label for="est_uni_sup">Estudios Universitarios Superiores</label>
            </p>

            <p class="no-margin">
                <input type="radio" name="form_acceso" id="est_uni_med" value="Universitario Medio">
                <label for="est_uni_med">Estudios Universitarios Medios</label>
            </p>

            <p class="no-margin">
                <input type="radio" name="form_acceso" id="fp" value="FP">
                <label for="fp">Formación Profesional</label>
            </p>

            <p class="no-margin">
                <input type="radio" name="form_acceso" id="bachillerato" value="Bachillerato">
                <label for="bachillerato">Bachillerato</label>
            </p>

            <p class="no-margin">
                <input type="radio" name="form_acceso" id="prueba_acceso" value="Prueba Acceso">
                <label for="prueba_acceso">Prueba de acceso</label>
            </p>


            <h4>Acceso preferente por: </h4>

            <p class="no-margin">
                <input type="checkbox" name="acceso_pref[]" id="fam_num" value="Familia Numerosa">
                <label for="fam_num">Familia Numerosa</label>
            </p>

            <p class="no-margin">
                <input type="checkbox" name="acceso_pref[]" id="renta_baja" value="Renta">
                <label for="renta_baja">Renta Baja</label>
            </p>

            <p class="no-margin">
                <input type="checkbox" name="acceso_pref[]" id="fam_paro" value="Paro">
                <label for="fam_paro">Familia en paro</label>
            </p>

            <p class="no-margin">
                <input type="checkbox" name="acceso_pref[]" id="minusvalia" value="Minusvalia">
                <label for="minusvalia">Minusvalía</label>
            </p>

            <p class="no-margin">
                <input type="checkbox" name="acceso_pref[]" id="fam_mono" value="Monoparental">
                <label for="fam_mono">Familia Monoparental</label>
            </p>

            <p>
                <input type="reset" value="Borrar todo">
                <input type="submit" value="Enviar">
            </p>

        </fieldset>


    </form>



</body>

</html>