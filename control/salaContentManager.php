<?php
    include_once "../database/accesoBD/salaBD.php";
    include_once "../database/conexion.php";
    include_once "../database/accesoBD/participacionBD.php";

    class SalaContentManager
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

        public function agregarParticipante($nickName, $idSala)
        {
            $accesoDBParticipacion = new participacionBD();
            $resultado = $accesoDBParticipacion->agregarParticipante($nickName, $idSala, $this->conexion);
            return $resultado;
        } 

        public function eliminarParticipante($nickName, $idSala)
        {
            $accesoDBParticipacion = new participacionBD();
            $resultado = $accesoDBParticipacion->eliminarParticipante($nickName, $idSala, $this->conexion);
            return $resultado;
        }

        public function listarParticipantes($idSala)
        {
            $accesoDBParticipacion = new participacionBD();
            $resultado = $accesoDBParticipacion->listarParticipantes($idSala, $this->conexion);
            return $resultado;
        }
    }

    


?>