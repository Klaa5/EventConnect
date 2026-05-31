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
    <title>EventConnect - Principal</title>

    <link rel="icon" type="image/png" href="../assets/EventConnect.png">

    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>

<body>
    
    <aside class="sidebar">

        <div class="sidebar-header">
            <img src="../assets/EventConnect.png" alt="Logo" class="logo-sidebar">
            <h2>EventConnect</h2>
        </div>

        <form action="crearSala.php">
            <button type="submit" class="btn-sidebar">
                + Nueva Sala
            </button>
        </form>

        <div class="sidebar-user">
            Bienvenido<br>
            <strong><?php echo $_SESSION['nickName']; ?></strong>
        </div>

        <form action="../control/sessionManager.php" method="post" class="logout-form">
            <button
                type="submit"
                name="action"
                value="Cerrar Sesión"
                class="btn-logout">

                Cerrar Sesión

            </button>
        </form>

    </aside>

    <main class="main-content">

        <div class="glass-card">

            <h1>Salas Disponibles</h1>

            <div class="salas-listado">

                <?php
                    include "../control/paginaPrincipal.php";

                    $paginaPrincipal = new PaginaPrincipal();
                    $paginaPrincipal->mostrarSalas();
                ?>

            </div>

        </div>

    </main>

</body>
</html>