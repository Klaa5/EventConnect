<?php

    include "../database/conexion.php";
    include "../objetos/usuario.php";
    include "../database/accesoBD/salaBD.php";
    session_start();

    $conexion = new Conexion();
    $conexion = $conexion->iniciarDB();

    if($_POST["action"] == "Crear Sala")    //Crear sala.
    {
        if(!empty($_SESSION['nickName']))
        {
            $salaManager = new SalaManager($_SESSION['nickName']);
            
            if($salaManager->crearSala($_POST))
            {
                //PENDIENTE VER COMO DAR UN MENSAJE DE SUCCESS
                header("Location: ../paginas/paginaPrincipal.php"); //redirige a la pagina principal si todo sale bien
                exit();
            }
            else
            {
                //PENDIENTE VER COMO DAR MENSAJE DE ERROR  
                header("Location: ../paginas/crearSala.php");   //vuelve a la pagina de creacion a reintentar.
                exit();
            }

        }
        else
        {
            header("Location: ../paginas/login.php");
            exit();
        }
       
    }

    




?>