<?php
include "../objetos/sala.php";

    class salaBD
    {
        public function getSala($idSala, $conexion)
        {   
            $consulta = "SELECT * FROM Sala NATURAL JOIN Participa NATURAL JOIN Usuario WHERE Id_sala = ?"; 
            $instruccion = $conexion->prepare($consulta);
            $instruccion->bind_param("i", $idSala);
            $instruccion->execute();
            $resultado = $instruccion->get_result();

            if($resultado->num_rows > 0)    //Si hay integrantes (no cuenta al creador) entonces se obtienen todos ellos
            {
                $primeraFila = $resultado->fetch_assoc(); //Obtengo la primer fila.

                //Esto ya itera al usar la funcion de arriba, asi que cuando empiece el while empieza desde el segundo integrante!
                //Agrego los datos de la sala y del primer integrante.
                $datosSala = new Sala($primeraFila["Id_sala"], $primeraFila["Titulo"], $primeraFila["Descripcion"], $primeraFila["Modalidad"], $primeraFila["nickname"], $primeraFila["Ubicacion"], $primeraFila["Fecha"], $primeraFila["Estado"]);
                $datosSala->agregarParticipante($primeraFila['nickname']);  //Este es el primer participante, que casi se me pierde.

                //Aca obtengo el nombre de cada participante.
                while($fila = $resultado->fetch_assoc())
                {
                    $datosSala->agregarParticipante($fila['nickname']);
                }
            }
            else    //Si no hay integrantes, obtengo solo los datos de la sala y el nick del creador.
            {
                $consulta1 = "SELECT * FROM Sala WHERE Id_sala = ?"; 
                $instruccion1 = $conexion->prepare($consulta1);
                $instruccion1->bind_param("i", $idSala);
                $instruccion1->execute();

                $fila = $instruccion1->get_result()->fetch_assoc();
                $datosSala = new Sala($fila["Id_sala"], $fila["Titulo"], $fila["Descripcion"], $fila["Modalidad"], $fila["nickname"], $fila["Ubicacion"], $fila["Fecha"], $fila["Estado"]);
                
            }
            
            return $datosSala;

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
                $instruccion = $conexion->prepare("INSERT INTO Sala (Titulo, Descripcion, Modalidad, Ubicacion, Fecha, nicknameCreador, Estado) VALUES (?, ?, ?, ?, ?, ?, ?)");
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