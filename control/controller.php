<?php
    session_start();
    include "../database/conexion.php";
    include "../objetos/usuario.php";
    include "../database/accesoBD/salaBD.php";
    include "../database/accesoBD/usuarioBD.php";

    $conexion = new Conexion();
    $conexion = $conexion->iniciarDB();

    //____________________________________________________________________________________
        //Ubicaciones en archivo:

        //USER               20 a 78
        //SALA o HOME        79 a 110
        //DENTRO SALA       111 a x
    //____________________________________________________________________________________
    

    //______________________________________
    //_______________USER___________________
    
    //Aca estan el inicio registro y cierre de sesion.
    

    if($_POST["action"] == "Iniciar Sesión")
    {
        //Asocio el inicio de sesion a la variable session si es correcto.
        if(!empty($_POST["nickName"]) && !empty($_POST["password"]))
        {
            $accountManager = new accountManager();

            if($accountManager->buscarCuenta($_POST['nickName'], $_POST['password'], $conexion, 0))
            {
                $_SESSION['nickName'] = $_POST['nickName']; //Variable seteada.
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

        $accountManager = new accountManager();    

        //verifico que no deje vacio y que esa cuenta no exista.
        if(!empty($_POST["nickNameReg"]) && !empty($_POST["passwordReg"]) && !$accountManager->buscarCuenta($_POST['nickNameReg'], "", $conexion, 1))
        {
            $usuario = new Usuario($_POST['nickNameReg'], $_POST['passwordReg'], $_POST['nombreUser'], $_POST['apellidoUser'], $_POST['emailUser'], $_POST['edadUser'], null, false);
            
            if($accountManager->registrarUser($usuario))
            {
                header("Location: ../paginas/login.php");
                exit();
            }
            else
            {
                //PENDIENTE MANEJAR ERROR DE REGISTRO.
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

  
    if($_POST["action"] == "Cerrar Sesión")
    {
        session_unset();
        session_destroy();
        header("Location: ../paginas/login.php");
        exit();
    }


    //_____________________________________________
    //_______________SALA O HOME___________________


    if($_POST["action"] == "Crear Sala")    //Crear sala.
    {
        if(!empty($_SESSION['nickName']))
        {
            $salaManager = new SalaManager($_SESSION['nickName']);
            
            if($salaManager->crearSala($_POST))
            {
                //PENDIENTE VER COMO DAR UN MENSAJE DE SUCCESS
                header("Location: ../paginas/paginaPrincipal.php"); //redirige a la pagina principal si todo sale bien
                exit();
            }
            else
            {
                //PENDIENTE VER COMO DAR MENSAJE DE ERROR  
                header("Location: ../paginas/crearSala.php");   //vuelve a la pagina de creacion a reintentar.
                exit();
            }

        }
        else
        {
            header("Location: ../paginas/login.php");
            exit();
        }
       
    }

    //_____________________________________________
    //_______________DENTRO SALA___________________






?>