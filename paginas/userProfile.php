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
    <title>EventConnect - Perfil de usuario</title>
    <link rel="icon" type="image/png" href="../assets/EventConnect.png">
</head>
<body style="background-color: lightblue;">
    <h2>EventConnect - Perfil de <?php echo $_SESSION['nickName']; ?></h2><br><hr><br>

    <form action="./paginaPrincipal.php" method="post">
        <input type="submit" value="Volver a pagina principal">
    </form>
    
    <form action="./listadoSalas.php" method="get">
        <input type="hidden" name="nickName" value="<?php echo $_SESSION['nickName']; ?>">
        <input type="submit" value="Mis Salas">
    </form>

    <?php
        include_once "../control/accountManager.php";
        
        $userData = $_GET['nickName'];
        $accountManager = new accountManager();
        $datosUsuario = $accountManager->obtenerDatosUsuario($userData);
        
        echo "<p>Nombre: ".$datosUsuario->getNombre()."</p>";
        echo "<p>Apellido: ".$datosUsuario->getApellido()."</p>";
        echo "<p>Email: ".$datosUsuario->getEmail()."</p>";
        echo "<p>Edad: ".$datosUsuario->getEdad()."</p>";
        echo "<p>Link: ".$datosUsuario->getLink()."</p>";
        
        if($datosUsuario->getVerifiedUser())
        {
            echo "<p style='color: green;'>Usuario verificado</p>";
        }
        else
        {
            echo "<span style='color: red;'>Usuario no verificado </span>";
            echo "<button> Verificar con eMail</button>";
        }
        
    ?>
</body>
</html>