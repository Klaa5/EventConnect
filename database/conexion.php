<?php


    class Conexion
    {
        private $host = "localhost";
        private $user = "sitio_equipodos";
        private $password = "equipodos";
        private $bd = "sitio_EventConnect";
        private $conexion;  


        public function iniciarDB()
        {
            try
            {
                $this->conexion = new mysqli($this->host, $this->user, $this->password, $this->bd);
                
            }
            catch(mysqli_sql_exception)
            {
                echo "Error al conectar a la bd";
            }

            return $this->conexion;
        }


    }
