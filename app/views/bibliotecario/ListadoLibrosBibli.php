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
    <link rel="stylesheet" href="/SistemaBiblioteca/public/css/ListadoLibroBiblio.css">
</head>
<body>
    <div class="bibliotecario-container">
        
        <header class="header">
          <h1 class="welcome"><a href="InicioBibliotec.php">Bienvenido Bibliotecario</a></h1>
            <div class="button-group">
            <button class="logout-btn" onclick="location.href='/SistemaBiblioteca/public/action.php?action=logout'">CERRAR SESIÓN</button>
            <button class="image-button" onclick="location.href='/logout'">
            <img src="/SistemaBiblioteca/public/img/user.png" alt="Login">
            </button>
        </div>
        </header>
        
        <div class="separator"></div>
        
        <aside class="sidebar">
            <div class="menu-list">
              <button class="menu-button" onclick="location.href='ListadoLibrosBibli.php'">Libros</button>
              <button class="menu-button" onclick="location.href='SolicPrestBibli.php'">Solicitudes de Préstamos</button>
              <button class="menu-button" onclick="location.href='ListadoPrestBibli.php'">Listado de Préstamos</button>
            </div>
        </aside>
        
        <div class="container-General"> 
            <div class="Container-barra">
              <form class="barra-busqueda" onsubmit="buscar(event)">
                <input type="text" id="busqueda" placeholder="Buscar...">
                <button type="submit">🔍</button>
              </form>
            </div>
                <div class="Container-Tabla">
                    <h1>Lista de Libros</h1>
                    <table id="tablaLibros">
                      <thead>
                        <tr>
                            <th>Titulo</th>
                            <th>Autor</th>
                            <th>Cantidad Disponible</th>
                        </tr>
                      </thead>
                      <tbody>
<!--Aqui se llena de datos de la BD-->
                      </tbody>
                    </table>
                </div>
        </div>
    </div>
    <script src="/SistemaBiblioteca/public/js/busquedaLibros.js"></script>
</body>
</html>