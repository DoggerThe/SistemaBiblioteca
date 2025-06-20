<header class="header">
    <h1 class="welcome"><a href="InicioAdministrador.php">Bienvenido Administrador</a></h1>
    <div class="button-group">
        <button class="logout-btn" onclick="location.href='/SistemaBiblioteca/index.php?action=logout'">CERRAR SESIÓN</button>
        <button class="image-button" onclick="location.href='/SistemaBiblioteca/app/views/administrador/VerPerfilAdmin.php'">
            <img src="/SistemaBiblioteca/public/img/user.png" alt="Login">
        </button>
    </div>
</header>

<div class="separator"></div>

<aside class="sidebar">
    <div class="menu-list">
        <!-- Acceso al listado de libros -->
        <button class="menu-button" onclick="location.href='RegistroListadoLibros.php'">Ingreso y Listado de Libros</button>
        <!-- Acceso a solicitudes de préstamos realizados por los usuarios -->
        <button class="menu-button" onclick="location.href='AdministracionBibliotecarios.php'">Creacion y Listado de Bibliotecario</button>

    </div>
</aside>