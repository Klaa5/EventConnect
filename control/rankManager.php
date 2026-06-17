<?php

    include_once "../database/accesoBD/rankBD.php";
    include_once "../database/conexion.php";
    include_once "../objetos/rank.php";

    Class RankManager
    {
        private $conexion;
        private $accesoRankBD;

        public function __construct()
        {
            $this->conexion = new Conexion();
            $this->conexion = $this->conexion->iniciarDB();
            $this->accesoRankBD = new RankBD();
        }

        public function obtenerRanksUser($nickName)
        {
            $allUserRanks = $this->accesoRankBD->obtenerRanksUser($this->conexion, $nickName);
            
            $ArrayRanks = [];

            while($rank = $allUserRanks->fetch_assoc()) 
            {
                $ArrayRanks[] = new rank($rank['id_Rank'], $rank['nicknameEvaluado'], $rank['nicknameEvaluador'], $rank['Id_sala'], $rank['Puntaje'] );
            }

            return $ArrayRanks;

        }

        public function agregarRank($nickNameEvaluador, $nickNameEvaluado, $rank, $idSala)
        {
            return $this->accesoRankBD->agregarRank($this->conexion, $nickNameEvaluador, $nickNameEvaluado, $rank, $idSala);
        }

        public function evaluado($nickNameEvaluado, $nickNameEvaluador, $idSala)
        {
            //True fue evaluado
            //False no fue evaluado
            return $this->evaluado($this->conexion, $nickNameEvaluado, $nickNameEvaluador, $idSala);
        }

    }
?>