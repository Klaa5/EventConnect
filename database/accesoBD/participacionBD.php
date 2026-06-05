<?php

    class participacionBD
    {

        public function userParticipa($idUsuario, $idSala, $conexion)
        {
            $consulta1 = "SELECT * FROM Participa WHERE Id_sala = ? AND nickname = ?"; 
            $instruccion1 = $conexion->prepare($consulta1);
            $instruccion1->bind_param("is", $idSala,$idUsuario);
            $instruccion1->execute();

            $resultado = $instruccion1->get_result();

            if ($resultado->num_rows > 0) 
            {
                return true; // ya está participando en la sala
            } 
            else 
            {
                return false; // no estaba.
            }

        }

        public function listarParticipantes($idSala, $conexion)
        {
            $consulta1 = "SELECT nickname FROM Participa WHERE Id_sala = ?"; 
            $instruccion1 = $conexion->prepare($consulta1);
            $instruccion1->bind_param("i", $idSala);
            $instruccion1->execute();

            return $instruccion1->get_result(); //devuelve el set con los nick, se itera con while o fetch_assoc.
        }

        public function agregarParticipante($idUsuario, $idSala, $conexion)
        {

            if($this->userParticipa($idUsuario, $idSala, $conexion) == false) //Si no estaba...
            {   //ingreso participacion de user.
                $instruccion = $conexion->prepare("INSERT INTO Participa (Id_sala, nickname) VALUES (?, ?)");
                $instruccion->bind_param("is", $idSala, $idUsuario);
                
                $resultado = $instruccion->execute(); 

                return $resultado;  //retorna true si funcionó, caso contrario retorna false.
            }
            else  //ya estaba participando.
            {
                return false;
            }
        
             
        }

        public function eliminarParticipante($idUsuario, $idSala, $conexion)
        {
            if($this->userParticipa($idUsuario, $idSala, $conexion) == true) //Si estaba...
            {   //elimino participacion de user.
                $instruccion = $conexion->prepare("DELETE FROM Participa WHERE Id_sala = ? AND nickname = ?");
                $instruccion->bind_param("is", $idSala, $idUsuario);
                
                $resultado = $instruccion->execute(); 

                return $resultado;
            }
            else
            {
                return false;
            }
        }

    }

php?>