<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion </title>
    <link rel="stylesheet"  href="/SistemaBiblioteca/public/css/RegisInis.css">
</head>
<body>
    <div class="contenedor-principal">
        <!-- Columna izquierda con imagen decorativa -->
        <div class="columna-izquierda">
            <img src="/SistemaBiblioteca/public/img/Biblioteca.jpeg" alt="Lámpara de biblioteca" class="imagen-decorativa">
        </div>

        <!-- Columna derecha con el formulario -->
        <div class="columna-derecha">
            <img src="/SistemaBiblioteca/public/img/Logobiblioteca.png" alt="Logo Biblioteca" class="logo">
            <div class="contenedor-formulario">
                <h1>Biblioteca</h1>
                <form action="/SistemaBiblioteca/public/action.php?action=login" method="POST" onsubmit="return validarContrasenas()">
                    <div class="grupo-formulario">
                        <!--aqui hay que modificar al usuario ya que mejor es cedula que no se repite.-->
                        <label for="usuario">Cedula</label>
                        <input type="text" id="usuario" name="usuario"placeholder="Cedula" required>
                    </div>
                    
                    <div class="grupo-formulario">
                        <label for="contrasena">CONTRASEÑA</label>
                        <div class="contrasena-container">
                            <input type="password" id="contrasena" name="contrasena" placeholder="***********" required>
                            <input type="checkbox" onclick="mostrarContrasena('contrasena')">
                        </div>
                    </div>                             
                    <button type="submit" class="boton-registro">Iniciar Sesion</button>
                </form>
                <p class="texto-inicio-sesion">¿No tienes cuenta? <a href="/SistemaBiblioteca/app/views/usuarios/registerUser.php">REGISTRARME</a></p>
            </div>
        </div>
    </div>
    <script src="/public/js/ValidaContra.js"></script>
</body>
</html>