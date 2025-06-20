<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Fuente personalizada desde Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Ecua Librería - Perfil</title>
    <link rel="stylesheet" href="/SistemaBiblioteca/public/css/InicioGeneral.css">
    <link rel="stylesheet" href="/SistemaBiblioteca/public/css/VerPerfilUsuario.css">
</head>

<body>
    <!-- Contenedor principal -->
    <div class="bibliotecario-container">
        <?php include __DIR__ . '/../layout/layoutAdministrador.php'; ?>

        <main class="main-content">
            <div class="Elementos-container">
                <div class="profile-header">
                    <div class="profile-imagen-container">
                        <img src="/SistemaBiblioteca/public/img/usuariofoto.png" alt="Foto de perfil" class="profile-pic">
                    </div>
                    <!-- Información básica del usuario -->
                    <div class="user-basic-info">
                        <h3 class="user-role">Administrador</h3>
                        <p class="user-status">🟢 En línea</p>
                    </div>
                    <!-- Botón para abrir el modal de cambio de contraseña -->
                    <div class="profile-actions">
                        <button type="button" class="change-password-btn">Cambiar Contraseña</button>
                    </div>
                </div>
                <!-- Formulario con la información del perfil del usuario -->
                <form class="profile-form">
                    <div class="profile-section-columns">
                        <!-- Columna izquierda -->
                        <div class="profile-column">
                            <div class="profile-field">
                                <label for="nombres" class="field-title">Nombres</label>
                                <input type="text" id="nombres" name="nombres" class="field-input" value="Daniel" readonly>
                            </div>
                            <div class="profile-field">
                                <label for="apellidos" class="field-title">Apellidos</label>
                                <input type="text" id="apellidos" name="apellidos" class="field-input" value="Martínez" readonly>
                            </div>
                            <div class="profile-field">
                                <label for="cedula" class="field-title">Cédula</label>
                                <input type="text" id="cedula" name="cedula" class="field-input" value="011111111" readonly>
                            </div>
                            <div class="profile-field">
                                <label for="correo" class="field-title">Correo electrónico</label>
                                <input type="email" id="correo" name="correo" class="field-input" value="dm2900396@gmail.com" readonly>
                            </div>
                        </div>

                        <!-- Columna derecha -->
                        <div class="profile-column">
                            <div class="profile-field">
                                <label for="direccion" class="field-title">Dirección Domiciliaria</label>
                                <input type="text" id="direccion" name="direccion" class="field-input" value="Cerro" readonly>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Modal para cambiar la contraseña -->
                <div id="modal" class="modal" style="display:none;">
                    <div class="modal-content">
                        <!-- Botón para cerrar el modal -->
                        <span class="close" onclick="cerrarModal()">&times;</span>
                        <h2>Cambiar contraseña</h2>
                        <!-- Campo para contraseña actual -->
                        <div class="modal-field">
                            <label for="ContrasenaAntigua">Contraseña actual:</label>
                            <input type="password" id="ContrasenaAntigua" required>
                        </div>
                        <!-- Campo para nueva contraseña -->
                        <div class="modal-field">
                            <label for="ContrasenaNueva">Nueva contraseña:</label>
                            <input type="password" id="ContrasenaNueva" required>
                        </div>
                        <!-- Campo para confirmar la nueva contraseña -->
                        <div class="modal-field">
                            <label for="ContrasenaNuevaConfir">Confirmar nueva contraseña:</label>
                            <input type="password" id="ContrasenaNuevaConfir" required>
                        </div>
                        <!-- Botón para confirmar el cambio -->
                        <div class="modal-actions">
                            <button onclick="confirmarCambio()">Confirmar Cambio</button>
                        </div>
                    </div>
                </div>
                <!-- Variable de sesión con el ID del usuario para JS -->
                <script>
                    const idUsuario = <?php echo $_SESSION['usuario']['id']; ?>;
                </script>
            </div>
        </main>
    </div>
    <script src="/SistemaBiblioteca/public/js/VerPerfilUsuario.js"></script>
</body>

</html>