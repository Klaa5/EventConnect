<?php
    include "../database/conexion.php";
    include "../objetos/usuario.php";
    include "../database/accesoBD/salaBD.php";

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

            echo "<form action='../control/visorSala.php' method='POST'>";           
            echo "<hr>";
            while ($fila = mysqli_fetch_assoc($salas)) 
            {
                if($fila['Estado'] != "FINALIZADA" && $fila['Estado'] != "EN_CURSO")  //Solo mostrara las salas vigentes.
                {
                    echo "<input type='hidden' name='idSala' value='" . $fila['Id_sala'] . "'>";
                    echo "<button type='submit'>";
                    
                    echo "Sala: " . $fila['Titulo'] . " Modalidad: " . $fila['Modalidad'];
                    echo "</button>";
                    echo "</form>";
                    echo "<hr>";
                }
            }

        }


    }
    

    

?>