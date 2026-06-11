<?php
    include_once "../database/conexion.php";
    include_once "../database/accesoBD/salaBD.php";

    class PaginaPrincipal
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

            
            while ($fila = mysqli_fetch_assoc($salas))
            {
                if($fila['Estado'] != "FINALIZADA" && $fila['Estado'] != "EN_CURSO")
                {
                    echo "
                        <a href='../paginas/visorSala.php?idSala=".$fila['Id_sala']."' class='sala-card'>

                            <div class='sala-titulo'>
                                ".$fila['Titulo']."
                            </div>

                            <div class='sala-info'>
                                Modalidad: ".$fila['Modalidad']."
                            </div>

                            <div class='sala-info'>
                                Estado: ".$fila['Estado']."
                            </div>

                        </a>";
                }
            }

        }


    }
    

    

?>