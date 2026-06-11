<?php
session_start();

if(!empty($_SESSION['nickName']))
{
    header("Location: paginaPrincipal.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventConnect - Login</title>

    <link rel="icon" type="image/png" href="../assets/EventConnect.png">

    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="../assets/CSS/estilos.css" rel="stylesheet">
</head>

<body>

<div class="login-container">

    <div class="glass-card login-card">

        <div class="login-header">

            <img src="../assets/EventConnect.png"
                 alt="EventConnect"
                 class="logo-login">

            <h1>EventConnect</h1>

            <p>Organiza y conecta eventos fácilmente</p>

        </div>

        <div class="login-grid">

            <div class="login-box">

                <h2>Iniciar Sesión</h2>

                <form action="../control/controller.php" method="post">

                    <label>Usuario</label>

                    <input
                        type="text"
                        name="nickName"
                        class="input-eventconnect"
                        required>

                    <label>Contraseña</label>

                    <input
                        type="password"
                        name="password"
                        class="input-eventconnect"
                        >

                    <button
                        type="submit"
                        name="action"
                        value="Iniciar Sesión"
                        class="btn-eventconnect btn-login">

                        Iniciar Sesión

                    </button>

                </form>

            </div>

            <div class="login-box">

                <h2>Crear Cuenta</h2>

                <form action="../control/controller.php" method="post">

                    <label>Usuario</label>

                    <input
                        type="text"
                        name="nickNameReg"
                        class="input-eventconnect"
                        required>

                    <label>Contraseña</label>

                    <input
                        type="password"
                        name="passwordReg"
                        class="input-eventconnect"
                        required>

                    <button
                        type="submit"
                        name="action"
                        value="Registrarse"
                        class="btn-eventconnect btn-register">

                        Registrarse

                    </button>

                </form>

            </div>

        </div>

        <div class="help-section">

            <a href="https://www.youtube.com/watch?v=Hg469wSrZhI" target="_blank">
                ¿Problemas al registrarte?
            </a>

        </div>

        <div class="footer-eventconnect">
            © 2026 EventConnect
        </div>

    </div>

</div>

</body>
</html>