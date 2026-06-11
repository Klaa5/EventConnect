<?php
    session_start();

    if(!empty($_SESSION['nickName']))   //Al ingresar verifico si el usuario se ha logueado.
    {
        if($_SESSION['oldHtml'] == true)  
        {
            header("Location: paginas/old/paginaPrincipal.php");
        }
        else
        {
            header("Location: paginas/paginaPrincipal.php");
        }
        exit();
    }
    else
    {
        if($_SESSION['oldHtml'] == true)  
        {
            header("Location: paginas/old/login.php");
        }
        else
        {
            header("Location: paginas/login.php");
        }
        exit();
       
    }
    
?>
