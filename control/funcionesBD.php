<?php

    include "../database/conexion.php";


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



    function buscarCuenta($nickName, $password, $conexion)
    {
        $pass = false;
        $sql = "SELECT * FROM Usuario";
        $resultado = mysqli_query($conexion, $sql);

        while($tupla = mysqli_fetch_array($resultado))
        {
            if($tupla['nickname'] == $nickName && $tupla['password'] == $password)
            {
                $pass = true;
                break;
            }

        }
        
        return $pass;
    }



?>