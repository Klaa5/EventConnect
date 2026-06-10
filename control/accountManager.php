<?php
    include "../database/accesoBD/usuarioBD.php";
    
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

    }
   
    
    





        

?>    