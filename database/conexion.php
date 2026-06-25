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

                if($this->eventStateUpdaterDetector())
                {
                    @$this->conexion->query("SET GLOBAL event_scheduler = ON;");
                }
                
            }
            catch(mysqli_sql_exception)
            {
                echo "Error al conectar a la bd";
            }

            return $this->conexion;
        }

        public function eventStateUpdaterDetector()
        {
            $resultado = $this->conexion->query("SHOW EVENTS");

            if($resultado != false)
            {
                if($resultado->num_rows > 0)
                return true;
            }
            else
            {
                return false;
            }

            return false;
        }


    }