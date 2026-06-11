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
    <title>EventConnect - Mis salas</title>
</head>
<body style="background-color: lightblue;">
    <h2>EventConnect - Mis salas</h2><br><hr><br>

    <form action="./paginaPrincipal.php" method="post">
        <input type="submit" value="Volver a pagina principal">
    </form>

    <?php

        include_once "../control/salaManager.php";
        
        $salaManager = new SalaManager($_SESSION['nickName']);

        $salasUser = $salaManager->obtenerSalasUsuario();

        foreach($salasUser as $sala)
        {
             echo "
            <div style='border:1px solid #000; padding:12px; margin:10px; width:320px; background:#e9e9e9;'>
                <h3 style='margin:0 0 5px 0;'>" . $sala->getTitulo() . "</h3>
                <span>Fecha: " .
                date("d/m/Y H:i", strtotime($sala->getFechaHora())) .
                "</span>
            </div>
            ";

        }


    


    ?>


</body>
</html>