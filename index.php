<?php

session_start();


    if($_SESSION['nickName'] != null)   //Al ingresar verifico si el usuario se ha logueado.
    {
        header("Location: paginaPrincipal.php");
        exit();
    }
    else
    {
        header("Location: login.php");
        exit();
    }



?>