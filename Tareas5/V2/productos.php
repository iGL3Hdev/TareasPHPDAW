<?php

    require_once('include/DB.php');
    require_once('include/CestaCompra.php');
    require_once('Smarty.class.php');

    session_start();

    if(!isset($_SESSION['usuario']))
        die("Error - debe <a href='login.php'>identificarse</a>.<br/>");

    $cesta = CestaCompra::carga_cesta();

    $smarty = new Smarty;
    $smarty->template_dir = 'web/smarty/tarea/templates/';
    $smarty->compile_dir = 'web/smarty/tarea/templates_c/';
    $smarty->config_dir = 'web/smarty/tarea/configs/';
    $smarty->cache_dir = 'web/smarty/tarea/cache/';

    if(isset($_POST['vaciar'])){
        unset($_SESSION['cesta']);
        $cesta = new CestaCompra();
    }

    if(isset($_POST['enviar'])){
        $cesta->nuevo_articulo[$_POST['cod']];
        $cesta->guarda_cesta();
    }

    $smarty->assign('usuario', $_SESSION['usuario']);
    $smarty->assign('productos', DB::obtieneProductos());
    $smarty->assign('productoscesta', $cesta->get_productos());


    $smarty->display('productos.tpl');


?>