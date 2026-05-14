<?php
    include "../database/conexion.php";
    include "../database/accesoBD/salaBD.php";

    class SalaManager
    {
        private $conexion;
        private $idSala;

        public function __construct($idSala)
        {
            $this->conexion = new Conexion();
            $this->conexion = $this->conexion->iniciarDB();
            $this->idSala = $idSala;
        }

        public function obtenerSala($idSala)
        {
            $accesoDBSala = new salaBD();
            $sala = $accesoDBSala->getSala($idSala, $this->conexion);
            return $sala;
        }
    }

    


?>