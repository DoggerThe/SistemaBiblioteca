<?php
require_once __DIR__ . '/../../helpers/auth.php';
requireRole(2); // 2 es el rol de bibliotecario
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Ecua Librería - Bibliotecario</title>
    <link rel="stylesheet" href="/SistemaBiblioteca/public/css/InicioBibliotec.css">
</head>

<body>

    <div class="bibliotecario-container">

        <header class="header">
            <h1 class="welcome">Bienvenido Bibliotecario</h1>

            <div class="button-group">
                <!-- Botón para cerrar sesión, redirige al script que maneja el logout -->
                <button class="logout-btn" onclick="location.href='/SistemaBiblioteca/index.php?action=logout'">CERRAR SESIÓN</button>//cambiado
                <!-- Botón con ícono de usuario (actualmente sin funcionalidad) -->
                <button class="image-button" onclick="location.href='#'">
                    <img src="/SistemaBiblioteca/public/img/user.png" alt="Login">
                </button>
            </div>
        </header>

        <div class="separator"></div>

        <aside class="sidebar">
            <div class="menu-list">
                <!-- Acceso al listado de libros -->
                <button class="menu-button" onclick="location.href='ListadoLibrosBibli.php'">Libros</button>
                <!-- Acceso a solicitudes de préstamos realizados por los usuarios -->
                <button class="menu-button" onclick="location.href='SolicPrestBibli.php'">Solicitudes de Préstamos</button>
                <!-- Acceso al historial de préstamos registrados en el sistema -->
                <button class="menu-button" onclick="location.href='ListadoPrestBibli.php'">Listado de Préstamos</button>
            </div>
        </aside>

        <main class="main-content">
            <h1 class="main-title">Bienvenido a EcuaLibrería</h1>

            <img src="/SistemaBiblioteca/public/img/bibliotecaPerfil.jpg" alt="Presentacion Biblioteca" class="welcome-library">
        </main>
    </div>
</body>

</html>