<?php

    require_once('include/DB.php');
    require_once('Smarty.class.php');

    $smarty = new Smarty;
    $smarty->template_dir = 'web/smarty/tarea/templates/';
    $smarty->compile_dir = 'web/smarty/tarea/templates_c/';
    $smarty->config_dir = 'web/smarty/tarea/configs/';
    $smarty->cache_dir = 'web/smarty/tarea/cache/';
    $smarty->assign('error', '');

    if(isset($_POST['enviar']) && isset($_POST['usuario']) && isset($_POST['password'])){
        if(empty($_POST['usuario']) || empty($_POST['password'])){
            $smarty->assign('error','Debes introducri un nombre de usuario y una contraseña');
        }else{
            if(DB::verificaCliente($_POST['usuario'], $_POST['password'])){
                session_start();
                $_SESSION['usuario'] = $_POST['usuario'];
                header("Location:productos.php");
            }else{
                $smarty->assign('error', 'Usuario o contraseña no válidos!');
            }
        }
    }

    $smarty->display('login.tpl');





?>