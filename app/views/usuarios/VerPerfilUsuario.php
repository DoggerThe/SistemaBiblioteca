<?php
require_once __DIR__ . '/../../helpers/auth.php';
requireRole(1); // 1 es el rol de usuario normal
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Ecua Librería - Perfil</title>
    <link rel="stylesheet" href="/SistemaBiblioteca/public/css/VerPerfilUsuario.css">
</head>
<body>
    
    <div class="bibliotecario-container">
        
        <header class="header">
            <h1 class="welcome">"Leer, aprender, crecer - Todo en un solo lugar"</h1>

            <div class="button-group">
            <button class="logout-btn" onclick="location.href='/SistemaBiblioteca/public/action.php?action=logout'">CERRAR SESIÓN</button>
            </div>
        </header>

        <div class="separator"></div>

        <aside class="sidebar">
            <div class="menu-list">
                <button class="menu-item " onclick="location.href='ListadoLibrosUsu.php'">Libros</button>
                <button class="menu-item " onclick="location.href='ListadoPrestaUsu.php'">Listado de Préstamos</button>
            </div>
        </aside>

        <main class="main-content">
            <div class="profile-header">
            <div class="profile-imagen-container">
                    <img src="/SistemaBiblioteca/public/img/usuariofoto.png" alt="Foto de perfil" class="profile-pic">       
            </div>

            <div class="user-basic-info">
                <h3 class="user-role">Bibliotecario</h3>
                <p class="user-status">🟢 En línea</p>
            </div>
        </div>
        <form class="profile-form">
            <div class="profile-section">
                <div class="profile-field">
                    <label for="nombres" class="field-title">Nombres</label>
                    <input type="text" id="nombres" name="nombres" class="field-input" value="Daniel Andrés" readonly>
                </div>
        
                <div class="profile-field">
                    <label for="apellidos" class="field-title">Apellidos</label>
                    <input type="text" id="apellidos" name="apellidos" class="field-input" value="Martínez Gamarra" readonly>
                </div>
        
                <div class="profile-field">
                    <label for="cedula" class="field-title">Cédula</label>
                    <input type="text" id="cedula" name="cedula" class="field-input" value="0930622840" readonly>
                </div>
        
                <div class="profile-field">
                    <label for="correo" class="field-title">Correo electrónico</label>
                    <input type="email" id="correo" name="correo" class="field-input" value="DanielM@hotmail.com" readonly>
                </div>
        
                <div class="profile-field address-field">
                    <label for="direccion" class="field-title">Dirección Domiciliaria</label>
                    <input type="text" id="direccion" name="direccion" class="field-input" value="Duran - Cdla El Recreo Mz 559 V7" readonly>
                </div>
            </div>
        
            <div class="profile-actions">
                <!--Inutiles ahora, utiles despues. maybe
                <button type="button" class="edit-profile-btn">Editar Perfil</button>
                <button type="submit" class="save-profile-btn hidden">Guardar</button>
                <button type="button" class="cancel-profile-btn hidden">Cancelar</button>
                -->
                <button type="button" class="change-password-btn">Cambiar Contraseña</button>
            </div>
        </form>
        <div id="modal" class="modal" style="display:none;">
            <div class="modal-content">
                <span class="close" onclick="cerrarModal()">&times;</span>
                <h2>Cambiar contraseña</h2>

                <div class="modal-field">
                    <label for="ContrasenaAntigua">Contraseña actual:</label>
                    <input type="password" id="ContrasenaAntigua" required>
                </div>

                <div class="modal-field">
                    <label for="ContrasenaNueva">Nueva contraseña:</label>
                    <input type="password" id="ContrasenaNueva" required>
                </div>

                <div class="modal-field">
                    <label for="ContrasenaNuevaConfir">Confirmar nueva contraseña:</label>
                    <input type="password" id="ContrasenaNuevaConfir" required>
                </div>

                <div class="modal-actions">
                    <button onclick="confirmarCambio()">Confirmar Cambio</button>
                </div>
            </div>
        </div>
        <script>
            const idUsuario = <?php echo $_SESSION['usuario']['id']; ?>;
        </script>
        </main>
    </div>
    <script src="/SistemaBiblioteca/public/js/VerPerfilUsuario.js"></script>
</body>
</html>