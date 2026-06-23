<?php
session_start();

    if(!empty($_SESSION['nickName']))   
    {
        header("Location: paginaPrincipal.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventConnect - Login</title>
    <link rel="stylesheet" href="../assets/CSS/estilos.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="../assets/EventConnect.png">
</head>
<body>
<?php


    if(isset($_GET['notif_id']))
    {
        if($_GET['notif_id'] == "errorLogin")
        {
?>
            <div class="toast toast-error">
                <?= htmlspecialchars("Usuario o contraseña incorrectos") ?>
            </div>
<?php
        }

        if($_GET['notif_id'] == "errorReg")
        {
?>
            <div class="toast toast-error">
                <?= htmlspecialchars("Error al registrarse, revise los datos ingresados") ?>
            </div>
<?php
        }


    }

?>
<div class="login-container">

    <div class="glass-card login-card">

        <div class="login-header">
            <img src="../assets/EventConnect.png" alt="EventConnect" class="logo-login">
            <h1>EVENTCONNECT</h1>
            <p>Conecta personas, crea eventos</p>
        </div>

        <div class="login-grid">
            <div class="login-box">

                <h2>Iniciar Sesión</h2>

                <form action="../control/controller.php" method="post">

                    <label for="nickName">Usuario</label>
                    <input
                        class="input-eventconnect"
                        type="text"
                        name="nickName"
                        id="nickName"
                    >

                    <label for="password">Contraseña</label>
                    <input
                        class="input-eventconnect"
                        type="password"
                        name="password"
                        id="password"
                    >

                    <input
                        class="btn-login"
                        type="submit"
                        value="Iniciar Sesión"
                        name="action"
                    >

                </form>

            </div>
            <div class="login-box">

                <h2>Crear Cuenta</h2>

                <form action="../control/controller.php" method="post">

                    <label for="nickNameReg">Nickname</label>
                    <input
                        class="input-eventconnect"
                        type="text"
                        name="nickNameReg"
                        id="nickNameReg"
                    >

                    <label for="passwordReg">Contraseña</label>
                    <input
                        class="input-eventconnect"
                        type="password"
                        name="passwordReg"
                        id="passwordReg"
                    >

                    <label for="nombreUser">Nombre</label>
                    <input
                        class="input-eventconnect"
                        type="text"
                        name="nombreUser"
                        id="nombreUser"
                    >

                    <label for="apellidoUser">Apellido</label>
                    <input
                        class="input-eventconnect"
                        type="text"
                        name="apellidoUser"
                        id="apellidoUser"
                    >

                    <label for="emailUser">Email</label>
                    <input
                        class="input-eventconnect"
                        type="email"
                        name="emailUser"
                        id="emailUser"
                    >

                    <label for="edadUser">Edad</label>
                    <input
                        class="input-eventconnect"
                        type="number"
                        name="edadUser"
                        id="edadUser"
                    >

                    <br>

                    <input
                        class="btn-register"
                        type="submit"
                        value="Registrarse"
                        name="action"
                    >

                </form>

            </div>

        </div>

        <br>

        <div class="footer-eventconnect">
            © 2026 EventConnect
        </div>

    </div>

</div>

</body>
</html>