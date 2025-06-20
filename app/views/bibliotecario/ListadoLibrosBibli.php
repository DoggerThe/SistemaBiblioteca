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
  <link rel="stylesheet" href="/SistemaBiblioteca/public/css/ListadoLibroBiblio.css">
</head>

<body>
  <div class="bibliotecario-container">

    <?php include __DIR__.'/../layout/layoutBibliotecario.php';?>
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