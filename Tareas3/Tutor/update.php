<?php
if (!isset($_GET['id'])) { //si no mandamos el id volvemos a listado
    header('Location:listado.php');
}
$id = $_GET['id'];
require_once 'conexion.php';
$consulta = "select cod, nombre from familias order by nombre";
$stmt = $conProyecto->prepare($consulta);
$consulta1 = "select * from productos where id=:i";
$stmt1 = $conProyecto->prepare($consulta1);
try {
    $stmt->execute();
    $stmt1->execute([':i' => $id]);
} catch (PDOException $ex) {
    die("Error al recuperar el producto o la familia " . $ex->getMessage());
}
$producto = $stmt1->fetch(PDO::FETCH_OBJ); //no hace falta while, esta consulta devuelve una fila.
function comprobar($n, $nc)
{
    if (strlen($n) == 0 || strlen($nc) == 0) {
        echo "<b>Algunos campos del formulario No pueden estar en blanco,
reviselos</b>";
        echo " <a href='crear.php'
style='text-decoration:none;'><button>Volver</button></a>";
    }
}
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initialscale=
1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- css para usar Bootstrap -->
    <link rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9I
fjh" crossorigin="anonymous">
    <title>Update</title>
</head>

<body style="background: #4dd0e1">
    <h3 class="text-center mt-2 font-weight-bold">Modificar Producto</h3>
    <div class="container mt-3">
        <?php
        if (isset($_POST['enviar'])) {
            //recogemos los datos del formlario, trimamos las cadenas
            $nombre = trim($_POST['nombre']);
            $nomCorto = trim($_POST['nombrec']);
            $pvp = $_POST['pvp'];
            $des = trim($_POST['descripcion']);
            $familia = $_POST['familia'];
            comprobar($nombre, $nomCorto);
            $nomCorto = strtoupper($nomCorto); //ponemos nombre corto en mayúsculas
            $nombre = ucwords($nombre); //La primera parabra de la cedena en mayúsculas
            $update = "update productos set nombre=:n, nombre_corto=:nc, pvp=:p,
descripcion=:d, familia=:f where id=:i";
            $stmt2 = $conProyecto->prepare($update);
            try {
                $stmt2->execute([
                    ':n' => $nombre,
                    ':nc' => $nomCorto,
                    ':p' => $pvp,
                    ':f' => $familia,
                    ':d' => $des,
                    ':i' => $id
                ]);
            } catch (PDOException $ex) {
                die("Ocurrio un error al actualizar el producto, mensaje de error: " . $ex->getMessage());
            }
            $stmt2 = null;
            $conProyecto = null;
            echo "<p class='text-info font-weight-bold'>Producto Actualizado con Éxito <a
href='listado.php' class='btn btn-info'>Volver</a></p>";
        } else {
        ?>
            <form name="crear" method="POST" action="<?php echo $_SERVER['PHP_SELF'] . "?
id=$id"; ?>">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="n">Nombre</label>
                        <input type="text" class="form-control" id="n" value='<?php echo $producto->nombre ?>' name="nombre" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nc">Nombre Corto</label>
                        <input type="text" class="form-control" id="nc" value='<?php echo $producto->nombre_corto ?>' name="nombrec" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="p">Precio (€)</label>
                        <input type="number" class="form-control" id="p" value='<?php echo $producto->pvp ?>' name="pvp" min="0" step="0.01" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="f">Familia</label>
                        <select class="form-control" name="familia">
                            <?php
                            while ($filas = $stmt->fetch(PDO::FETCH_OBJ)) {
                                if ($filas->cod == $producto->familia)
                                    echo "<option value='{$filas->cod}' selected>$filas->nombre</option>";
                                else
                                    echo "<option value='{$filas->cod}'>$filas->nombre</option>";
                            }
                            $stmt = null;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-9">
                        <label for="d">Descripción</label>
                        <textarea class="form-control" name="descripcion" id="d" rows="12"><?php echo
                                                                                            $producto->descripcion; ?></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mr-3"
                    name="enviar">Modificar</button>
                <a href="listado.php" class="btn btn-info">Volver</a>
            </form>
    </div>
<?php
            $stmt1 = null;
            $conProyecto = null;
        } ?>
</body>

</html>