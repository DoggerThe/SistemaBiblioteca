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
    <link rel="stylesheet" href="/SistemaBiblioteca/public/css/AdministracionBibliotecarios.css">
    <title>Ecua Librería - Administrador</title>
</head>

<body>

    <div class="bibliotecario-container">
        <?php include __DIR__ . '/../layout/layoutAdministrador.php'; ?>

        <main class="main-content">
            <div class="columna-izquierda">
                <h2 class="title-Ingreso">Registar un Bibliotecario</h2>
                <div class="contenedor-formulario">
                    <form id="FormularioNuevoBiblio">
                        <div class="grupo-formulario">
                            <label for="nombre">NOMBRE</label>
                            <input type="text" id="nombre" name="nombre" placeholder="Nombre" required>
                        </div>
                        <!-- Campo: Apellido -->
                        <div class="grupo-formulario">
                            <label for="apellido">APELLIDO</label>
                            <input type="text" id="apellido" name="apellido" placeholder="Apellido" required>
                        </div>
                        <!-- Campo: Cédula -->
                        <div class="grupo-formulario">
                            <label for="cedula">CÉDULA</label>
                            <input type="text" id="cedula" name="cedula" maxlength="10" minlength="10" placeholder="0999999999" required>
                        </div>
                        <!-- Campo: Correo electrónico -->
                        <div class="grupo-formulario">
                            <label for="email">CORREO ELECTRÓNICO</label>
                            <input type="email" id="email" name="email" placeholder="correo@example.com" required>
                        </div>
                        <!-- Campo: Dirección -->
                        <div class="grupo-formulario">
                            <label for="direccion">DIRECCIÓN</label>
                            <input type="text" id="direccion" name="direccion" placeholder="Direccion" required>
                        </div>
                        <!-- Campo: Contraseña -->
                        <div class="grupo-formulario">
                            <label for="contrasena">CONTRASEÑA</label>
                            <div class="contrasena-container">
                                <input type="password" id="contrasena" name="password" placeholder="***********" required>
                                <input type="checkbox" onclick="mostrarContrasena('contrasena')">
                            </div>
                        </div>
                        <!-- Campo: Confirmar contraseña -->
                        <div class="grupo-formulario">
                            <label for="confirmar">CONFIRMAR CONTRASEÑA</label>
                            <div class="contrasena-container">
                                <input type="password" id="confirmar" name="confirmar" placeholder="***********" required>
                                <input type="checkbox" onclick="mostrarContrasena('confirmar')">
                            </div>
                        </div>
                        <button type="submit" class="boton-registro">REGISTRARME</button>
                    </form>
                </div>
            </div>

            <div class="columna-derecha">
                <h2 class="title-Ingreso">Lista de Bibliotecario</h2>
                <form class="barra-busqueda" id="formBusquedaBiblio">
                    <input type="text" id="busqueda" placeholder="Buscar...">
                    <button type="submit" class="buton-busqueda">🔍</button>
                </form>
                <div class="Container-Tabla">
                    <table id="tablaBibliotecarios">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Cédula</th>
                                <th>Correo Electrónico</th>
                                <th>Dirección</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
    <script>const RolID = "3" </script>
    <script src="/SistemaBiblioteca/public/js/AdministracionBibliotecarios.js"></script>
</body>
</html>