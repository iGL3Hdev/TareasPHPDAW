<?php

    require_once('include/CestaCompra.php');
    require_once('Smarty.class.php');

    session_start();

    if(!isset($_SESSION['usuario']))
        die("Error - debe <a href='login.php'>identificarse</a>.<br/>");

    $smarty = new Smarty;
    $smarty->template_dir = 'web/smarty/tarea/templates/';
    $smarty->compile_dir = 'web/smarty/tarea/templates_c/';
    $smarty->config_dir = 'web/smarty/tarea/configs/';
    $smarty->cache_dir = 'web/smarty/tarea/cache/';


    $cesta = CestaCompra::carga_cesta();

    $smarty->assign('usuario', $_SESSION['usuario']);
    $smarty->assign('productoscesta', $cesta->get_productos());
    $smarty->assign('coste', $cesta->get_coste());

    $smarty->display('cesta.tpl');
?>