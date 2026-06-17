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
    <link rel="stylesheet" href="../assets/CSS/estilos.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body>

    <aside class="sidebar">

        <div class="sidebar-header">
            <img src="../assets/EventConnect.png" alt="Logo" class="logo-sidebar">
            <h2>EVENTCONNECT</h2>
        </div>

        <div class="sidebar-user">
            Bienvenido<br>
            <strong><?php echo $_SESSION['nickName']; ?></strong>
        </div>

        <form action="crearSala.php">
            <button type="submit" class="btn-sidebar">
                Nueva Sala
            </button>
        </form>

        <form action="./userProfile.php" method="get">
            <input type="hidden" name="nickName" value="<?php echo $_SESSION['nickName']; ?>">
            <button type="submit" class="btn-sidebar">
                Mi Perfil
            </button>
        </form>

        <form action="./listadoSalas.php" method="get">
            <input type="hidden" name="nickName" value="<?php echo $_SESSION['nickName']; ?>">
            <button type="submit" class="btn-sidebar">
                Mis Salas
            </button>
        </form>

        <form action="../control/controller.php" method="post" class="logout-form">
            <button type="submit" name="action" value="Cerrar Sesión" class="btn-logout">
                Cerrar Sesión
            </button>
        </form>

    </aside>

    <main class="main-content">

    <div class="search-container">
    <form action="../control/controller.php" method="post" class="search-form">
        <input type="text" name="palabraBusqueda" placeholder="Buscar sala..." class="input-eventconnect" required>   
        <button type="submit" name="action" value="Buscar Sala" class="btn-search">
            Buscar
        </button> 
    </form>
    </div>

        <div class="glass-card">

            <h1>Salas Disponibles</h1>

            <?php
                include "../control/homeManager.php";

                $homeManager = new HomeManager();
                if(empty($_GET['search']))
                {
                    $homeManager->mostrarSalas();
                }
                else
                {
                    $homeManager->buscarSala($_GET['search']);
                }
                
            ?>

        </div>

    </main>

</body>
</html>