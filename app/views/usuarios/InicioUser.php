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
    <link rel="stylesheet" href="/SistemaBiblioteca/public/css/InicioGeneral.css">
    <link rel="stylesheet" href="/SistemaBiblioteca/public/css/InicioBibliotec.css">
</head>

<body>

    <div class="bibliotecario-container">
        <?php include __DIR__."/../layout/layoutUsuario.php";?>
        <!-- Contenido principal del inicio para el usuario -->
        <main class="main-content">
            <h1 class="main-title">Bienvenido a EcuaLibrería</h1>
            <img src="/SistemaBiblioteca/public/img/bibliotecaPerfil.jpg" alt="Presentacion Biblioteca" class="welcome-library">
        </main>
    </div>
</body>

</html>