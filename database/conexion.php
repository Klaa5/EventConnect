<?php


    class Conexion
    {
        private $host = "localhost";
        private $user = "user";
        private $password = "user123";
        private $bd = "EventConnect";
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