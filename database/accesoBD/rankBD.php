<?php

    class rankBD
    {

        public function obtenerRanksUser($conexion, $nickName)
        {
            //Aca solo se obtienen los ranks que les hicieron al user
            $consulta1 = "SELECT * FROM Ranking WHERE nicknameEvaluado = ?"; 
            $instruccion1 = $conexion->prepare($consulta1);
            $instruccion1->bind_param("s", $nickName);
            $instruccion1->execute();

            $resultado = $instruccion1->get_result();

            return $resultado;
        }

        public function agregarRank($conexion, $nickNameEvaluador, $nickNameEvaluado, $rank, $idSala)
        {

            if(!$this->evaluado($conexion, $nickNameEvaluado, $nickNameEvaluador, $idSala))
            {
                $consulta = $conexion->prepare("INSERT INTO Ranking (nicknameEvaluador, nicknameEvaluado, Id_sala, Puntaje) values (?, ?, ?, ?)");
                $consulta->bind_param("ssii", $nickNameEvaluador, $nickNameEvaluado, $idSala, $rank);
            
                return $consulta->execute();
            }
            else
            {
                return false;
            }


        }

        public function evaluado($conexion, $nickNameEvaluado, $nickNameEvaluador, $idSala)
        {
            //True fue evaluado
            //False no fue evaluado
            $consulta1 = "SELECT * FROM Ranking WHERE nicknameEvaluado = ? AND nicknameEvaluador = ? AND Id_sala = ?"; 
            $instruccion1 = $conexion->prepare($consulta1);
            $instruccion1->bind_param("ssi", $nickNameEvaluado, $nickNameEvaluador, $idSala);
            $instruccion1->execute();

            $resultado = $instruccion1->get_result();

            if($resultado->num_rows == 0)
            {
                return false;
            }
            else
            {
                return true;
            }

        }

    }

?>