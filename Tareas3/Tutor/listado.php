<?php
require_once 'conexion.php';
$consulta = "select id, nombre from productos order by nombre";
$stmt = $conProyecto->prepare($consulta);
try {
    $stmt->execute();
} catch (PDOException $ex) {
    die("Error al recuperar los productos " . $ex->getMessage());
}
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximumscale=
1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- css para usar Bootstrap -->
    <link rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/
Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Tema 3</title>
</head>

<body style="background: #4dd0e1">
    <h3 class="text-center mt-2 font-weight-bold">Gestión de Productos</h3>
    <div class="container mt-3">
        <a href="crear.php" class='btn btn-success mt-2 mb-2'>Crear</a>
        <table class="table table-striped table-dark">
            <thead>
                <tr class="text-center">
                    <th scope="col">Detalle</th>
                    <th scope="col">Codigo</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($filas = $stmt->fetch(PDO::FETCH_OBJ)) {
                    echo "<tr class='text-center'><th scope='row'><a href='detalle.php?id={$filas->id}' class='btn btn-info'>Detalle</a>";
                    echo "<td>{$filas->id}</td>";
                    echo "<td>{$filas->nombre}</td>";
                    echo "<td>";
                    echo "<form name='a' action='borrar.php' method='POST'
style='display:inline'>";
                    echo "<a href='update.php?id={$filas->id}' class='btn btn-warning mr-
2'>Actualizar</a>";
                    echo "<input type='hidden' name='id' value='{$filas->id}'>"; //mandamos el código del producto a borrar
                    echo "<input type='submit' onclick=\"return confirm('¿Borrar Producto?')\"
class='btn btn-danger' value='Borrar'>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
                $stmt = null;
                $conProyecto = null;
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>