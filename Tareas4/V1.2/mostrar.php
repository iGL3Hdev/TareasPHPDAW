<?php
session_start();

// Inicializar variables para evitar "Undefined variable"
$idioma = '';
$perfil = '';
$zona   = '';
$texto  = '';

if (isset($_POST['borrar'])) {
    $texto = "Información de la sesión eliminada";
    unset($_SESSION['preferencias']);
} elseif (isset($_SESSION['preferencias'])) {
    $idioma = $_SESSION['preferencias']['idioma'];
    $perfil = $_SESSION['preferencias']['perfil'];
    $zona   = $_SESSION['preferencias']['zona'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tarea.css">
    <title>Mostrar</title>
</head>
<body>

    <form id="datos" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <fieldset>
            <legend>Preferencias</legend>

            <span class="mensaje"><?php echo $texto; ?></span>

            <div class="campo">
                <label class="etiqueta">Idioma:</label>
                <br>
                <label class="texto"><?php echo $idioma; ?></label>
            </div>

            <div class="campo">
                <label class="etiqueta">Perfil público:</label>
                <br>
                <label class="texto"><?php echo $perfil; ?></label>
            </div>

            <div class="campo">
                <label class="etiqueta">Zona horaria:</label>
                <br>
                <label class="texto"><?php echo $zona; ?></label>
            </div>

            <input type="submit" value="Borrar preferencias" name="borrar" />

            <div class="campo">
                <a href="preferencias.php">Establecer preferencias</a>
            </div>
        </fieldset>
    </form>

</body>
</html>