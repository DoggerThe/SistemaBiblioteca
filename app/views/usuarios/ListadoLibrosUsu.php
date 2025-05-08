<?php
require_once __DIR__ . '/../../helpers/auth.php';
requireRole(1); // 1 es el rol de usuario normal
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecua Librería</title>
    <link rel="stylesheet" href="/SistemaBiblioteca/public/css/SolicPrestBibli.css">
</head>

<body>
    <div class="bibliotecario-container">
        <!-- Encabezado principal del sistema con botones de navegación -->
        <header class="header">
            <!-- Enlace de bienvenida que redirige a la página de inicio del usuario -->
            <h1 class="welcome"><a href="InicioUser.php">Bienvenido</a></h1>
            <!-- Grupo de botones de acción del usuario: cerrar sesión y ver perfil -->
            <div class="button-group">
                <!-- Botón para cerrar sesión, redirige con un parámetro GET -->
                <button class="logout-btn" onclick="location.href='/SistemaBiblioteca/public/action.php?action=logout'">CERRAR SESIÓN</button>
                <!-- Botón con imagen de usuario, redirige a la vista del perfil -->
                <button class="image-button" onclick="location.href='/SistemaBiblioteca/app/views/usuarios/VerPerfilUsuario.php'">
                    <img src="/SistemaBiblioteca/public/img/user.png" alt="Login">
                </button>
            </div>
        </header>
        <!-- Línea divisoria visual entre el encabezado y el resto del contenido -->
        <div class="separator"></div>

        <!-- Barra lateral de navegación con enlaces a secciones principales del usuario -->
        <aside class="sidebar">
            <div class="menu-list">
                <button class="menu-button" onclick="location.href='ListadoLibrosUsu.php'">Libros</button>
                <button class="menu-button" onclick="location.href='ListadoPrestaUsu.php'">Prestamos</button>
            </div>
        </aside>
        <!-- Contenedor principal para la tabla de libros -->
        <div class="container-General">
            <div class="Container-Tabla">
                <h1>Lista de libros</h1>
                <!-- Tabla para mostrar los libros disponibles -->
                <table id="tablaLibros">
                    <thead>
                        <tr>
                            <th>Id Libro</th>
                            <th>Libro</th>
                            <th>Autor</th>
                            <th>Genero</th>
                            <th>Cantidad</th>
                            <th>Acciones</th> <!-- Columna para botones de acción-->
                        </tr>
                    </thead>
                    <tbody>
                        <!-- El contenido se insertará dinámicamente mediante JavaScript (AJAX) -->
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal oculto por defecto que se muestra al solicitar préstamo de un libro -->
        <div id="modal" class="modal" style="display:none;">
            <div class="modal-content">
                <!-- Botón para cerrar el modal -->
                <span class="close" onclick="cerrarModal()">&times;</span>
                <!-- Información detallada del libro seleccionado -->
                <h2>Detalles del Préstamo</h2>
                <p><strong>ID:</strong> <span id="modalId"></span></p>
                <p><strong>Libro:</strong> <span id="modalLibro"></span></p>
                <p><strong>Autor:</strong> <span id="modalAutor"></span></p>
                <p><strong>Genero:</strong> <span id="modalGenero"></span></p>
                <!-- Campos para que el usuario seleccione las fechas del préstamo -->
                <p><label>Fecha de Inicio:
                        <input type="date" id="fechaInicio">
                    </label></p>

                <p><label>Fecha de Fin:
                        <input type="date" id="fechaFin">
                    </label></p>
                <!-- Botón para confirmar la solicitud de préstamo -->
                <button onclick="confirmarSolicitud()">Confirmar Solicitud</button>
            </div>
        </div>
        <!-- Se inserta el ID del usuario desde la sesión PHP para usarlo en el script JS -->
        <script>
            const idUsuario = <?php echo $_SESSION['usuario']['id']; ?>;
        </script>
        <script src="/SistemaBiblioteca/public/js/listarLibUsu.js"></script>
</body>

</html>