<?php
require_once 'conexion.php';
$consulta = "select cod, nombre from familias order by nombre";
$stmt = $conProyecto->prepare($consulta);
try {
    $stmt->execute();
} catch (PDOException $ex) {
    die("Error al recuperar los productos " . $ex->getMessage());
}
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
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximumscale=
1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- css para usar Bootstrap -->
    <link rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/
Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Crear</title>
</head>

<body style="background: #4dd0e1">
    <h3 class="text-center mt-2 font-weight-bold">Crear Producto</h3>
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
            $nombre = ucwords($nombre);
            $insert = "insert into productos(nombre, nombre_corto, pvp, familia,
descripcion) values(:n, :nc, :p, :f, :d)";
            $stmt1 = $conProyecto->prepare($insert);
            try {
                $stmt1->execute([
                    ':n' => $nombre,
                    ':nc' => $nomCorto,
                    ':p' => $pvp,
                    ':f' => $familia,
                    ':d' => $des
                ]);
            } catch (PDOException $ex) {
                die("Ocurrio un error al insertar el producto, mensaje de error: " . $ex->getMessage());
            }
            $stmt1 = null;
            $conProyecto = null;
            echo "<p class='text-info font-weight-bold'>Producto Guardado con Éxito <a
href='listado.php' class='btn btn-info'>Volver</a></p>";
        } else {
        ?>
            <form name="crear" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="n">Nombre</label>
                        <input type="text" class="form-control" id="n" placeholder="Nombre"
                            name="nombre" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nc">Nombre Corto</label>
                        <input type="text" class="form-control" id="nc" placeholder="Nombre Corto"
                            name="nombrec" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="p">Precio (€)</label>
                        <input type="number" class="form-control" id="p" placeholder="Precio (€)"
                            name="pvp" min="0" step="0.01"
                            required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="f">Familia</label>
                        <select class="form-control" name="familia">
                            <?php
                            while ($filas = $stmt->fetch(PDO::FETCH_OBJ)) {
                                echo "<option value='{$filas->cod}'>$filas->nombre</option>";
                            }
                            $stmt = null;
                            $conProyecto = null;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-9">
                        <label for="d">Descripción</label>
                        <textarea class="form-control" name="descripcion" id="d" rows="12"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mr-3" name="enviar">Crear</button>
                <input type="reset" value="Limpiar" class="btn btn-success mr-3">
                <a href="listado.php" class="btn btn-info">Volver</a>
            </form>
    </div>
<?php } ?>
</body>

</html>