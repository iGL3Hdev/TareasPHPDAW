<?php
if (!isset($_GET['id'])) { //si no mandamos el id volvemos a listado
    header('Location:listado.php');
}
$id = $_GET['id'];
require_once 'conexion.php';
$consulta = "select * from productos where id=:i";
$stmt = $conProyecto->prepare($consulta);
try {
    $stmt->execute([':i' => $id]);
} catch (PDOException $ex) {
    die("Error al recuperar el producto, mensaje de error: " . $ex->getMessage());
}
$producto = $stmt->fetch(PDO::FETCH_OBJ); //no hace falta while, esta consulta devuelve una fila.
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initialscale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- css para usar Bootstrap -->
    <link rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9I
fjh" crossorigin="anonymous">
    <title>Detalle</title>
</head>

<body style="background: #4dd0e1">
    <h3 class="text-center mt-2 font-weight-bold">Detalle Producto</h3>
    <div class="container mt-3">
        <div class="card text-white bg-info mt-5 mx-auto" style="max-width: 58rem;">
            <div class="card-header text-center text-weight-bold">
                <?php echo $producto->nombre; ?>
            </div>
            <div class="card-body" style="font-size: 1.1em">
                <h5 class="card-title text-center"><?php echo "Codigo: " . $producto->id;
                                                    ?></h5>
                <p class="card-text"><b>Nombre:</b><?php echo $producto->nombre; ?></p>
                <p class="card-text"><b>Nombre Corto: </b> <?php echo $producto->nombre_corto;
                                                            ?></p>
                <p class="card-text"><b>Codigo Familia: </b><?php echo $producto->familia
                                                            ?></p>
                <p class="card-text"><b>PVP (€): </b><?php echo $producto->pvp; ?></p>
                <p class="card-text"><b>Descripción: </b><?php echo $producto->descripcion; ?></p>
            </div>
        </div>
        <div class="container mt-5 text-center">
            <a href="listado.php" class="btn btn-info">Volver</a>
        </div>
    </div>
    <?php
    $stmt = null;
    $conProyecto = null;
    ?>
</body>

</html>