<?php   
session_start();

    if(empty($_SESSION['nickName']))   
    {
        header("Location: login.php");
        exit();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventConnect - Visor de Sala</title>
    <link rel="stylesheet" href="../assets/CSS/estilos.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="../assets/EventConnect.png">
</head>
<body>

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

</aside>

<main class="main-content">

<div class="glass-card">

<?php
    include_once "../control/salaContentManager.php";
    include_once "../control/accountManager.php";
    include_once "../control/rankManager.php";

    $accountManager = new accountManager();

    if(!isset($_GET['idSala']))
    {
        header("Location: paginaPrincipal.php");
        exit();
    }

    if(!isset($_GET['action']))
    {
        $_GET['action'] = "";
    }

    $salaContentManager = new SalaContentManager($_GET['idSala']);
    $rankManager = new RankManager();
    $sala = $salaContentManager->obtenerSala($_GET['idSala']);

    if($_GET['action'] == 'error')
    {
        echo "<p style='color:red'>Error inesperado. Intente nuevamente.</p>";
    }

    if(
        $sala->getEstado() != "EN_PREPARACION" &&
        !in_array($_SESSION['nickName'], $sala->getParticipantes()) &&
        $_SESSION['nickName'] != $sala->getNickNameCreador()
    )
    {
        header("Location: paginaPrincipal.php");
        exit();
    }
?>

<h1><?php echo $sala->getTitulo(); ?></h1>

<div class="info-sala">
    <div class="sala-badge">
        Fecha inicio:
        <?php echo date("d/m/Y H:i", strtotime($sala->getFechaHora())); ?>
    </div>
</div>

<?php
if($sala->getModalidad() == 'virtual')
{
    echo "<p style='color:#4ade80;'>🌐 Evento Online / Virtual</p>";
}
?>

<?php
if(
    $_SESSION['nickName'] != $sala->getNickNameCreador() &&
    !in_array($_SESSION['nickName'], $sala->getParticipantes())
)
{
?>
    <form action="../control/controller.php" method="POST">

        <input
            type="hidden"
            name="idSala"
            value="<?php echo $sala->getIdSala(); ?>"
        >

        <button
            class="btn-sidebar"
            type="submit"
            name="action"
            value="Unirse"
        >
            Unirse
        </button>

    </form>
<?php
}
?>

<div class="seccion-sala">

    <h3>Descripción</h3>

    <p>
        <?php echo $sala->getDescripcion(); ?>
    </p>

</div>

<div class="seccion-sala">

    <h3>Participantes</h3>

    <?php
    $creador = $sala->getNickNameCreador();
    ?>

    <div class="participante-card" onclick="window.location.href='userProfile.php?nickName=<?php echo urlencode($creador); ?>'" style="cursor:pointer;">
        <strong><?php echo $creador; ?></strong> (Creador) 
        <?php $datos = $accountManager->obtenerDatosUsuario($creador);
            echo "<i>(" . $datos->getRankPromedio() . ")</i>";
        ?>
    </div>

    <?php
    foreach($sala->getParticipantes() as $participante)
    {

    ?>
        <div
            class="participante-card"
            onclick="window.location.href='userProfile.php?nickName=<?php echo urlencode($participante); ?>'"
            style="cursor:pointer; display: flex; justify-content: space-between; align-items: center; padding: 10px;"
        >
            <span>
                <?php 
                    $datos = $accountManager->obtenerDatosUsuario($participante);
                    echo $participante . " <i>(" . $datos->getRankPromedio() . ")</i>" ;
                ?>
            </span>

            <?php 
            if ($sala->getEstado() == 'FINALIZADA') 
            {    
                // Si esta finalizada
                if ($_SESSION['nickName'] != $participante && !$rankManager->evaluado($participante,$_SESSION['nickName'],$sala->getIdSala())) 
                {
            ?>
                    <form action="../control/controller.php" method="POST" onclick="event.stopPropagation();" style="margin: 0; display: flex; gap: 5px; align-items: center;">
                        <input type="hidden" name="idSala" value="<?php echo $sala->getIdSala(); ?>">
                        <input type="hidden" name="nickNameEvaluado" value="<?php echo trim($participante); ?>">
                        
                        <input 
                            type="number" 
                            name="puntaje" 
                            step="1" 
                            min="0" 
                            max="5" 
                            placeholder="0"
                            required
                            style="width: 50px; padding: 3px; font-size: 12px; text-align: center;"
                        >

                        <button
                            class="btn-votar-chico"
                            type="submit"
                            name="action"
                            value="Calificar"
                        >
                            Calificar participante
                        </button>
                    </form>
            <?php 
                } 
            } 
            // Caso sala en preparacion
            else {
                if($_SESSION['nickName'] == $sala->getNickNameCreador()) {
            ?>
                    <form action="../control/controller.php" method="POST" onclick="event.stopPropagation();" style="margin: 0;">
                        <input type="hidden" name="idSala" value="<?php echo $sala->getIdSala(); ?>">
                        <input type="hidden" name="nickName" value="<?php echo trim($participante); ?>">

                        <button
                            class="btn-logout btn-eliminar-chico"
                            type="submit"
                            name="action"
                            value="Eliminar Participante"
                        >
                            X
                        </button>
                    </form>
            <?php
                }
            }
            ?>
        </div>
    <?php
    }
?>


</div>

<?php

if(
    $_SESSION['nickName'] == $sala->getNickNameCreador() ||
    in_array($_SESSION['nickName'], $sala->getParticipantes())
)
{
?>

<div class="seccion-sala">

    <h3>Mensajes</h3>

    <?php

    $chat = $salaContentManager->obtenerChat($_GET['idSala']);

    foreach($chat as $mensaje)
    {
        echo "
        <div class='participante-card'>
            <strong>".$mensaje->getNicknameEmisor().":</strong>
            ".$mensaje->getContenido()."
            <br>
            <small>"
            .date("d/m/Y H:i", strtotime($mensaje->getFechaHora()))."
            </small>
        </div>";
    }

    ?>

    <form action="../control/controller.php" method="POST">

        <input
            type="hidden"
            name="idSala"
            value="<?php echo $sala->getIdSala(); ?>"
        >

        <input
            class="input-eventconnect"
            type="text"
            name="mensaje"
            maxlength="100"
            placeholder="Escribe un mensaje..."
            required
        >

        <button
            class="btn-sidebar"
            type="submit"
            name="action"
            value="Enviar Mensaje"
        >
            Enviar
        </button>

    </form>

</div>

<?php
}
?>

</div>
</main>

</body>
</html>