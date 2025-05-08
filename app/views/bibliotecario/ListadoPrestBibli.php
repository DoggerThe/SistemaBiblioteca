<?php
require_once __DIR__ . '/../../helpers/auth.php';
requireRole(2); // 2 es el rol de bibliotecario
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecua Librería - Bibliotecario</title>
    <link rel="stylesheet" href="/SistemaBiblioteca/public/css/ListadoPresBibli.css">

</head>

<body>
    <div class="bibliotecario-container">

        <header class="header">
            <h1 class="welcome"><a href="InicioBibliotec.php">Bienvenido Bibliotecario</a></h1> <!-- Link a la página de inicio -->

            <div class="button-group"> <!-- Grupo de botones de usuario -->
                <!-- Botón para cerrar sesión -->
                <button class="logout-btn" onclick="location.href='/SistemaBiblioteca/public/action.php?action=logout'">CERRAR SESIÓN</button>
                <!-- Botón con imagen del usuario (aquí no tiene funcionalidad concreta aún) -->
                <button class="image-button" onclick="location.href='#'">
                    <img src="/SistemaBiblioteca/public/img/user.png" alt="Login">
                </button>
            </div>
        </header>

        <div class="separator"></div>
        <!-- Menú lateral de navegación -->
        <aside class="sidebar">
            <div class="menu-list">
                <!-- Botones para acceder a distintas funcionalidades -->
                <button class="menu-button" onclick="location.href='ListadoLibrosBibli.php'">Libros</button>
                <button class="menu-button" onclick="location.href='SolicPrestBibli.php'">Solicitudes de Préstamos</button>
                <button class="menu-button" onclick="location.href='ListadoPrestBibli.php'">Listado de Préstamos</button>
            </div>
        </aside>
        <!-- Contenedor general que agrupa ambas secciones de préstamos activos e inactivos -->
        <div class="container-General">
            <!-- Sección de préstamos activos -->
            <div class="Container-1">
                <!-- Barra de búsqueda para préstamos activos -->
                <div class="Container-barra">
                    <form class="barra-busqueda" onsubmit="buscarActivos(event)">
                        <input type="text" id="busqueda" placeholder="Buscar Id Préstamos Activos...">
                        <button type="submit">🔍</button>
                    </form>
                </div>
                <!-- Tabla que se llenará dinámicamente con préstamos activos -->
                <div class="Container-Tabla">
                    <h1>Solicitudes de Préstamos Activos</h1>
                    <table id="tablaLibroPres">
                        <thead>
                            <tr>
                                <th>Id Préstamo</th>
                                <th>Usuario</th>
                                <th>Libros</th>
                                <th>Fecha de Solicitud</th>
                                <th>Fecha de Inicio</th>
                                <th>Fecha de Fin</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Aquí se insertan dinámicamente los registros con JS -->
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Sección de préstamos inactivos -->
            <div class="Container-2">
                <!-- Barra de búsqueda para préstamos inactivos -->
                <div class="Container-barra">
                    <form class="barra-busqueda" onsubmit="buscarInactivos(event)">
                        <input type="text" id="busqueda" placeholder="Buscar Id Préstamos Inactivo...">
                        <button type="submit">🔍</button>
                    </form>
                </div>
                <!-- Tabla que se llenará dinámicamente con préstamos inactivos -->
                <div class="Container-Tabla2">
                    <h1>Solicitudes de Préstamos Inactivo</h1>
                    <table id="tablaLibroPres2">
                        <thead>
                            <tr>
                                <th>Id Préstamo</th>
                                <th>Usuario</th>
                                <th>Libros</th>
                                <th>Fecha de Solicitud</th>
                                <th>Fecha de Inicio</th>
                                <th>Fecha de Fin</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Aquí se insertan dinámicamente los registros con JS -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script src="/SistemaBiblioteca/public/js/prestamoBusqueda.js"></script>
</body>

</html>