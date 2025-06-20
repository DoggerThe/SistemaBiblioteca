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
    <link rel="stylesheet" href="/SistemaBiblioteca/public/css/InicioGeneral.css">
    <link rel="stylesheet" href="/SistemaBiblioteca/public/css/ListadoLibrosUsu.css">
</head>

<body>
    <div class="bibliotecario-container">
        <?php include __DIR__."/../layout/layoutUsuario.php";?>
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