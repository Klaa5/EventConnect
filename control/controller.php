<?php
    session_start();
    include_once "../control/accountManager.php";
    include_once "../control/salaManager.php";
    include_once "../control/salaContentManager.php";
    include_once "../control/homeManager.php";
    include_once "../control/rankManager.php";

    date_default_timezone_set("America/Montevideo");

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
        if(!empty($_POST["nickName"]) && !empty(trim($_POST["password"])))
        {
            $accountManager = new accountManager();

            if($accountManager->buscarCuenta($_POST['nickName'], $_POST['password'], 0))
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
        if(!empty($_POST["nickNameReg"]) && !empty($_POST["passwordReg"]) && !$accountManager->buscarCuenta($_POST['nickNameReg'], "", 1))
        {
            $usuario = new Usuario($_POST['nickNameReg'], $_POST['passwordReg'], $_POST['nombreUser'], $_POST['apellidoUser'], $_POST['emailUser'], $_POST['edadUser'], null, false, null);
            
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

    if($_POST['action'] == "Actualizar Link")
    {
        $nickName = $_POST['nickName'];
        $link = $_POST['link'];
        $accountManager = new accountManager();
        $accountManager->actualizarLink($nickName, $link);
        header("Location: ../paginas/userProfile.php?nickName=".$nickName);
        exit();
    }

    if($_POST['action'] == 'Enviar Verificacion')
    {
        $accountManager = new accountManager();

        $nickName = $_POST['nickName'];

        $token = $accountManager->generarTokenVerificacion($nickName);

        $datosUsuario = $accountManager->obtenerDatosUsuario($nickName);

        $email = $datosUsuario->getEmail();

        $link = "http://localhost/EventConnect/paginas/verificacion.php?token=".$token;

        $asunto = "Verificacion de cuenta EventConnect";

        $mensaje = "
        <html>
        <head>
            <title>Verificacion</title>
        </head>
        <body>

            <h2>Verifica tu cuenta</h2>

            <p>
                Haz clic en el siguiente enlace:
            </p>

            <a href='$link'>
                Verificar cuenta
            </a>

        </body>
        </html>
        ";

        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";
        $headers .= "From: EventConnect <admin@equipo.dos>\r\n";
        $headers .= "Reply-To: admin@equipo.dos\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        if(mail($email, $asunto, $mensaje, $headers))
        {
            header("Location: ../paginas/userProfile.php?nickName=".$nickName);
            exit();
        }
        else
        {
            header("Location: ../paginas/userProfile.php?nickName=".$nickName."&action=error");
            exit();
        }
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

    if($_POST["action"] == "Buscar Sala")
    {
        if(!empty($_POST["palabraBusqueda"]))
        {
            header("Location: ../paginas/paginaPrincipal.php?search=" . $_POST["palabraBusqueda"]);
            exit();
        }
    }

    //_____________________________________________
    //_______________DENTRO SALA___________________


    if($_POST["action"] == "Unirse") 
    {
        $salaContentManager = new SalaContentManager($_POST['idSala']);
        
        if($salaContentManager->agregarParticipante($_SESSION['nickName'], $_POST['idSala']))
        {//Si logra unirse
            header("Location: ../paginas/visorSala.php?idSala=" . $_POST['idSala']);
            exit();
        }
        else
        {//Si hay error
            header("Location: ../paginas/visorSala.php?idSala=" . $_POST['idSala'] . "&action=error");
            exit();
        }
    }

    if($_POST["action"] == "Eliminar Participante")
    {
        $salaContentManager = new SalaContentManager($_POST['idSala']);
        
        if($salaContentManager->eliminarParticipante($_POST['nickName'], $_POST['idSala']))
        {
            header("Location: ../paginas/visorSala.php?idSala=" . $_POST['idSala']);
            exit();
        }
        else
        {
            header("Location: ../paginas/visorSala.php?idSala=" . $_POST['idSala'] . "&action=error");
            exit();
        }
    }

    if($_POST["action"] == "Enviar Mensaje")
    {
        $salaContentManager = new SalaContentManager($_POST['idSala']);
         
        $datosChat = new Chat(null, $_POST['idSala'], $_SESSION['nickName'], $_POST['mensaje'], date("Y-m-d H:i:s"));

        if($salaContentManager->agregarMensajeChat($datosChat))
        {
            header("Location: ../paginas/visorSala.php?idSala=" . $_POST['idSala']);
            exit();
        }
        else
        {
            header("Location: ../paginas/visorSala.php?idSala=" . $_POST['idSala'] . "&action=error");
            exit();
        }
    }

    if($_POST["action"] == "Calificar")
    {
        $rankManager = new RankManager();
        $accountManager = new accountManager();

        if(!$rankManager->evaluado($_POST['nickNameEvaluado'], $_SESSION['nickName'], $_POST['idSala']))
        {   
            $rankManager->agregarRank($_SESSION['nickName'], $_POST['nickNameEvaluado'], $_POST['puntaje'], $_POST['idSala']);
            $accountManager->actualizarRankPromedio($_POST['nickNameEvaluado']);    
        }

        header("Location: ../paginas/visorSala.php?idSala=" . $_POST['idSala']);
        exit();

    } 


?>