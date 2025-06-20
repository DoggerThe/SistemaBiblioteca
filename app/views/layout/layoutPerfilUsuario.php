<!-- Encabezado con eslogan y botón de cerrar sesión -->
<header class="header">
    <h1 class="welcome">"Leer, aprender, crecer - Todo en un solo lugar"</h1>
    <div class="button-group">
        <!-- Botón para cerrar sesión -->
        <button class="logout-btn" onclick="location.href='/SistemaBiblioteca/index.php?action=logout'">CERRAR SESIÓN</button>
    </div>
</header>
<!-- Línea separadora -->
<div class="separator"></div>
<!-- Menú lateral con opciones de navegación -->
<aside class="sidebar">
    <div class="menu-list">
        <!-- Botón para ver los libros disponibles -->
        <button class="menu-button " onclick="location.href='ListadoLibrosUsu.php'">Libros</button>
        <!-- Botón para ver los préstamos del usuario -->
        <button class="menu-button " onclick="location.href='ListadoPrestaUsu.php'">Préstamos</button>
    </div>
</aside>