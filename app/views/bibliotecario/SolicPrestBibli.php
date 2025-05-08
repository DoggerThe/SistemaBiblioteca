<?php
require_once __DIR__ . '/../../helpers/auth.php';
requireRole(2); // 2 es el rol de bibliotecario
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecua Librería - Bibliotecario</title>
    <link rel="stylesheet" href="/SistemaBiblioteca/public/css/SolicPrestBibli.css">
</head>

<body>
    <div class="bibliotecario-container">

        <header class="header">
            <!-- Mensaje de bienvenida con enlace a la página de inicio del bibliotecario -->
            <h1 class="welcome"><a href="InicioBibliotec.php">Bienvenido Bibliotecario</a></h1>
            <!-- Grupo de botones del lado derecho del encabezado -->
            <div class="button-group">
                <!-- Botón para cerrar sesión -->
                <button class="logout-btn" onclick="location.href='/SistemaBiblioteca/public/action.php?action=logout'">CERRAR SESIÓN</button>
                <!-- Botón con ícono de usuario (actualmente sin funcionalidad asignada) -->
                <button class="image-button" onclick="location.href='#'">
                    <img src="/SistemaBiblioteca/public/img/user.png" alt="Login">
                </button>
            </div>
        </header>


        <div class="separator"></div>

        <!-- Barra lateral con navegación a distintas secciones para el bibliotecario -->
        <aside class="sidebar">
            <div class="menu-list">
                <!-- Enlace a la vista de listado de libros -->
                <button class="menu-button" onclick="location.href='ListadoLibrosBibli.php'">Libros</button>
                <!-- Enlace a la vista actual: solicitudes de préstamo -->
                <button class="menu-button" onclick="location.href='SolicPrestBibli.php'">Solicitudes de Préstamos</button>
                <!-- Enlace al listado de todos los préstamos existentes -->
                <button class="menu-button" onclick="location.href='ListadoPrestBibli.php'">Listado de Préstamos</button>
            </div>
        </aside>
        <!-- Contenedor general para la tabla de solicitudes -->
        <div class="container-General">
            <div class="Container-Tabla">
                <h1>Solicitudes de Préstamos</h1>
                <!-- Tabla con encabezado y una fila de ejemplo -->
                <table id="tablaLibros">
                    <thead>
                        <tr>
                            <th>Id Prestamo</th>
                            <th>Usuario</th>
                            <th>Libro</th>
                            <th>Fecha de Solicitud</th>
                            <th>Fecha de Inicio</th>
                            <th>Fecha de Fin</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Aquí se generarán dinámicamente las filas de la tabla con JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal emergente para mostrar detalles de una solicitud -->
        <div id="modal" class="modal" style="display:none;">
            <div class="modal-content">
                <!-- Botón para cerrar el modal -->
                <span class="close" onclick="cerrarModal()">&times;</span>
                <h2>Detalles del Préstamo</h2>
                <!-- Información detallada que se llenará dinámicamente con JavaScript -->
                <p><strong>Libro:</strong> <span id="modalLibro"></span></p>
                <p><strong>Fecha de Solicitud:</strong> <span id="modalFechaSolicitud"></span></p>
                <p><strong>Fecha de Inicio:</strong> <span id="modalFechaInicio"></span></p>
                <p><strong>Fecha de Fin:</strong> <span id="modalFechaFin"></span></p>
                <!-- Botón para confirmar la solicitud desde el modal -->
                <button onclick="cambiarEstado()">Confirmar Solicitud</button>
            </div>
        </div>
        <script src="/SistemaBiblioteca/public/js/listarSolicitudes.js"></script>
</body>

</html>