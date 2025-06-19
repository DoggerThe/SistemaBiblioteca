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
      <h1 class="welcome">
      <!-- Enlace de regreso al panel principal del bibliotecario -->
      <a href="InicioBibliotec.php">Bienvenido Bibliotecario</a></h1>
      <div class="button-group">
        <!-- Botón para cerrar sesión -->
        <button class="logout-btn" onclick="location.href='/SistemaBiblioteca/index.php?action=logout'">CERRAR SESIÓN</button><!-- Cambiado -->
        <!-- Botón con ícono de usuario (sin funcionalidad asignada aún) -->
        <button class="image-button" onclick="location.href='#'">
          <img src="/SistemaBiblioteca/public/img/user.png" alt="Login">
        </button>
      </div>
    </header>

    <div class="separator"></div>
    <!-- Barra lateral de navegación con accesos a funcionalidades del sistema -->
    <aside class="sidebar">
      <div class="menu-list">
        <!-- Botón para ver el listado de libros disponibles -->
        <button class="menu-button" onclick="location.href='ListadoLibrosBibli.php'">Libros</button>
        <!-- Botón para gestionar solicitudes de préstamos -->
        <button class="menu-button" onclick="location.href='SolicPrestBibli.php'">Solicitudes de Préstamos</button>
        <!-- Botón para revisar los préstamos ya realizados -->
        <button class="menu-button" onclick="location.href='ListadoPrestBibli.php'">Listado de Préstamos</button>
      </div>
    </aside>
    <!-- Tabla que mostrará la lista de libros recuperados desde la base de datos -->
    <div class="container-General">
      <div class="Container-barra">
        <form class="barra-busqueda" id="form-busqueda">
          <input type="text" id="busqueda" name="busqueda" placeholder="Buscar...">
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
            <!-- Aquí se insertarán dinámicamente los registros de libros con JS -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script src="/SistemaBiblioteca/public/js/busquedaLibros.js"></script>
</body>

</html>