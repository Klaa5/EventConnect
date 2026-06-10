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
    <title>Crear sala</title>
    <link rel="icon" type="image/png" href="../assets/EventConnect.png">
</head>
<body style="background-color: lightblue;">
    <form action="../control/controller.php" method="post">
<h2>EventConnect - Crear nueva sala</h2><br><hr><br>
    <p>Titulo de la sala:</p>
    <input type="text" name="titulo" id="titulo"><br>
    <p>Descripcion de la sala:</p>
    <input type="text" name="descripcion" id="descripcion"><br>
    <p>Modalidad:</p>
    <select name="modalidad">
        <option value="Virtual">Virtual</option>
        <option value="En Persona">En persona</option>
    </select><br>
    <p>Ubicacion:</p>
    <input type="text" name="ubicacion" id="ubicacion"> <br>
    <p>Fecha a realizar:</p>
    <input type="datetime-local" name="fechaHora" id="fechaHora"><br><br>
    <input type="submit" value="Crear">

    </form>
</body>
</html>