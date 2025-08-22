<?php

    require_once('include/DB.php');
    require_once('include/Ordenador.php');  
    require_once('Smarty.class.php');

    session_start();

    if(!isset($_SESSION['usuario']))
        die("Error - debe <a href='login.php'>Identificarse</a>.<br/>");

    $smarty = new Smarty;
    $smarty->template_dir = 'web/smarty/tarea/templates/';
    $smarty->compile_dir = 'web/smarty/tarea/templates_c/';
    $smarty->config_dir = 'web/smarty/tarea/configs/';
    $smarty->cache_dir = 'web/smarty/tarea/cache/';

    if(isset($_GET['codigo'])){
        $smarty->assign('correcto', true);
        $miordenador = DB::obtieneOrdenador($_GET['codigo']);
        $ordenador = new Ordenador($miordenador);

        $smarty->assign('ordenador', $ordenador);
        $smarty->assign('usuario', $_SESSION['usuario']);

    }else{
        $smarty->assign('correcto', false);
    }

    $smarty->display('ordenadro.tpl');

?>