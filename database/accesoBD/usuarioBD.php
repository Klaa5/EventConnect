<?php
    include_once "../objetos/usuario.php";

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
            $verifiedUser = false;  //Me da error si no lo mando asi al prepare.
            $consulta = $conexion->prepare("INSERT INTO Usuario (nickname, password, email, edad, link, verifiedUser, nombre, apellido) values (?, ?, ?, ?, ?, ?, ?, ?)");
            $consulta->bind_param("sssisiss", $newUser->getNickName(), $passwordSEC, $newUser->getEmail(), $newUser->getEdad(), $newUser->getLink(), $verifiedUser, $newUser->getNombre(), $newUser->getApellido());
            
            return $consulta->execute();

        }

        public function obtenerDatosUsuario($nickName, $conexion)
        {
            $sql = "SELECT * FROM Usuario WHERE nickname = '$nickName'";
            $resultado = mysqli_query($conexion, $sql);
            $tupla = mysqli_fetch_array($resultado);
            
            if($tupla['Link'] == null)
            {
                $tupla['Link'] = "Sin links asociados";
            }

            $datosUsuario = new Usuario($tupla['nickname'], $tupla['password'], $tupla['nombre'], $tupla['apellido'], $tupla['email'], $tupla['edad'], $tupla['Link'], $tupla['verifiedUser'], $tupla['promedioRank']);
     
            return $datosUsuario;
        } 

        public function generarTokenVerificacion($nickName, $conexion)
        {
            $token = bin2hex(random_bytes(2));

            $consulta = "
                UPDATE Usuario
                SET Token = ?
                WHERE nickname = ?
            ";

            $stmt = $conexion->prepare($consulta);
            $stmt->bind_param("ss", $token, $nickName);
            $stmt->execute();
            $stmt->close();

            return $token;
        }

        public function actualizarLink($nickName, $link, $conexion)
        {
            $consulta = "UPDATE Usuario SET Link = ? WHERE nickname = ?";

            $stmt = $conexion->prepare($consulta);
            $stmt->bind_param("ss", $link, $nickName);
            $stmt->execute();
            $stmt->close();
            return true;
        }

        public function verificarUsuario($token, $conexion)
        {
            $consulta = "
                UPDATE Usuario
                SET verifiedUser = 1,
                    Token = NULL
                WHERE Token = ?
            ";

            $stmt = $conexion->prepare($consulta);
            $stmt->bind_param("s", $token);
            $stmt->execute();

            $filas = $stmt->affected_rows;

            $stmt->close();

            return $filas > 0;
        }

        public function actualizarRankPromedio($nickName, $conexion, $puntaje)
        {
            $sql = "UPDATE Usuario SET promedioRank = ? WHERE nickname = ?";
            $instruccion = $conexion->prepare($sql);
            $instruccion->bind_param("ds", $puntaje, $nickName);
            $instruccion->execute();

        }
    }      
?>