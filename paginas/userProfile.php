<?php
session_start();

if(empty($_SESSION['nickName']))
{
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventConnect - Perfil de usuario</title>

    <link rel="icon" type="image/png" href="../assets/EventConnect.png">
    <link rel="stylesheet" href="../assets/CSS/estilos.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body>

<?php
    include_once "../control/accountManager.php";
    include_once "../control/rankManager.php";

    $userData = $_GET['nickName'];

    $accountManager = new accountManager();
    $rankManager = new RankManager();
    $datosUsuario = $accountManager->obtenerDatosUsuario($userData);
    $ranksRecibidos = $rankManager->obtenerRanksUser($datosUsuario->getNickName());
    $cantidadVotos = count($ranksRecibidos);


    if(isset($_GET['notif_id']))
    {
        if($_GET['notif_id'] == "datosActualizados")
        {
?>
            <div class="toast toast-spec">
                <?= htmlspecialchars("Link de perfil actualizado") ?>
            </div>            
<?php
        }

        if($_GET['notif_id'] == "correoVerifEnviado")
        {
?>
            <div class="toast toast-spec">
                <?= htmlspecialchars("Link de notificacion enviado, revise su casilla de eMail") ?>
            </div>            
<?php
        }

        if($_GET['notif_id'] == "correoVerifError")
        {
?>
            <div class="toast toast-spec">
                <?= htmlspecialchars("Error al enviar link de verificacion, intente nuevamente") ?>
            </div>            
<?php
        }

    }




?>

<aside class="sidebar">

    <div class="sidebar-header">
        <img src="../assets/EventConnect.png" alt="Logo" class="logo-sidebar">
        <h2>EVENTCONNECT</h2>
    </div>

    <div class="sidebar-user">
        Usuario:<br>
        <strong><?php echo $_SESSION['nickName']; ?></strong>
    </div>

    <form action="./paginaPrincipal.php" method="post">
        <button type="submit" class="btn-sidebar">
            Página Principal
        </button>
    </form>

    <form action="./listadoSalas.php" method="get">
        <input
            type="hidden"
            name="nickName"
            value="<?php echo $datosUsuario->getNickName(); ?>"
        >

        <button type="submit" class="btn-sidebar">
            Mis Salas
        </button>
    </form>

</aside>

<main class="main-content">

    <div class="glass-card">

        <h1>Perfil de Usuario</h1>

        <div>
            <strong>Nickname:</strong>
            <?php echo $datosUsuario->getNickName(); ?><br><br>

        </div>

        <div>
            <strong>Nombre:</strong>
            <?php echo $datosUsuario->getNombre(); ?><br><br>

        </div>

        <div>
            <strong>Apellido:</strong>
            <?php echo $datosUsuario->getApellido(); ?><br><br>
        </div>

        <div>
            <strong>Email:</strong>
            <?php echo $datosUsuario->getEmail(); ?><br><br>
        </div>

        <div>
            <strong>Edad:</strong>
            <?php echo $datosUsuario->getEdad(); ?><br><br>
        </div>

        <?php
        
        $rankPromedio = $datosUsuario->getRankPromedio(); 

        
        if ($rankPromedio >= 0 && $rankPromedio < 3) 
        {
            $claseColor = "rank-rojo";
        } 
        elseif ($rankPromedio >= 3 && $rankPromedio < 5) 
        {
            $claseColor = "rank-verde";
        } 
        elseif ($rankPromedio == 5) 
        {
            $claseColor = "rank-azul";
        } 
        else 
        {
            $claseColor = ""; 
        }
        ?>

        <strong>Puntaje de la comunidad: 
            <span class="<?php echo $claseColor; ?>">
                <strong>
                    <?php
                        if($rankPromedio != 0 && $cantidadVotos != 0)
                        {
                            echo $rankPromedio;
                        }
                        else
                        {
                            echo 'Sin calificaciones';
                        } 
                    ?>
                </strong>
            
            </span> 
        </strong>
        <i> <?php echo '(' . $cantidadVotos . ") votos"; ?> </i>
        <br><br>

        <div class="participante-card">
            <form action="../control/controller.php" method="post">
                <strong>Link:</strong>
                <input
                    type="text"
                    name="link"
                    class="input-eventconnect"
                    value="<?php echo $datosUsuario->getLink(); ?>"
                    placeholder="Ingrese su link"
                >
                <input
                    type="hidden"
                    name="nickName"
                    value="<?php echo $datosUsuario->getNickName(); ?>"
                >
                <button
                    type="submit"
                    name="action"
                    value="Actualizar Link"
                    class="btn-regresar"
                    style="margin-top:10px;"
                >
                    Actualizar Link
                </button>
            </form>
        </div>

        <div class="seccion-sala">

        <?php

        if($datosUsuario->getVerifiedUser())
        {
            echo "<p style='color:#4ade80;'> Usuario verificado</p>";
        }
        else
        {
            echo "<p style='color:#ff6b6b;'> Usuario no verificado</p>";
            ?>
        <form action="../control/controller.php" method="POST">

            <input
                type="hidden"
                name="nickName"
                value="<?php echo $_SESSION['nickName']; ?>"
            >

            <button
                class="btn-sidebar"
                type="submit"
                name="action"
                value="Enviar Verificacion"
            >
                Verificar con Email
            </button>

        </form>
        <?php
        }

        ?>

        </div>

    </div>

</main>

</body>
</html>