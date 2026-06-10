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
    <title>EventConnect - Principal</title>
    <link rel="icon" type="image/png" href="../assets/EventConnect.png">
</head>
<body style="background-color: lightblue;">
    <h2>EventConnect - main</h2><br><br>
    <hr>
    <form action="crearSala.php">
        <button type="submit">Nueva sala</button>
    </form>
    <form action="../control/sessionManager.php" method="post">
        <input type="submit" value="Cerrar Sesión" name="action">
    </form>
    
    <hr>
    <h3>Salas disponibles:</h3>
    <?php
        include "../control/paginaPrincipal.php";
        $paginaPrincipal = new PaginaPrincipal();
        $paginaPrincipal->mostrarSalas();
    ?>


</body>
</html>