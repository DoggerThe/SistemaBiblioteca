<?php
require_once __DIR__.'/../../helpers/auth.php';
requireRole(3);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/SistemaBiblioteca/public/css/InicioGeneral.css">
    <link rel="stylesheet" href="/SistemaBiblioteca/public/css/InicioBibliotec.css">
    <title>Ecua Librería - Administrador</title>


</head>

<body>
    <div class="bibliotecario-container">
    <?php include __DIR__ . '/../layout/layoutAdministrador.php'; ?>

        <main class="main-content">
            <h1 class="main-title">Bienvenido a EcuaLibrería</h1>
            <img src="/SistemaBiblioteca/public/img/bibliotecaPerfil.jpg" alt="Presentacion Biblioteca" class="welcome-library">
        </main>
    </div>
</body>
</html>