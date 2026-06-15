<?php
    include_once "../database/conexion.php";
    include_once "../objetos/usuario.php";
    include_once "../database/accesoBD/salaBD.php";    

    class SalaManager
    {
        private $conexion;
        private $nickname;

        public function __construct($nickNameSession)
        {
            $this->conexion = new Conexion();
            $this->conexion = $this->conexion->iniciarDB();
            $this->nickname = $nickNameSession;
        }

        public function crearSala($datosNewSala)
        {
            if(!empty($this->nickname))   //solo funcionaria si hay una sesion iniciada...
            {
        
                $salaNueva = new Sala(null, $datosNewSala["titulo"], $datosNewSala["descripcion"], $datosNewSala["modalidad"], $this->nickname, $datosNewSala["ubicacion"], $datosNewSala["fechaHora"], "creando");
                $salaBD = new salaBD();
                
                if($salaBD->registrarSala($this->conexion, $salaNueva))  //Se crea la sala.
                {   
                    return true;    //sala creada
                }
                else
                {   
                    return false;   //error al crear la sala
                }
        
            }
            else
            {
                return false;   //si no hay sesion iniciada, no se puede crear la sala.
            }
        }

        public function obtenerSalasUsuario()
        {
            $salaBD = new SalaBD;
            return $salaBD->obtenerSalasUsuario($this->conexion, $this->nickname);
        }

    }

?>