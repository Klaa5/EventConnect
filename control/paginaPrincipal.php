<?php
    
    include "../database/conexion.php";
    include "../objetos/usuario.php";
    include "../database/accesoBD/salaBD.php";
    session_start();

    $conexion = new Conexion();
    $conexion = $conexion->iniciarDB();

    function mostrarSalas($salas)
    {
        
    }


?>