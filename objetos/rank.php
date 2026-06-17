<?php

class rank
{
    private $idRank;
    private $nickNameEvaluado;
    private $nickNameEvaluador;
    private $idSala;
    private $puntaje;

    public function __construct($idRank, $nickNameEvaluado, $nickNameEvaluador, $idSala)
    {
        $this->idRank = $idRank;
        $this->nickNameEvaluado = $nickNameEvaluado;
        $this->nickNameEvaluador = $nickNameEvaluador;
        $this->idSala = $idSala;
    }

    public function getIdRank()
    {
        return $this->idRank;
    }

    public function getNickNameEvaluado()
    {
        return $this->nickNameEvaluado;
    }

    public function getNickNameEvaluador()
    {
        return $this->nickNameEvaluador;
    }

    public function getIdSala()
    {
        return $this->idSala;
    }

    public function getPuntaje()
    {
        return $this->puntaje;
    }
}