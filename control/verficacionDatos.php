<?php

    include "../database/conexion.php";
    include "../objetos/usuario.php";
    include "../database/funcionesDB.php";

    session_start();
    
    $conexion = new Conexion();
    $conexion = $conexion->iniciarDB();


    if($_POST["action"] == "Iniciar Sesión")
    {
        //Caso admin...
        if($_POST['nickName'] == "admin" && $_POST['password'] == "admin")
        {
            $_SESSION['nickName'] = $_POST['nickName'];
            header("Location: ../paginas/paginaPrincipal.php"); //pendiente ver que hacer con el admin...
            exit();

        }
        

        if(buscarCuenta($_POST['nickName'], $_POST['password'], $conexion, 0))
        {
            $_SESSION['nickName'] = $_POST['nickName'];
            header("Location: ../paginas/paginaPrincipal.php");
            exit(); 
        }
        else
        {
            header("Location: ../paginas/login.php");
            exit();
        }
    }
    
    
    if($_POST["action"] == "Registrarse")
    {
        //verifico que no deje vacio y que esa cuenta no exista.
        if(($_POST['nickNameReg'] != "" && $_POST['passwordReg'] != "") && !buscarCuenta($_POST['nickNameReg'], $_POST['passwordReg'], $conexion, 1))
        {
            $usuario = new Usuario($_POST['nickNameReg'], $_POST['passwordReg'], null);
            $usuario->registrarUsuario($_POST['nickNameReg'], $_POST['passwordReg'], $conexion);
            header("Location: ../paginas/login.php");
            exit();
        }
        else
        {
            header("Location: ../paginas/login.php");
            exit();
        }
    }
    





        

?>    