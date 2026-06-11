<?php
    include_once "../database/conexion.php";
    include_once "../database/accesoBD/salaBD.php";

    class HomeManager
    {
        private $conexion;

        public function __construct()
        {
            $this->conexion = new Conexion();
            $this->conexion = $this->conexion->iniciarDB();
        }

        public function mostrarSalas()
        {
            $accesoDBSala = new salaBD();
            $salas = $accesoDBSala->getAllSalas($this->conexion);

            echo "<hr>";

            while($sala = mysqli_fetch_assoc($salas))
            {

                if($sala['Estado'] != "FINALIZADA" && $sala['Estado'] != "EN_CURSO")
                {
                    if($sala['Modalidad'] == "virtual")
                    {
                        $mod = "<span style='color:green'>Evento Online/Virtual </span><br>";
                    }
                    else
                    {
                        $mod = "";
                    }  

                    echo "
                    <a href='../paginas/visorSala.php?idSala=" . $sala['Id_sala'] . "' style='text-decoration:none; color:inherit;'>
                    
                        <div style='padding:12px; margin:10px; width:300px;'>
                            <h3 style='margin:0 0 5px 0;'>" . $sala['Titulo'] . "</h3>
                            <span>Fecha de inicio: " . date("d/m/Y H:i", strtotime($sala['Fecha'])) . "</span>
                            $mod 
                        </div>
                        
                    </a>";
                }

            }

        }


    }
    

    

?>