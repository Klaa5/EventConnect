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
    <title>EventConnect - Mis Salas</title>

    <link rel="icon" type="image/png" href="../assets/EventConnect.png">
    <link rel="stylesheet" href="../assets/CSS/estilos.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body>

<div class="login-container">

    <div class="glass-card login-card">

        <div class="login-header">
            <img src="../assets/EventConnect.png" alt="Logo" class="logo-login">
            <h1>MIS SALAS</h1>
        </div>

        <form action="./paginaPrincipal.php" method="post">
            <button type="submit" class="btn-sidebar">
                Volver a página principal
            </button>
        </form>

        <br>

        <div class="salas-listado">

        <?php

        include_once "../control/salaManager.php";

        $salaManager = new SalaManager($_SESSION['nickName']);

        $salasUser = $salaManager->obtenerSalasUsuario();

        foreach($salasUser as $sala)
        {

            if($sala->getModalidad() == "virtual")
            {
                $mod = "🌐 Evento Online / Virtual";
            }
            else
            {
                $mod = "📍 Evento Presencial";
            }

            echo "
            <form class='sala-form' action='../paginas/visorSala.php' method='get'>

                <input
                    type='hidden'
                    name='idSala'
                    value='".$sala->getIdSala()."'
                >

                <button type='submit' class='sala-card'>

                    <div class='sala-titulo'>
                        ".$sala->getTitulo()."
                    </div>

                    <div class='sala-info'>
                        Fecha de inicio:
                        ".date("d/m/Y H:i", strtotime($sala->getFechaHora()))."
                        <br><br>
                        ".$mod."
                    </div>

                </button>

            </form>";
        }

        ?>

        </div>

        <div class="footer-eventconnect">
            EventConnect © 2026
        </div>

    </div>

</div>

</body>
</html>