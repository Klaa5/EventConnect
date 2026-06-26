<?php


    class Conexion
    {
        private $host = "localhost";
        private $user = ["sitio_equipodos","user"];
        private $password = ["equipodos", "user123"];
        private $bd = ["sitio_EventConnect", "EventConnect"];
        private $conexion;  


        public function iniciarDB()
        {
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);  //apaño para que entre al catch aca. activo el reporte de rror del mysqlu

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