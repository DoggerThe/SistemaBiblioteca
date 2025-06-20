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
    <link rel="stylesheet" href="/SistemaBiblioteca/public/css/InicioGeneral.css">
    <link rel="stylesheet" href="/SistemaBiblioteca/public/css/ListadoPresBibli.css">

</head>

<body>
    <div class="bibliotecario-container">

        <?php include __DIR__.'/../layout/layoutBibliotecario.php';?>
        <!-- Contenedor general que agrupa ambas secciones de préstamos activos e inactivos -->
        <div class="container-General">
            <!-- Sección de préstamos activos -->
            <div class="Container-1">
                <!-- Barra de búsqueda para préstamos activos -->
                <div class="Container-barra">
                    <form class="barra-busqueda" id="BusquedaActivos">
                        <input type="text" id="busquedaAct" name="busquedaAct" placeholder="Buscar Id Préstamos Activos...">
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
                    <form class="barra-busqueda" id="BusquedaInactivos">
                        <input type="text" id="busquedaInac" name="busquedaInac" placeholder="Buscar Id Préstamos Inactivo...">
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
    </div>
    <script src="/SistemaBiblioteca/public/js/prestamoBusqueda.js"></script>
</body>

</html>