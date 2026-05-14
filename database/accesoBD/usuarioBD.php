<?php

    class UsuarioBD
    {
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

        public function registrarUsuario($newUser, $conexion)
        {
            //ver si este hasheo es efectivo o cambiarlo por otro cifrado:
                //para leer hay que usar esto:
                // password_verify("Constasenia iterada", $passwordSEC);
            $passwordSEC = password_hash($newUser->getPassword(), PASSWORD_BCRYPT);

            $consulta = $conexion->prepare("INSERT INTO Usuario (nickname, password) values (?, ?)");
            $consulta->bind_param("ss", $newUser->getNickName(), $passwordSEC);
            $consulta->execute();

        }
    }

?>