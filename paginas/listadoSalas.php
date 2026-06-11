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

    


</body>
</html>