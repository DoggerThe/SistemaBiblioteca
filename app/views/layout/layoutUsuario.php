<header class="header">
    <h1 class="welcome"><a href="InicioUser.php">Bienvenido</a></h1>
    <div class="button-group">
        <button class="logout-btn" onclick="location.href='/SistemaBiblioteca/index.php?action=logout'">CERRAR SESIÓN</button>
        <button class="image-button" onclick="location.href='/SistemaBiblioteca/app/views/usuarios/VerPerfilUsuario.php'">
            <img src="/SistemaBiblioteca/public/img/user.png" alt="Login">
        </button>
    </div>
</header>

<div class="separator"></div>
<aside class="sidebar">
    <div class="menu-list">
        <button class="menu-button" onclick="location.href='ListadoLibrosUsu.php'">Libros</button>
        <button class="menu-button" onclick="location.href='ListadoPrestaUsu.php'">Préstamos</button>
    </div>
</aside>