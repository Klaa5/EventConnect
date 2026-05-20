<?php
    session_start();
    if(!empty($_SESSION['nickName']))   //Al ingresar verifico si el usuario se ha logueado.
    {
        header("Location: paginas/paginaPrincipal.php");
        exit();
    }
    else
    {
        header("Location: paginas/login.php");
        exit();
    }
    
?>
