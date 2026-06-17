<?php
    include_once "../database/accesoBD/usuarioBD.php";
    include_once "../database/conexion.php";
    include_once "../objetos/usuario.php";
    include_once "./rankManager.php";
    
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

        public function actualizarLink($nickName, $link)
        {
            return $this->accesoUserBD->actualizarLink($nickName, $link, $this->conexion);
        }

        public function generarTokenVerificacion($nickName)
        {
            return $this->accesoUserBD->generarTokenVerificacion($nickName, $this->conexion);
        }
        
        public function verificarUsuario($token)
        {
            return $this->accesoUserBD->verificarUsuario($token, $this->conexion);
        }

        public function actualizarRankPromedio($nickName)
        {
            $rankManager = new RankManager();

            $ranksUser = $rankManager->obtenerRanksUser($nickName);
            
            $cantidadRanks = count($ranksUser); //Cantidad de votaciones recibidas

            $sumaRanks = 0;

            foreach($ranksUser as $rank)
            {
                $sumaRanks = $sumaRanks + $rank->getPuntaje();
            }

            $promedioRank = $sumaRanks / $cantidadRanks; 

            return $this->accesoUserBD->actualizarRankPromedio($nickName, $this->conexion, $promedioRank);

        }

    }
   
    
    





        

?>    