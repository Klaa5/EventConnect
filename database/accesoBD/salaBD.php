<?php


    class salaBD
    {
        function getAllSalas($conexion)
        {
            $consulta = "SELECT * FROM Sala";
            return mysqli_query($conexion, $consulta); 
        }  
    }


?>