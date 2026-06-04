<?php
session_start();

if (empty($_SESSION['nickName'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Sala - EventConnect</title>

    <link rel="icon" type="image/png" href="../assets/EventConnect.png">

    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>

<body>

    <aside class="sidebar">

        <div class="sidebar-header">
            <img src="../assets/EventConnect.png"
                 alt="Logo"
                 class="logo-sidebar">

            <h2>EventConnect</h2>
        </div>

        <form action="paginaPrincipal.php">
            <button type="submit" class="btn-sidebar">
                ← Volver al Inicio
            </button>
        </form>

        <div class="sidebar-user">
            Conectado como
            <br>
            <strong>
                <?php echo $_SESSION['nickName']; ?>
            </strong>
        </div>

        <form action="../control/sessionManager.php"
              method="post"
              class="logout-form">

            <button type="submit"
                    name="action"
                    value="Cerrar Sesión"
                    class="btn-logout">

                Cerrar Sesión

            </button>

        </form>

    </aside>

    <main class="main-content">

        <div class="glass-card">

            <h1>Crear Sala</h1>

            <form action="../control/crearSalaServer.php" method="post">

                <label>Título de la sala</label>

                <input
                    type="text"
                    name="titulo"
                    class="input-eventconnect"
                    required
                >

                <label>Descripción</label>

                <textarea
                    name="descripcion"
                    class="input-eventconnect"
                    rows="4"
                    required
                ></textarea>

                <label>Modalidad</label>

                <select
                    name="modalidad"
                    class="input-eventconnect"
                >
                    <option value="Virtual">
                        Virtual
                    </option>

                    <option value="En Persona">
                        En Persona
                    </option>
                </select>

                <label>Ubicación</label>

                <input
                    type="text"
                    name="ubicacion"
                    class="input-eventconnect"
                >

                <label>Fecha y hora</label>

                <input
                    type="datetime-local"
                    name="fechaHora"
                    class="input-eventconnect"
                    required
                >

                <button
                    type="submit"
                    class="btn-sidebar"
                    style="margin-top:20px;"
                >
                    Crear Sala
                </button>

            </form>

        </div>

    </main>

</body>
</html>