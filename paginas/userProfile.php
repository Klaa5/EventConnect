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
    <title>EventConnect - Perfil de usuario</title>

    <link rel="icon" type="image/png" href="../assets/EventConnect.png">
    <link rel="stylesheet" href="../assets/CSS/estilos.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body>

<?php
    include_once "../control/accountManager.php";

    $userData = $_GET['nickName'];

    $accountManager = new accountManager();
    $datosUsuario = $accountManager->obtenerDatosUsuario($userData);
?>

<aside class="sidebar">

    <div class="sidebar-header">
        <img src="../assets/EventConnect.png" alt="Logo" class="logo-sidebar">
        <h2>EVENTCONNECT</h2>
    </div>

    <div class="sidebar-user">
        Usuario:<br>
        <strong><?php echo $_SESSION['nickName']; ?></strong>
    </div>

    <form action="./paginaPrincipal.php" method="post">
        <button type="submit" class="btn-sidebar">
            Página Principal
        </button>
    </form>

    <form action="./listadoSalas.php" method="get">
        <input
            type="hidden"
            name="nickName"
            value="<?php echo $_SESSION['nickName']; ?>"
        >

        <button type="submit" class="btn-sidebar">
            Mis Salas
        </button>
    </form>

</aside>

<main class="main-content">

    <div class="glass-card">

        <h1>Perfil de Usuario</h1>

        <div class="participante-card">
            <strong>Nickname:</strong>
            <?php echo $_SESSION['nickName']; ?>
        </div>

        <div class="participante-card">
            <strong>Nombre:</strong>
            <?php echo $datosUsuario->getNombre(); ?>
        </div>

        <div class="participante-card">
            <strong>Apellido:</strong>
            <?php echo $datosUsuario->getApellido(); ?>
        </div>

        <div class="participante-card">
            <strong>Email:</strong>
            <?php echo $datosUsuario->getEmail(); ?>
        </div>

        <div class="participante-card">
            <strong>Edad:</strong>
            <?php echo $datosUsuario->getEdad(); ?>
        </div>

        <div class="participante-card">
            <strong>Link:</strong>
            <?php echo $datosUsuario->getLink(); ?>
        </div>

        <div class="seccion-sala">

        <?php

        if($datosUsuario->getVerifiedUser())
        {
            echo "<p style='color:#4ade80;'>✓ Usuario verificado</p>";
        }
        else
        {
            echo "<p style='color:#ff6b6b;'>✗ Usuario no verificado</p>";
            echo "<button class='btn-sidebar'>Verificar con Email</button>";
        }

        ?>

        </div>

    </div>

</main>

</body>
</html>