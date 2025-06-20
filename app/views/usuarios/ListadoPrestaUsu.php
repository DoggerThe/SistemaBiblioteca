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
    <link rel="stylesheet" href="/SistemaBiblioteca/public/css/SolicPrestBibli.css">
</head>

<body>
    <!-- Contenedor principal de la vista del usuario bibliotecario -->
    <div class="bibliotecario-container">
        <!-- Encabezado con bienvenida, botón de cerrar sesión y acceso al perfil -->
        <?php include __DIR__."/../layout/layoutUsuario.php";?>
        <!-- Contenedor principal de contenido -->
        <div class="container-General">
            <div class="Container-Tabla">
                <h1>Lista de libros</h1>
                <!-- Tabla donde se mostrará la información de los préstamos -->
                <table id="tablaLibros">
                    <thead>
                        <tr>
                            <th>Id Libro</th>
                            <th>Libro</th>
                            <th>Fecha de inicio</th>
                            <th>Fecha de fin</th>
                            <th>Acciones</th><!-- Botones creados en js -->
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Cuerpo de la tabla que será llenado dinámicamente mediante JavaScript (AJAX) -->
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal emergente para mostrar los detalles del préstamo seleccionado -->
        <div id="modal" class="modal" style="display:none;">
            <div class="modal-content">
                <!-- Botón (X) para cerrar el modal -->
                <span class="close" onclick="cerrarModal()">&times;</span>
                <!-- Detalles informativos del préstamo -->
                <h2>Detalles del Préstamo</h2>
                <p><strong>Libro:</strong> <span id="modalLibro"></span></p>
                <p><strong>Fecha de Inicio:</strong> <span id="modalFechaInicio"></span></p>
                <p><strong>Fecha de Fin:</strong> <span id="modalFechaFin"></span></p>
                <!-- Botón para cerrar o confirmar la vista del modal -->
                <button onclick="cerrarModal()">Confirmar</button>
            </div>
        </div>
        <!-- Se pasa el id del usuario desde PHP al script JS -->
        <script>
            const idUsuario = <?php echo $_SESSION['usuario']['id']; ?>;
        </script>
        <script src="/SistemaBiblioteca/public/js/ListadoPrestaUsu.js"></script>
    </div>
</body>

</html>