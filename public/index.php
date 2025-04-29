<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/SistemaBiblioteca/public/css/pantallainicio.css">
</head>
<body>
    <img src="/SistemaBiblioteca/public/img/bibliotecaFoto.jpg">
    <div class="background"></div>
    <div class="overlay">
        <h1>BIENVENIDOS</h1>
        <div class="logo-container">
            <img src="/SistemaBiblioteca/public/img/logo.jpg" alt="Logo Ecua Librería">
        </div>
        <div class="buttons">
            <button onclick="location.href='/SistemaBiblioteca/app/views/usuarios/login.php'">LOGIN</button>
            <button onclick="location.href='/SistemaBiblioteca/app/views/usuarios/registerUser.php'">REGISTRO</button>
        </div>
    </div>
</body>
<!-- //<a href="/SistemaBiblioteca/app/views/usuarios/registerUser.php">Registrarse</a><br>
//<a href="/SistemaBiblioteca/app/views/usuarios/login.php">Iniciar Sesión</a> -->
</html>