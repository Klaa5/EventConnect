<?php


    class salaBD
    {
        public function getSala($idSala, $conexion)
        {   
            $consulta = "SELECT * FROM Sala WHERE Id_sala = ? NATURAL JOIN Participa WHERE Id_sala = ?"; 
            $instruccion = $conexion->prepare($consulta);
            $instruccion->bind_param("i", $idSala);
            $instruccion->execute();
            return $instruccion->get_result();
        }

        public function getAllSalas($conexion)
        {
            $consulta = "SELECT * FROM Sala";
            return mysqli_query($conexion, $consulta); 
        }  

        public function registrarSala($conexion, $datosSala)
        {   
            if($datosSala->getIdSala() == null || $datosSala->getIdSala() == -1) //Si es un objeto dirigido a ser almacenado (se envia como -1 o null))...
            {    
                $instruccion = $conexion->prepare("INSERT INTO Sala (Titulo, Descripcion, Modalidad, Ubicacion, Fecha, nickname, Estado) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $instruccion->bind_param("sssssss", $datosSala->getTitulo(), $datosSala->getDescripcion(), $datosSala->getModalidad(), $datosSala->getUbicacion(), $datosSala->getFechaHora(), $datosSala->getNickNameCreador(), $datosSala->getEstado());
                
                $resultado = $instruccion->execute(); //la ejecucion tambien retorna si salio bien o no.

                return $resultado;  //retorna true si se registro, si no retorna false directamente.
                
            }
            else
            {
                return false;
            }
        }
    }


?>