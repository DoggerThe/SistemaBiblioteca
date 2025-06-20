<header class="header">
    <h1 class="welcome"><a href="InicioBibliotec.php">Bienvenido Bibliotecario</a></h1> <!-- Link a la página de inicio -->

    <div class="button-group"> <!-- Grupo de botones de usuario -->
        <!-- Botón para cerrar sesión -->
        <button class="logout-btn" onclick="location.href='/SistemaBiblioteca/index.php?action=logout'">CERRAR SESIÓN</button>
        <!-- Botón con imagen del usuario (aquí no tiene funcionalidad concreta aún) -->
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