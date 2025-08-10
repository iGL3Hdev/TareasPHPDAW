<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dwes.css">
    <title>Actualizar</title>
</head>
<body>

    <?php
    
        if(isset($_post['cod']))$codigo = $_POST['cod'];
        try {
            $dews = new PDO("mysql:host=localhost;dbname=dwes", "dwes", "abc123.");
            $dwes->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $error = $e->getCode();
            $mensaje = $e->getMessage();
        }
    ?>

    <div id="contenido">
        <h2>Producto</h2>
        <?php
            if(!isset($error) && isset($codigo)){
                $ok=true;
                $nombre=$_POST['nombre'];
                $nombre_corto=$POST['nombre_corto'];
                $descripcion=$POST['descripcion'];
                $PVP=$POST['PVP'];
                $familia=$POST['familia'];

                $sql="SELECT * FROM producto WHERE cod='$codigo'";
                echo "<form id'form_actualiza' action='listado.php method='post'>";
                echo "<p>Codigo: <b>$codigo</b></p>";
                echo "<p>NOMBRE: <b><input type='text' value='$nombre' disabled /></b></p>";
				echo "<p>NOMBRE CORTO: <b><input type='text' value='$nombre_corto' disabled /></b></p>";
				echo "<p>DECRIPCI&Oacute;N: <b><input type='text' size='70' value='".substr($descripcion,0,60)."...' disabled /></b></p>";
				echo "<p>PVP: <b><input type='text' value='$PVP' disabled /></b></p>";
				echo "<p>FAMILIA: <b><input type='text' value='$familia' disabled /></b></p>";

                if(isset($_POST['actualiza'])){
                    $dwes->beginTransaction();
                    $sql = "UPDATE producto SET nombre='$nombre', nombre_corto='$nombre_corto' ,descripcion='$descripcion',PVP='$PVP'";
                    $sql .= "WHERE cod='$codigo'";
						if ($dwes->exec($sql) == 0) $ok = false;
						if($ok==true){
							$dwes->commit();
							echo "<h2>Se han actualizado los datos</h2>";
						}else{
							$dwes->rollback();
							echo "<h2>NO HA SIDO POSIBLE ACTUALIZAR LOS DATOS</p>";
						}
						unset($dwes);

					}else{
						echo "<h2>Ha pulsado 'cancelar'</h2>";
					}
					echo "<input type='hidden' name='cod' value='$familia' />";
					echo "<input type='submit' value='continuar' name='continua' />";
					echo "</form>";
            }   
        ?>
    </div>
    
</body>
</html>