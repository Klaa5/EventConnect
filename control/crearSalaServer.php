<?php
    include "../database/conexion.php";
    include "../objetos/usuario.php";
    include "../database/accesoBD/salaBD.php";    
    session_start();

    $conexion = new Conexion();
    $conexion = $conexion->iniciarDB();


    if(!empty($_SESSION['nickName']))   //solo funcionaria si hay una sesion iniciada...
    {

        $salaNueva = new Sala(null, $_POST["titulo"], $_POST["descripcion"], $_POST["modalidad"], $_SESSION["nickName"], $_POST["ubicacion"], $_POST["fechaHora"], "creando");
        $salaBD = new salaBD();
        
        if($salaBD->registrarSala($conexion, $salaNueva))  //Se crea la sala.
        {   //PENDIENTE VER COMO DAR UN MENSAJE DE SUCCESS
            header("Location: ../paginas/paginaPrincipal.php"); //redirige a la pagina principal si todo sale bien
            exit();
        }
        else
        {   //PENDIENTE VER COMO DAR MENSAJE DE ERROR  
            header("Location: ../paginas/crearSala.php");   //vuelve a la pagina de creacion a reintentar.
            exit();
        }

    }
    else
    {
        header("Location: ../paginas/login.php");
        exit();
    }


?>