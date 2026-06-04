<?php
    include "../database/conexion.php";
    include "../objetos/usuario.php";
    include "../database/accesoBD/usuarioBD.php";
    session_start();

    $conexion = new Conexion();
    $conexion = $conexion->iniciarDB();
   
    $accesoUserBD = new UsuarioBD();

    //Aca estan el inicio registro y cierre de sesion.

    if($_POST["action"] == "Iniciar Sesión")
    {
        //Caso admin...
        if($_POST['nickName'] == "admin" && $_POST['password'] == "admin")
        {
            $_SESSION['nickName'] = $_POST['nickName'];
            header("Location: ../paginas/paginaPrincipal.php"); //pendiente ver que hacer con el admin...
            exit();

        }
        
        if(!empty($_POST["nickName"]) && !empty($_POST["password"]))
        {
            if($accesoUserBD->buscarCuenta($_POST['nickName'], $_POST['password'], $conexion, 0))
            {
                $_SESSION['nickName'] = $_POST['nickName'];
                header("Location: ../paginas/paginaPrincipal.php");
                exit(); 
            }
            else
            {
                header("Location: ../paginas/login.php");
                exit();
            }
        }
        else
        {
            header("Location: ../paginas/login.php");
            exit();
        }    
    }
    
    
    if($_POST["action"] == "Registrarse")
    {
        //verifico que no deje vacio y que esa cuenta no exista.
        if(($_POST['nickNameReg'] != "" && $_POST['passwordReg'] != "") && !$accesoUserBD->buscarCuenta($_POST['nickNameReg'], "", $conexion, 1))
        {
            $usuario = new Usuario($_POST['nickNameReg'], $_POST['passwordReg'], $_POST['nombreUser'], $_POST['apellidoUser'], $_POST['emailUser'], $_POST['edadUser'], null, false);
            $accesoUserBD->registrarUsuario($usuario, $conexion);
            header("Location: ../paginas/login.php");
            exit();
        }
        else
        {
            header("Location: ../paginas/login.php");
            exit();
        }
    }

  
    if($_POST["action"] == "Cerrar Sesión")
    {
        session_unset();
        session_destroy();
        header("Location: ../paginas/login.php");
        exit();
    }
    





        

?>    