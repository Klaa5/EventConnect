<?php

    include "../database/conexion.php";
    include "../objetos/usuario.php";

            /*   EJEMPLO DE CLASE, CONSULTA SQL PREVENTIVA DE INYECT

                    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $usuario = $result->fetch_assoc();

            "s" // string
            "i" // integer
            "d" // double (decimal)
            "b" // blob */



    function buscarCuenta($nickName, $password, $conexion, $accion)
    {

        //Accion tiene estos modos:
        //0 busca que exista ese usuario registrado
        //1 solo busca el nickname

        $pass = false;
        $sql = "SELECT * FROM Usuario";
        $resultado = mysqli_query($conexion, $sql);

        if($accion == 0)
        {
            while($tupla = mysqli_fetch_array($resultado))
            {
                if($accion == 0)
                {
                    if($tupla['nickname'] == $nickName && $tupla['password'] == $password)
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

    }



?>