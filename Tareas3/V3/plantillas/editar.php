<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dwes.css">
    <title>Editar</title>
</head>
<body>

    <?php
    
        if(isset($_POST['cod'])) $codigo = $_POST['cod'];
        try {
            $dwes = new PDO("mysql:host=localhost;dbname=dwes", "dwes", "abc123.");
            $dwes->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $error = $e->getCode();
            $mensaje = $e->getMessage();
        }
    ?>

    <div id="encabezado">
        <h1>Tarea 3: Edición de un producto</h1>
    </div>

    <div id="contenido">
        <h2>Producto: </h2>
        <?php
            if(!isset($error) && isset($codidgo)){
                $sql = <<<SQL
                    SELECT cod, nombre, nombre_corto, descripcion, PVP, familia
                    FROM producto 
                    WHERE producto.cod='$codigo'
                    SQL;
                        
                    $resultado = $dwes->query($sql);
                    if($resultado){
                        $row = $resultado->fetch();
                        echo "<form id='form_edit' action='actualizar.php' method='POST'>";
                        $codigo=$row['codigo'];
                        $nombre=$row['nombre'];
                        $nombre_corto=$row['nombre_corto'];
                        $descripcion=$row['descripcion'];
                        $pvp=$row['PVP'];
                        $familia=$row['familia'];
						echo "C&oacute;digo: <input type='text' style='color: #F00;background-color: #ccc;' name='cod' value='$codigo' readonly />";
						echo "<input type='hidden' name='familia' value='$familia' />";
						echo "<fieldset><legend>Nombre corto: </legend><input type='text' name='nombre_corto' value='$nombre_corto' size='50' /></fieldset>";
						echo "<fieldset><legend>Nombre: </legend><textarea name='nombre' rows='3' cols='50' >$nombre</textarea></fieldset>";
						echo "<fieldset><legend>Descripci&oacute;n: </legend><textarea name='descripcion' rows='7' cols='50' >$descripcion)</textarea></fieldset>";
						echo "<fieldset><legend>PVP: </legend><input type='text' name='PVP' value='$pvp'/></fieldset>";
						echo "<input type='submit' value='actualizar' name='actualiza' />";
						echo "<input type='submit' value='cancelar' name='cancela' />";
						echo "</form>";
                    }
            }
        ?>
    </div>
    
</body>
</html>