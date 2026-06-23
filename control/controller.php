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

        //USER               26 a 155
        //SALA o HOME        162 a 195
        //DENTRO SALA       201 a 278
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
                header("Location: ../paginas/login.php?notif_id=errorLogin");
                exit();
            }
        }
        else
        {
            header("Location: ../paginas/login.php?notif_id=errorLogin");
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
                header("Location: ../paginas/login.php?notif_id=errorReg");
                exit();
            }

        }
        else
        {
            header("Location: ../paginas/login.php?notif_id=errorReg");
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
        header("Location: ../paginas/userProfile.php?nickName=".$nickName . "&notif_id=datosActualizados");
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
            header("Location: ../paginas/userProfile.php?nickName=".$nickName."&notif_id=correoVerifEnviado");
            exit();
        }
        else
        {
            header("Location: ../paginas/userProfile.php?nickName=".$nickName."&notif_id=correoVerifError");
            exit();
        }
        exit();
    }


    //_____________________________________________
    //_______________SALA O HOME___________________


    if($_POST["action"] == "Crear Sala")  
    {
        if(!empty($_SESSION['nickName']))
        {
            $salaManager = new SalaManager($_SESSION['nickName']);
            
            if($salaManager->crearSala($_POST))
            {
                header("Location: ../paginas/paginaPrincipal.php?notif_id=salaCreada");
                exit();
            }
            else
            { 
                header("Location: ../paginas/crearSala.php?notif_id=salaCreadaError"); 
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
            header("Location: ../paginas/visorSala.php?idSala=" . $_POST['idSala'] . "&notif_id=joined");
            exit();
        }
        else
        {//Si hay error
            header("Location: ../paginas/visorSala.php?idSala=" . $_POST['idSala'] . "&notif_id=error");
            exit();
        }
    }

    if($_POST["action"] == "Eliminar Participante")
    {
        $salaContentManager = new SalaContentManager($_POST['idSala']);
        
        if($salaContentManager->eliminarParticipante($_POST['nickName'], $_POST['idSala']))
        {
            header("Location: ../paginas/visorSala.php?idSala=" . $_POST['idSala'] . "&notif_id=success&usr=" . $_POST['nickName']);
            exit();
        }
        else
        {
            header("Location: ../paginas/visorSala.php?idSala=" . $_POST['idSala'] . "&nofif_id=error");
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
            
            if($accountManager->actualizarRankPromedio($_POST['nickNameEvaluado']))
            {
                header("Location: ../paginas/visorSala.php?idSala=" . $_POST['idSala'] . "&notif_id=rankedSucess&usr=" . $_POST['nickNameEvaluado']);
                exit();
            }
            else
            {
                header("Location: ../paginas/visorSala.php?idSala=" . $_POST['idSala'] . "&notif_id=error");
                exit();  
            }   
        }
        else
        {
            header("Location: ../paginas/visorSala.php?idSala=" . $_POST['idSala'] . "&notif_id=error");
            exit();
        }
        

    } 


?>