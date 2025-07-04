<?php
session_start(); // Muy importante para leer $_SESSION
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8"> <!-- Codificación de caracteres en UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Adaptabilidad a dispositivos móviles -->
    <title>Registro Biblioteca</title> <!-- Título del documento -->
    <link rel="stylesheet" href="/SistemaBiblioteca/public/css/RegisInis.css"> <!-- Enlace al archivo CSS del formulario -->
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
                <!-- Mostrar error en caso de que exista un mensaje en la sesión -->
                <?php if (isset($_SESSION['error'])): ?>
                    <div style="color: red;">
                        <?php
                        echo $_SESSION['error']; // Se imprime el mensaje de error
                        unset($_SESSION['error']); // Se elimina el mensaje para no mostrarlo repetidamente
                        ?>
                    </div>
                <?php endif; ?>
                <?php
                $old = $_SESSION['old'] ?? []; // Guarda los valores anteriores del formulario para no perderlos
                unset($_SESSION['old']); // Limpia después de usarlos
                ?>
                <form action="/SistemaBiblioteca/index.php?action=registrar" method="POST" onsubmit="return validarContrasenas()">
                    <!-- Campo: Nombre -->
                    <div class="grupo-formulario">
                        <label for="nombre">NOMBRE</label>
                        <input type="text" id="nombre" name="nombre" placeholder="Nombre" value="<?= htmlspecialchars($old['nombre'] ?? '') ?>" required>
                    </div>
                    <!-- Campo: Apellido -->
                    <div class="grupo-formulario">
                        <label for="apellido">APELLIDO</label>
                        <input type="text" id="apellido" name="apellido" placeholder="Apellido" value="<?= htmlspecialchars($old['apellido'] ?? '') ?>" required>
                    </div>
                    <!-- Campo: Cédula -->
                    <div class="grupo-formulario">
                        <label for="cedula">CÉDULA</label>
                        <input type="text" id="cedula" name="cedula" maxlength="10" minlength="10" placeholder="0999999999" value="<?= htmlspecialchars($old['cedula'] ?? '') ?>" required>
                    </div>
                    <!-- Campo: Correo electrónico -->
                    <div class="grupo-formulario">
                        <label for="email">CORREO ELECTRÓNICO</label>
                        <input type="email" id="email" name="email" placeholder="correo@example.com" value="<?= htmlspecialchars($old['email'] ?? '') ?>" required>
                    </div>
                    <!-- Campo: Dirección -->
                    <div class="grupo-formulario">
                        <label for="direccion">DIRECCIÓN</label>
                        <input type="text" id="direccion" name="direccion" placeholder="Direccion" value="<?= htmlspecialchars($old['direccion'] ?? '') ?>" required>
                    </div>
                    <!-- Campo: Contraseña -->
                    <div class="grupo-formulario">
                        <label for="contrasena">CONTRASEÑA</label>
                        <div class="contrasena-container">
                            <input type="password" id="contrasena" name="password" placeholder="***********" required>
                            <input type="checkbox" onclick="mostrarContrasena('contrasena')">
                        </div>
                    </div>
                    <!-- Campo: Confirmar contraseña -->
                    <div class="grupo-formulario">
                        <label for="confirmar">CONFIRMAR CONTRASEÑA</label>
                        <div class="contrasena-container">
                            <input type="password" id="confirmar" name="confirmar" placeholder="***********" required>
                            <input type="checkbox" onclick="mostrarContrasena('confirmar')">
                        </div>
                    </div>

                    <button type="submit" class="boton-registro">REGISTRARME</button>

                    <div id="modal" class="modal">
                        <div class="modal-contenido">
                            <span class="cerrar" id="cerrarModal">&times;</span>
                            <h2>Alerta</h2>
                            <p>Las contraseñas no coinciden</p>
                        </div>
                    </div>
                </form>
                <p class="texto-inicio-sesion">¿Ya tienes cuenta? <a href="/SistemaBiblioteca/app/views/generales/login.php"> INICIAR SESIÓN </p>
            </div>
        </div>
    </div>
    <script src="/SistemaBiblioteca/public/js/ValidaContra.js"></script>
</body>

</html>