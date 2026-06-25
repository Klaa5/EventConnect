<?php
session_start();


include_once __DIR__ . "/../control/accountManager.php";

if (!isset($_GET['token'])) {
    die("Token invalido");
}

$token = $_GET['token'];

$accountManager = new accountManager();

$ok = $accountManager->verificarUsuario($token);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Verificación - EventConnect</title>

    <link rel="stylesheet" href="../assets/CSS/estilos.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body>

<div class="login-container">

    <div class="login-card">

        <div class="glass-card" style="text-align:center;">

            <?php if ($ok) { ?>

                <div style="font-size:70px; margin-bottom:15px; color:var(--success);">
                    ✔
                </div>

                <h1>Cuenta verificada</h1>

                <p style="margin-top:10px; opacity:.9;">
                    Tu cuenta fue verificada correctamente en EventConnect.
                </p>

                <form action="../paginas/login.php" method="get" style="margin-top:25px;">
                    <button class="btn-login" type="submit">
                        Ir al login
                    </button>
                </form>

            <?php } else { ?>

                <div style="font-size:70px; margin-bottom:15px; color:var(--danger);">
                    ✖
                </div>

                <h1>Error de verificación</h1>

                <p style="margin-top:10px; opacity:.9;">
                    El enlace es inválido o ya fue utilizado.
                </p>

                <form action="../paginas/login.php" method="get" style="margin-top:25px;">
                    <button class="btn-sidebar" type="submit">
                        Volver
                    </button>
                </form>

            <?php } ?>

        </div>

    </div>

</div>

</body>
</html>