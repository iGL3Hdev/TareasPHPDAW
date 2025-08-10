<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dwes.css">
    <title>Listado</title>
</head>
<body>
    
    <?php
    
        if(isset($_POST['cod']))$codigo = $_POST['cod'];
        try {
            $dwes = new PDO("mysql:host=localhost;dbname=dwes", "dwes","abc123.");
            $dwes->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $error = $e->getCode();
            $mensaje = $e->getMessage();
        }
    ?>

    <div id="encabeado">
        <h1>Tarea 3: Listado de productos de una familia</h1>
        <form id="form_listado" action="<?php $_SERVER['PHP_SELF']?>" method="POST">
            <span>Familia: </span>
            <select name="cod">
                <?php
                    if(!isset($error)){
                        $sql = "SELECT cod, nombre FROM familia";
                        $resultado = $dwes->query($sql);
                        if($resultado){
                            $row = $resultado->fetch();
                            while($row != null){
                                echo "<option value='${row['cod']}'";
                                if(isset($codigo)&&$codigo == $row['cod'])
                                    echo "selected = 'true'";
                                echo ">".htmlentities($row['nombre'])."</option>";
                                $row = $resultado->fetch();
                            }
                        }
                    }
                ?>
            </select>
            <input type="submit" value="Mostrar" name="enviar">
        </form>
    </div>
    <div id="contenido">
        <h2>Productos de la familia: </h2>
        <?php
            if(!isset($error) && isset($codigo)){
                $sql = <<<SQL
                    SELECT producto.*
                    FROM producto INNER JOIN familia ON producto.familia=familia.cod
                    WHERE familia.cod='$codigo'
                    SQL;
                
                    $resultado = $dwes->query($sql);
                    if($resultado){
                        $row = $resultado->fetch();
                        while($row != null){
                            echo '<form id="form" action="editar.php" method="POST">';
                            $codPro=$row['cod'];
                            $nombre=$row['nombre'];
                            $nombre_corto=$row['nombre_corto'];
                            $pvp=$row['PVP'];

                            echo "<input type='hidden' name='cod' value='$codPro'/>";
                            echo "<p>Producto <b>$nombre_corto</b> PVP: <b>$pvp &euro;</b>";
                            echo "<input type='submit' value='Editar' name='edit'/></p>";
                            echo "</form>";
                            $row=$resultado->fetch();
                        }
                    }
            }
        ?>
    </div>

</body>
</html>