<?php


    class Conexion
    {
        private $host = "localhost";
        private $user = ["user", "sitio_equipodos"];
        private $password = ["user123", "equipodos"];
        private $bd = ["EventConnect", "sitio_EventConnect"];
        private $conexion;  


        public function iniciarDB()
        {
            
            for ($i = 0; $i < 2; $i++) //Intento con las dos BD
            {
                try
                {
                    $this->conexion = new mysqli($this->host, $this->user[$i], $this->password[$i], $this->bd[$i]);

                    break;  //Llega aca si se logra la conexion
                }
                catch (mysqli_sql_exception)
                {
                    $this->conexion = null;
                }
            }

            if ($this->conexion == null)    //return
            {
                echo "Error, no se puede conectar a las bd";
                return null;
            }

            if($this->eventStateUpdaterDetector() == true)  //Si esta bd deja modificar entra
            {
                @$this->conexion->query("SET GLOBAL event_scheduler = ON;");
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