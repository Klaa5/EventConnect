<?php

    include "../database/conexion.php";
    include "../objetos/sala.php";
    include "../objetos/usuario.php";    
    session_start();

    $conexion = new Conexion();
    $conexion = $conexion->iniciarDB();


    if(!empty($_SESSION['nickName']))   //solo funcionaria si hay una sesion iniciada...
    {

        $salaNueva = new Sala(-1,$_POST["titulo"],$_POST["descripcion"],$_POST["modalidad"],$_SESSION["nickName"],$_POST["ubicacion"],$_POST["fechaHora"],"creando");
        
        $salaNueva->registrarSala($conexion, $salaNueva);   //Se crea la sala.

    }


?>