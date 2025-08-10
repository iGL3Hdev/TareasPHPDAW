<?php
session_start();

// Arrays de opciones
$idioma = ["Español", "Inglés"];
$perfil = ["Sí", "No"];
$zona   = ["GMT-2", "GMT-1", "GMT", "GMT+1", "GMT+2"];

// Mensaje inicial vacío
$texto = "";

// Si el usuario envía el formulario
if (isset($_POST['enviar'])) {
    $_SESSION['preferencias']['idioma'] = $_POST['idio'];
    $_SESSION['preferencias']['perfil'] = $_POST['perf'];
    $_SESSION['preferencias']['zona']   = $_POST['zon'];

    $texto = "Información guardada en la sesión";
}

// Si ya existen preferencias en la sesión, las cargamos
if (isset($_SESSION['preferencias'])) {
    $idio = $_SESSION['preferencias']['idioma'];
    $perf = $_SESSION['preferencias']['perfil'];
    $zon  = $_SESSION['preferencias']['zona'];
} else {
    // Valores por defecto si no hay nada en sesión
    $idio = $idioma[0];
    $perf = $perfil[0];
    $zon  = $zona[0];

    $_SESSION['preferencias'] = [
        'idioma' => $idio,
        'perfil' => $perf,
        'zona'   => $zon
    ];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tarea.css">
    <title>Preferencias</title>
</head>
<body>

<form id="datos" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <fieldset>
        <legend>Preferencias</legend>

        <span class="mensaje"><?php echo $texto; ?></span>

        <div class="campo">
            <label class="etiqueta">Idioma:</label>
            <select name="idio">
                <?php foreach ($idioma as $value): ?>
                    <option value="<?php echo $value; ?>" <?php if ($value === $idio) echo "selected"; ?>>
                        <?php echo $value; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="campo">
            <label class="etiqueta">Perfil público:</label>
            <select name="perf">
                <?php foreach ($perfil as $value): ?>
                    <option value="<?php echo $value; ?>" <?php if ($value === $perf) echo "selected"; ?>>
                        <?php echo $value; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="campo">
            <label class="etiqueta">Zona horaria:</label>
            <select name="zon">
                <?php foreach ($zona as $value): ?>
                    <option value="<?php echo $value; ?>" <?php if ($value === $zon) echo "selected"; ?>>
                        <?php echo $value; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <input type="submit" value="Establecer preferencias" name="enviar" />

        <div class="campo">
            <a href="mostrar.php">Mostrar preferencias</a>
        </div>
    </fieldset>
</form>

</body>
</html>