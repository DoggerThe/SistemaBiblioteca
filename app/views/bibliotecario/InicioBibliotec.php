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
</head>
<body>
    <a href="/SistemaBiblioteca/app/views/bibliotecario/ListadoPrestBibli.php">Listado Prestmos</a>
    <a href="/SistemaBiblioteca/app/views/bibliotecario/ListadoLibrosBibli.php">Listado Libros</a>
    <a href="/SistemaBiblioteca/app/views/bibliotecario/SolicPrestBibli.php">SoliPresta</a>
</body>
</html>