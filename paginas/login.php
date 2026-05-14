<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventConnect - Login</title>
    <link rel="icon" type="image/png" href="../assets/EventConnect.png">
</head>
<body style="background-color: lightblue;">
<h4>Iniciar Sesion</h4>
<form action="../control/verificacionLoginRegistro.php" method="post">

    <p>Ingrese Usuario</p>
    <input type="text" name="nickName" id="nickName">
    <p>Ingrese Contraseña</p>
    <input type="password" name="password" id="password">
    <input type="submit" value="Iniciar Sesión" name="action">

</form>

<hr>
<h4>Crear Cuenta  </h4> 
<form action="../control/verificacionLoginRegistro.php" method="post">
    <p>Ingrese Nombre de Usuario</p>
    <input type="text" name="nickNameReg" id="nickNameReg">
    <p>Ingrese Contraseña</p>
    <input type="password" name="passwordReg" id="passwordReg">
    <input type="submit" value="Registrarse" name="action">
</form>
<br><br>

<span>Problemas al registrarse? Haz click </span>
<a href="https://www.youtube.com/watch?v=Hg469wSrZhI">aqui</a>

<br><br><br><br><br>

<p><font size="1">© 1996 EventConnect - MATEX inc</font></p>


</body>
</html>