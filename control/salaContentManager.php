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

        public function agregarParticipante($idUsuario, $idSala)
        {
            $accesoDBParticipacion = new participacionBD();
            $resultado = $accesoDBParticipacion->agregarParticipante($idUsuario, $idSala, $this->conexion);
            return $resultado;
        } 

        public function eliminarParticipante($idUsuario, $idSala)
        {
            $accesoDBParticipacion = new participacionBD();
            $resultado = $accesoDBParticipacion->eliminarParticipante($idUsuario, $idSala, $this->conexion);
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