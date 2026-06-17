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

            echo "<div class='salas-listado'>";

            while($sala = mysqli_fetch_assoc($salas))
            {
                if($sala['Estado'] != "FINALIZADA" && $sala['Estado'] != "EN_CURSO")
                {
                    if($sala['Modalidad'] == "virtual")
                    {
                        $mod = "🌐 Evento Online / Virtual";
                    }
                    else
                    {
                        $mod = "<strong> Ubicación</strong>: " . $sala['Ubicacion'];
                    }

                    echo "
                    <a href='../paginas/visorSala.php?idSala=".$sala['Id_sala']."'
                    style='text-decoration:none;color:inherit;'>

                        <div class='sala-card'>

                            <div class='sala-titulo'>
                                ".$sala['Titulo']."
                            </div>

                            <div class='sala-info'>
                                <strong>Fecha de inicio</strong>:
                                ".date("d/m/Y H:i", strtotime($sala['Fecha']))."
                                <br><br>
                                ".$mod."
                            </div>

                        </div>

                    </a>";
                }
            }

            echo "</div>";
        }


        public function buscarSala($ingreso)
        {
            $accesoDBSala = new salaBD();
            $salasFiltradas = $accesoDBSala->getSalasFiltradas($this->conexion, $ingreso);           

            if($salasFiltradas != null || !empty($salasFiltradas))
            {
                $pag = './paginaPrincipal.php';

                echo '<form action=' . $pag . ' method="post"> <input type="submit" class="btn-regresar" value="Volver a pagina principal"> </form> <br>';

                echo "<div class='salas-listado'>";

                while($sala = mysqli_fetch_assoc($salasFiltradas))
                {
                    if($sala['Estado'] != "FINALIZADA" && $sala['Estado'] != "EN_CURSO")
                    {
                        if($sala['Modalidad'] == "virtual")
                        {
                            $mod = "🌐 Evento Online / Virtual";
                        }
                        else
                        {
                            $mod = "<strong> Ubicación</strong>: " . $sala['Ubicacion'];;
                        }

                        echo "
                        <a href='../paginas/visorSala.php?idSala=".$sala['Id_sala']."'
                        style='text-decoration:none;color:inherit;'>

                            <div class='sala-card'>

                                <div class='sala-titulo'>
                                    ".$sala['Titulo']."
                                </div>

                                <div class='sala-info'>
                                    <strong>Fecha de inicio</strong>:
                                    ".date("d/m/Y H:i", strtotime($sala['Fecha']))."
                                    <br><br>
                                    ".$mod."
                                </div>

                            </div>

                        </a>";
                    }
                }
            }
            else
            {
                $pag = './paginaPrincipal.php';

                echo '<form action=' . $pag . ' method="post"> <input type="submit" class="btn-regresar" value="Volver a pagina principal"> </form> <br>';
                echo "<div class='salas-listado'>";
                echo '<div style="display: flex; justify-content: center; width: 100%; margin-top: 20px;">
                        <strong style="opacity: 0.9; text-align: center;">No se han encontrado coincidencias</strong>
                    </div>';            
            }

            echo "</div>";
        }


    }
            

            

?>