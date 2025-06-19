<?php
require_once __DIR__ . '/../../helpers/auth.php';
requireRole(1); // 1 es el rol de usuario normal
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Ecua Librería - Usuario</title>
    <link rel="stylesheet" href="/SistemaBiblioteca/public/css/InicioBibliotec.css">
</head>

<body>

    <div class="bibliotecario-container">

        <header class="header">
            <h1 class="welcome">Bienvenido</h1>

            <div class="button-group">
                <!-- Botón para cerrar sesión; redirige al script que gestiona el logout -->
                <button class="logout-btn" onclick="location.href='/SistemaBiblioteca/index.php?action=logout'">CERRAR SESIÓN</button>
                <!-- Botón para acceder al perfil del usuario con un ícono de imagen -->
                <button class="image-button" onclick="location.href='/SistemaBiblioteca/app/views/usuarios/VerPerfilUsuario.php'">
                    <img src="/SistemaBiblioteca/public/img/user.png" alt="Login">
                </button>
            </div>
        </header>

        <!-- Separador visual entre el encabezado y el resto del contenido -->
        <div class="separator"></div>

        <!-- Barra lateral de navegación con enlaces a secciones disponibles -->
        <aside class="sidebar">
            <div class="menu-list">
                <!-- Redirige a la lista de libros disponibles para el usuario -->
                <button class="menu-button" onclick="location.href='ListadoLibrosUsu.php'">Libros</button>
                <!-- Redirige al listado de préstamos realizados por el usuario -->
                <button class="menu-button" onclick="location.href='ListadoPrestaUsu.php'">Listado de Préstamos</button>
            </div>
        </aside>

        <!-- Contenido principal del inicio para el usuario -->
        <main class="main-content">
            <h1 class="main-title">Bienvenido a EcuaLibrería</h1>

            <img src="/SistemaBiblioteca/public/img/bibliotecaPerfil.jpg" alt="Presentacion Biblioteca" class="welcome-library">
        </main>
    </div>
</body>

</html>