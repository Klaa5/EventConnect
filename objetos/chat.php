<?php 

class chat
{
    private $idChat;
    private $idSala;
    private $nickNameEmisor;
    private $contenido;
    private $fechaHora;

    public function __construct($idChat, $idSala, $nickNameEmisor, $contenido, $fechaHora)
    {
        $this->idChat = $idChat;
        $this->idSala = $idSala;
        $this->nickNameEmisor = $nickNameEmisor;
        $this->contenido = $contenido;
        $this->fechaHora = $fechaHora;

    }

    public function getIdChat()
    {
        return $this->idChat;
    }

    public function getIdSala()
    {
        return $this->idSala;
    }

    public function getNicknameEmisor()
    {
        return $this->nickNameEmisor;
    }

    public function getContenido()
    {
        return $this->contenido;
    }

    public function getFechaHora()
    {
        return $this->fechaHora;
    }

}

?>