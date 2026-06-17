<?php


class Usuario
{
    private $nickName;
    private $password;
    private $nombre;
    private $apellido;
    private $email;
    private $edad;
    private $link;
    private $rankPromedio;
    private $verifiedUser;


    public function __construct($nickName, $password, $nombre, $apellido, $email, $edad, $link, $verifiedUser, $rankPromedio)
    {
        $this->nickName = $nickName;
        $this->password = $password;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->edad = $edad;

        if($link == null)
        {
            $this->link = "Sin descripcion";
        }
        else
        {
            $this->link = $link;
        }

        $this->verifiedUser = $verifiedUser;

        if($rankPromedio == null)
        {
            $this->rankPromedio = 0;
        }
        
    }

    public function getNickName()
    {
        return $this->nickName;
    }

    public function getPassword()
    {
        return $this->password;
    }   

    public function getLink()
    {
        return $this->link;
    }

    public function getRankPromedio()
    {
        return $this->rankPromedio;
    }

    public function getVerifiedUser()
    {
        return $this->verifiedUser;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getEdad()
    {
        return $this->edad;
    }
   
}

?>