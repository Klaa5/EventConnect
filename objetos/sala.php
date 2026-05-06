<?php

class Sala
{
    private $idSala;
    private $titulo;
    private $descripcion;
    private $modalidad;
    private $nickNameCreador;
    private $ubicacion = null;          //queda en null si es virtual
    private $fechaHora;
    private $estado;

    public function __construct($idSala, $titulo, $descripcion, $modalidad, $nickNameCreador, $ubicacion = null, $fechaHora, $estado)
    {
        $this->idSala = $idSala;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->modalidad = $modalidad;
        $this->nickNameCreador = $nickNameCreador;
        $this->ubicacion = $ubicacion;
        $this->fechaHora = $fechaHora;
        $this->estado = $estado;
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
}

?>