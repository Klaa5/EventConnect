<?php 

class chat
{
    private $idChat;
    private $idSala;
    private $mensajes = [];     //lista de objetos mensaje

    public function __construct($idChat, $idSala)
    {
        $this->idChat = $idChat;
        $this->idSala = $idSala;

       
    }

    public function getIdChat()
    {
        return $this->idChat;
    }

    public function getIdSala()
    {
        return $this->idSala;
    }

    public function getMensajes()
    {
        //por hacer. pendiente ya que creo que debo hacer una consulta a la bd
    }

}

?>