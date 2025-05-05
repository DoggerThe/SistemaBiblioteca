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
        
        <header class="header">
            <h1 class="welcome"><a href="#">Bienvenido</a></h1>

            <div class="button-group">
            <button class="logout-btn" onclick="location.href='/logout'">CERRAR SESION</button>
            <button class="image-button" onclick="location.href='/logout'">
            <img src="/SistemaBiblioteca/public/img/user.png" alt="Login">
            </button>
        </div>
        </header>

        
        <div class="separator"></div>

        
        <aside class="sidebar">
            <div class="menu-list">
                <button class="menu-button" onclick="location.href='#'">Libros</button>
                <button class="menu-button" onclick="location.href='#'">Prestamos</button>
            </div>
        </aside>
        
        <div class="container-General"> 
            <div class="Container-Tabla">
                <h1>Lista de libros</h1>
                <table id="tablaLibros">
                    <thead>
                        <tr>
                            <th>Id Libro</th>
                            <th>Libro</th>
                            <th>Autor</th>
                            <th>Genero</th>
                            <th>Cantidad</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                     <tbody>
                        <!-- Aquí se llenarán los datos de los libros disponibles mediante AJAX del JS -->
                    </tbody>
                </table>
            </div>
    </div>
    <!--No Check-->
    <div id="modal" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close" onclick="cerrarModal()">&times;</span>
            <h2>Detalles del Préstamo</h2>
            <p><strong>ID:</strong> <span id="modalId"></span></p>
            <p><strong>Libro:</strong> <span id="modalLibro"></span></p>
            <p><strong>Autor:</strong> <span id="modalAutor"></span></p>
            <p><strong>Genero:</strong> <span id="modalGenero"></span></p>
            <p><label>Fecha de Inicio:
            <input type="date" id="fechaInicio">
            </label></p>
            
            <p><label>Fecha de Fin:
                <input type="date" id="fechaFin">
            </label></p>
            
            <button onclick="confirmarSolicitud()">Confirmar Solicitud</button>
        </div>
    </div>
    <script>
        const idUsuario = <?php echo $_SESSION['usuario']['id']; ?>;
        console.log(idUsuario); // Verifica que el ID del usuario se esté pasando correctamente
    </script>
    <script src="/SistemaBiblioteca/public/js/listarLibUsu.js"></script>
</body>
</html>