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
    <link rel="icon" type="image/png" href="../assets/EventConnect.png">
</head>
<body style="background-color: lightblue;">
    <?php
        include_once "../control/salaContentManager.php";

        if(!isset($_GET['idSala']))
        {
            header("Location: paginaPrincipal.php");
            exit();
        }

        if(!isset($_GET['action']))
        {
            $_GET['action'] = "";   //Esto es para evitar los errores de variable
        }

        $salaContentManager = new SalaContentManager($_GET['idSala']);
        $sala = $salaContentManager->obtenerSala($_GET['idSala']);  
        
        if($_GET['action'] == 'error')
        {
            echo "<p style='color:red'>Error inesperado. Intente nuevamente.</p>";
        }

        //Esto para evitar accesos ilegales cuando la sala esta finalizada.
        if($sala->getEstado() != "EN_PREPARACION"   && !in_array($_SESSION['nickName'], $sala->getParticipantes()) && $_SESSION['nickName'] != $sala->getNickNameCreador())
        {
            header("Location: paginaPrincipal.php");
            exit();
        }
        
    ?>

    <h2>EventConnect - Visor de Sala</h2>
    <br>
    <hr>
    
    <form action="./paginaPrincipal.php" method="post">
        <input type="submit" value="Volver a pagina principal">
    </form>
    
    <h3>Nombre Sala: <?php echo $sala->getTitulo(); ?></h3>
    <h4>Modalidad: <?php echo $sala->getModalidad(); ?></h4>
  

    <?php
        //Siempre y cuando el user no sea el creador o que no este dentro de los participantes.
        if($_SESSION['nickName'] != $sala->getNickNameCreador() && !in_array($_SESSION['nickName'], $sala->getParticipantes()))
        {?>
            <form action="../control/controller.php" method="POST">
                <input type="hidden" name="idSala" value="<?php echo $sala->getIdSala(); ?>">
                <button type="submit" name="action" value="Unirse">Unirse</button>
            </form>
        <?php
        }
    ?>

    <hr>
    <p>Descripción: <?php echo $sala->getDescripcion(); ?></p>
    <hr>
    <p>Participantes:</p>
    <?php
        echo "<p>" . $sala->getNickNameCreador() . " (Creador)</p>";
        foreach($sala->getParticipantes() as $participante)
        {
            echo "<span>" . $participante . "</span>";

            if($_SESSION['nickName'] == $sala->getNickNameCreador())
            {
                ?>
                <form action="../control/controller.php" method="POST" style="display:inline;">
                    <input type="hidden" name="idSala" value="<?php echo $sala->getIdSala(); ?>">
                    <input type="hidden" name="nickName" value="<?php echo $participante; ?>">
                    <button type="submit" name="action" value="Eliminar Participante">
                        <span style='color:red'> Eliminar Participante </span>
                    </button>
                </form>
                <br>
                <?php
            }
        }
    ?>
    <hr>
    <p>Mensajes:</p>
    <?php
        $chat = $salaContentManager->obtenerChat($_GET['idSala']);
        foreach($chat as $mensaje)
        {
            echo "<p><strong>" . $mensaje->getNicknameEmisor() . ":</strong> " . $mensaje->getContenido() . " <small><em> <" . date("d/m/Y H:i", strtotime($mensaje->getFechaHora())) . "</em>></small></   p>";
        }
    ?>
    

    <form action="../control/controller.php" method="POST">
        <input
            type="hidden"
            name="idSala"
            value="<?php echo $sala->getIdSala(); ?>"
        >

        <input
            type="text"
            name="mensaje"
            maxlength="500"
            placeholder="Escribe un mensaje..."
            required
        >

        <button type="submit" name="action" value="Enviar Mensaje">
            Enviar
        </button>
    </form>

</body>
</html>