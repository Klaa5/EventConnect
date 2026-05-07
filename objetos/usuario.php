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

    public function registrarUsuario($nickName, $password, $conexion)
    {

        //ver si este hasheo es efectivo o cambiarlo por otro cifrado:
            //para leer hay que usar esto:
            // password_verify("Constasenia iterada", $passwordSEC);
        $passwordSEC = password_hash($password, PASSWORD_BCRYPT);

        $consulta = $conexion->prepare("INSERT INTO Usuario (nickname, password, link) values (?, ?)");
        $consulta->bind_param("ss", $nickName, $passwordSEC);
        $consulta->execute();

    }
}





?>