<?php

    include "../database/conexion.php";
    include "../objetos/usuario.php";

    session_start();

    $_SESSION['nickName'] = $_POST['nickName'];

    $conexion = new Conexion();
    $conexion = $conexion->iniciarDB();

    //Caso admin...
    if($_POST['nickName'] == "admin" && $_POST['password'] == "admin")
    {

        header("Location: ../paginas/paginaPrincipal.php"); //pendiente ver que hacer con el admin...
        exit();

    }
    

    if(buscarCuenta($_POST['nickName'], $_POST['password']))
    {

        header("Location: ../paginas/paginaPrincipal.php");
        exit(); 
    }
    else
    {
        header("Location: ../paginas/login.php");
        exit();
    }


        

?>    