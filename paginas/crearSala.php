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
    <title>Crear Sala</title>

    <link rel="icon" type="image/png" href="../assets/EventConnect.png">
    <link rel="stylesheet" href="../assets/CSS/estilos.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body>

    <div class="login-container">

        <div class="glass-card login-card">

            <div class="login-header">
                <img src="../assets/EventConnect.png" alt="Logo" class="logo-login">
                <h1>EVENTCONNECT</h1>
                <p>Crear nueva sala</p>
            </div>

            <form action="../control/controller.php" method="post">

                <label for="titulo">Título de la sala</label>
                <input
                    class="input-eventconnect"
                    type="text"
                    name="titulo"
                    id="titulo"
                    required
                >

                <label for="descripcion">Descripción de la sala</label>
                <textarea
                    class="input-eventconnect"
                    name="descripcion"
                    id="descripcion"
                    required
                ></textarea>

                <label for="modalidad">Modalidad</label>
                <select
                    class="input-eventconnect"
                    name="modalidad"
                >
                    <option value="Virtual">Virtual</option>
                    <option value="En Persona">En persona</option>
                </select>

                <label for="ubicacion">Ubicación</label>
                <input
                    class="input-eventconnect"
                    type="text"
                    name="ubicacion"
                    id="ubicacion"
                    required
                >

                <label for="fechaHora">Fecha a realizar</label>
                <input
                    class="input-eventconnect"
                    type="datetime-local"
                    name="fechaHora"
                    id="fechaHora"
                    required
                >

                <br>

                <input
                    class="btn-sidebar"
                    type="submit"
                    value="Crear Sala"
                    name="action"
                >

            </form>

        </div>

    </div>

</body>
</html>