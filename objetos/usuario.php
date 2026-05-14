<?php


class Usuario
{
    private $nickName;
    private $password;
    private $link;
    private $ranks = [];     //lista de objetos con las evaluaciones hacia este usuario
    private $rankPromedio;


    public function __construct($nickName, $password, $link)
    {
        $this->nickName = $nickName;
        $this->password = $password;
        
        if($link == null)
        {
            $this->link = "Sin descripcion";
        }
        else
        {
            $this->link = $link;
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
        return $this->ranks;
    }

    
}





?>