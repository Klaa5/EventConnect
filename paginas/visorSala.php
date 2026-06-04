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
    <title>EventConnect - Visor de Sala</title>

    <link rel="icon" type="image/png" href="../assets/EventConnect.png">

    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="../assets/CSS/estilos.css" rel="stylesheet">
</head>

<body>

<?php
    include "../control/salaManager.php";

    $salaManager = new SalaManager($_POST['idSala']);
    $sala = $salaManager->obtenerSala($_POST['idSala']);
?>

<aside class="sidebar">

    <div class="sidebar-header">
        <img src="../assets/EventConnect.png"
             alt="Logo"
             class="logo-sidebar">

        <h2>EventConnect</h2>
    </div>

    <form action="paginaPrincipal.php">
        <button type="submit" class="btn-sidebar">
            ← Volver
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

        <h1>
            <?php echo $sala->getTitulo(); ?>
        </h1>

        <div class="info-sala">

            <div class="sala-badge">
                Modalidad:
                <?php echo $sala->getModalidad(); ?>
            </div>

        </div>

        <div class="seccion-sala">

            <h3>Descripción</h3>

            <p>
                <?php echo $sala->getDescripcion(); ?>
            </p>

        </div>

        <div class="seccion-sala">

            <h3>Participantes</h3>

            <?php
                if(count($sala->getParticipantes()) > 0)
                {
                    foreach($sala->getParticipantes() as $participante)
                    {
                        echo '
                        <div class="participante-card">
                            '.$participante.'
                        </div>';
                    }
                }
                else
                {
                    echo '<p>No hay participantes registrados.</p>';
                }
            ?>

        </div>

    </div>

</main>

</body>
</html>