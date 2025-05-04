<?php
require_once __DIR__ . '/../../helpers/auth.php';
requireRole(2); // 2 es el rol de bibliotecario
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/SistemaBiblioteca/public/css/SolicPrestBibli.css">
</head>
<body>
    <div class="bibliotecario-container">
        
        <header class="header">
            <h1 class="welcome">Bienvenido Bibliotecario</h1>

            <div class="button-group">
            <button class="logout-btn" onclick="location.href='/logout'">CERRAR SESION</button>
            <button class="image-button" onclick="location.href='/logout'">
            <img src="/public/img/user.png" alt="Login">
            </button>
        </div>
        </header>

        
        <div class="separator"></div>

        
        <aside class="sidebar">
            <div class="menu-list">
                <button class="menu-button" onclick="location.href='ListadoLibrosBibli.php'">Libros</button>
                <button class="menu-button" onclick="location.href='ListadoPrestBibli.php'">Solicitudes de Préstamos</button>
                <button class="menu-button" onclick="location.href='SolicPrestBibli.php'">Listado de Préstamos</button>
            </div>
        </aside>
        
        <div class="container-General"> 
            <div class="Container-Tabla">
                <h1>Solicitudes de Préstamos</h1>
                <table id="tablaLibros">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Libro</th>
                            <th>Fecha de Solicitud</th>
                            <th>Fecha de Inicio</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                     <tbody>
                        <tr>
                            <td>0645821369</td>
                            <td>Introducción a la Programación</td>
                            <td>2024-04-17</td>
                            <td>---------</td>
                            <td>Pendiente</td>
                            <td class="acciones">
                                <button onclick="Confirmar(this)" title="Confirmar" class="btn-confirmar">
                                    <i class="fas fa-check"></i> Confirmar
                                </button>
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
    </div>
    <script src="../js/Registro.js"></script>
</body>
</html>