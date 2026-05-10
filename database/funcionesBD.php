<?php

    function buscarCuenta($nickName, $password, $conexion, $accion)
    {

        //Accion tiene estos modos:
        //0 busca que exista ese usuario registrado
        //1 solo busca el nickname

        $pass = false;
        $sql = "SELECT * FROM Usuario";
        $resultado = mysqli_query($conexion, $sql);

        
        
        while($tupla = mysqli_fetch_array($resultado))
            {
                if($accion == 0)
                {   //Se lee con esa funcion la contrasenia ya que esta con hash
                    if($tupla['nickname'] == $nickName && password_verify($password, $tupla['password']))
                    {
                        $pass = true;
                        break;
                    }
                }

                if($accion == 1)
                {
                    if($tupla['nickname'] == $nickName)
                    {
                        $pass = true;
                        break;
                    } 
                }

            }
            
            return $pass;
        

    }



?>