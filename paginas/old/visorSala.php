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
        include "../control/salaManager.php";
        $salaManager = new SalaManager($_POST['idSala']);
        $sala = $salaManager->obtenerSala($_POST['idSala']);      
    ?>

    <h2>EventConnect - Visor de Sala</h2>
    <br>
    <hr>
    <h3>Nombre Sala: <?php echo $sala->getTitulo(); ?></h3>
    <h4>Modalidad: <?php echo $sala->getModalidad(); ?></h4>
    <hr>
    <p>Descripción: <?php echo $sala->getDescripcion(); ?></p>
    <hr>
    <p>Participantes:</p>
    <br>
    <?php
        foreach($sala->getParticipantes() as $participante)
        {
            echo "<p>" . $participante . "</p>";
        }
    ?>

</body>
</html>