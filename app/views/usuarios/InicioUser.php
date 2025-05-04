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
            <button class="logout-btn" onclick="location.href='/logout'">CERRAR SESION</button>
            <button class="image-button" onclick="location.href='/logout'">
            <img src="/SistemaBiblioteca/public/img/user.png" alt="Login">
            </button>
        </div>
        </header>

        
        <div class="separator"></div>

        
        <aside class="sidebar">
            <div class="menu-list">
                <button class="menu-button" onclick="location.href='ListadoLibrosUsu.php'">Libros</button>
                <button class="menu-button" onclick="location.href='ListadoPrestUsu.php'">Listado de Préstamos</button>
            </div>
        </aside>
        

        <main class="main-content">
            <h1 class="main-title">Bienvenido a EcuaLibrería</h1>
            
            <img src="/SistemaBiblioteca/public/img/bibliotecaPerfil.jpg" alt="Presentacion Biblioteca" class="welcome-library">
        </main>
    </div>
</body>
</html>
