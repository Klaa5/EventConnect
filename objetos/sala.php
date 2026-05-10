<?php

class Sala
{
    private $idSala;            //queda en 0 si se esta almacenado en la bd, queda en N si se trae de alla
    private $titulo;
    private $descripcion;
    private $modalidad;
    private $nickNameCreador;
    private $ubicacion;          //queda en null si es virtual
    private $fechaHora;
    private $estado;

    //LISTA ESTADOS: pendiente crear un enum si da el tiempo.
    //EN_PREPARACION
    //EN_CURSO
    //FINALIZADA

    public function __construct($idSala, $titulo, $descripcion, $modalidad, $nickNameCreador, $ubicacion, $fechaHora, $estado)
    {
        $this->idSala = $idSala;  //Si es un objeto que se crea para almacenar en la bd, setear con -1 o null
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->modalidad = $modalidad;
        $this->nickNameCreador = $nickNameCreador;
        $this->fechaHora = $fechaHora;

        if($estado == "creando")
        {
            $this->estado = "EN_PREPARACION";
        }
        else
        {
            $this->estado = $estado;
        }
        
        
        if($modalidad == "Virtual")
        {
            $this->ubicacion = null;
        }
        else
        {
            $this->ubicacion = $ubicacion;
        }
        
        
    }

    public function getIdSala()
    {
        return $this->idSala;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getModalidad()
    {
        return $this->modalidad;
    }

    public function getNickNameCreador()
    {
        return $this->nickNameCreador;
    }

    public function getUbicacion()
    {
        return $this->ubicacion;
    }

    public function getFechaHora()
    {
        return $this->fechaHora;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function registrarSala($conexion, $datosSala)
    {   
        if($this->idSala == null || $this->idSala == -1) //Si es un objeto dirigido a ser almacenado (se envia como -1 o null))...
        {    
            $instruccion = $conexion->prepare("INSERT INTO Sala (Titulo, Descripcion, Modalidad, Ubicacion, Fecha, nickname, Estado) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $instruccion->bind_param("sssssss", $this->titulo, $this->descripcion, $this->modalidad, $this->ubicacion, $this->fechaHora, $this->nickNameCreador, $this->estado);
            
            $resultado = $instruccion->execute(); //la ejecucion tambien retorna si salio bien o no.

            return $resultado;  //retorna true si se registro, si no retorna false directamente.
            
        }
        else
        {
            return false;
        }
    }
}

?>