<?php
    include_once "../database/accesoBD/usuarioBD.php";
    include_once "../database/conexion.php";
    include_once "../objetos/usuario.php";
    
    class accountManager
    {
        private $conexion;
        private $accesoUserBD;

        public function __construct()
        {
            $this->conexion = new Conexion();
            $this->conexion = $this->conexion->iniciarDB();
            $this->accesoUserBD = new UsuarioBD();
        }

        public function buscarCuenta($nickName, $password, $tipoBusqueda)
        {
            return $this->accesoUserBD->buscarCuenta($nickName, $password, $this->conexion, $tipoBusqueda);
        }

        public function registrarUser($usuario)
        {
            return $this->accesoUserBD->registrarUsuario($usuario, $this->conexion);
        }

        public function obtenerDatosUsuario($nickName)
        {
            return $this->accesoUserBD->obtenerDatosUsuario($nickName, $this->conexion);
        }

    }
   
    
    





        

?>    