<?php


    session_start();
    unset($_SESSION['cesta']);

    die("Gracias por su compra. <br/>Quiere <a href='productos.php'>Comenzar de nuevo?</a>");
?>