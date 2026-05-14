<?php
    include "../database/conexion.php";
    include "../objetos/usuario.php";
    include "../database/accesoBD/salaBD.php";
    session_start();

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
                if($fila['Estado'] != "FINALIZADA" && $fila['Estado'] != "EN_CURSO")  //Solo mostrara las salas vigentes.
                {
                    echo "<hr>";
                    echo "Sala: " . $fila['Titulo'] . " Modalidad: " . $fila['Modalidad'] . "<br>";
                    echo "<hr>";
                }
            }

        }


    }
    

    

?>