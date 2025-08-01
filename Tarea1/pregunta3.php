
<?PHP

$conexion = mysqli_connect($db_host, $db_usuario, $db_contra);

$sql = "SELECT email FROM TABLA WHERE email=$email";
$resultado = mysqli_query($aql, $conexion);
if(mysqli_num_rows($resultado) != 0){
    echo "Ya existe un usuario con ese email";
}else{
    echo "Se pueden grabar los datos";
}

?>