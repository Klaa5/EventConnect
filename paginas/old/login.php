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
    <link rel="icon" type="image/png" href="../../assets/EventConnect.png">
</head>
<body style="background-color: lightblue;">
<h4>Iniciar Sesion</h4>
<form action="../../control/controller.php" method="post">

    <p>Ingrese Usuario</p>
    <input type="text" name="nickName" id="nickName">
    <p>Ingrese Contraseña</p>
    <input type="password" name="password" id="password">
    <input type="submit" value="Iniciar Sesión" name="action">

</form>

<hr>
<h4>Crear Cuenta  </h4> 
<form action="../../control/controller.php" method="post">
    <p>Ingrese Nickname</p>
    <input type="text" name="nickNameReg" id="nickNameReg">
    <p>Ingrese Contraseña</p>
    <input type="password" name="passwordReg" id="passwordReg">
    <p>Ingrese Nombre</p>
    <input type="text" name="nombreUser" id="nombreUser">
    <p>Ingrese Apellido</p>
    <input type="text" name="apellidoUser" id="apellidoUser">
    <p>Ingrese Email</p>
    <input type="email" name="emailUser" id="emailUser">
    <p>Ingrese Edad</p>
    <input type="number" name="edadUser" id="edadUser">
    <input type="submit" value="Registrarse" name="action">
</form>
<br><br>

<span>Problemas al registrarse? Haz click </span>
<a href="https://www.youtube.com/watch?v=Hg469wSrZhI">aqui</a>

<br><br><br><br><br>

<p><font size="1">© 1996 EventConnect - MATEX inc</font></p>


</body>
</html>