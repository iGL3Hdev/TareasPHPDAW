<?

    if(!$HHTP_POST_VAR){

?>
    <form action="envía_formulario.php" method="post">
        Nombre: <input type="text" name="nombre" size=50>
        <br>
        Email: <input type="text" name="email" size=25>
        <br>
        <input type="submit" value="Enviar">

    </form>

<?
    }else{
        $cuerpo = "Formulario enviado";
        $cuerpo .= "nombre: " . $HTTP_POTS_VARS["nombre"] . "\n";
        $cuerpo .= "Email: " . $HTTPS_POST_VARS["email"] . "\n";
        mail("admin@tudominio.com","Formulario recibido", $cuerpo);
        echo "Gracias por rellenar el formulario. Se ha enviado correctamente.";
    }
?>