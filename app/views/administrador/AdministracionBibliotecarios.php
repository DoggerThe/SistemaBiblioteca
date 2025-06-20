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
                    <form action="/php/ProcesarIngresoLibro.php" method="POST" onsubmit="return validarContrasenas()">
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
                <form class="barra-busqueda" onsubmit="buscar(event)">
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
                            <tr>
                                <td>María</td>
                                <td>González</td>
                                <td>0912345678</td>
                                <td>maria.gonzalez@biblioteca.edu</td>
                                <td>Av. 9 de Octubre y Boyacá</td>
                            </tr>
                            <tr>
                                <td>Carlos</td>
                                <td>Pérez</td>
                                <td>0923456789</td>
                                <td>carlos.perez@biblioteca.edu</td>
                                <td>Cdla. Kennedy Norte</td>
                            </tr>
                            <tr>
                                <td>Lucía</td>
                                <td>Ramírez</td>
                                <td>0934567890</td>
                                <td>lucia.ramirez@biblioteca.edu</td>
                                <td>Av. del Bombero y Vía a la Costa</td>
                            </tr>
                            <tr>
                                <td>Jorge</td>
                                <td>Lozano</td>
                                <td>0945678901</td>
                                <td>jorge.lozano@biblioteca.edu</td>
                                <td>Las Acacias, Mz 12</td>
                            </tr>
                            <tr>
                                <td>Ana</td>
                                <td>Martínez</td>
                                <td>0956789012</td>
                                <td>ana.martinez@biblioteca.edu</td>
                                <td>Av. Quito y Machala</td>
                            </tr>
                            <tr>
                                <td>Fernando</td>
                                <td>Castro</td>
                                <td>0967890123</td>
                                <td>fernando.castro@biblioteca.edu</td>
                                <td>Urb. Los Ceibos</td>
                            </tr>
                            <tr>
                                <td>Sofía</td>
                                <td>Valencia</td>
                                <td>0978901234</td>
                                <td>sofia.valencia@biblioteca.edu</td>
                                <td>Puerto Azul, Vía a la Costa</td>
                            </tr>
                            <tr>
                                <td>Daniel</td>
                                <td>Morales</td>
                                <td>0989012345</td>
                                <td>daniel.morales@biblioteca.edu</td>
                                <td>Cdla. Los Esteros</td>
                            </tr>
                            <tr>
                                <td>Gabriela</td>
                                <td>Ruiz</td>
                                <td>0990123456</td>
                                <td>gabriela.ruiz@biblioteca.edu</td>
                                <td>Av. Francisco de Orellana</td>
                            </tr>
                            <tr>
                                <td>Ricardo</td>
                                <td>Navarrete</td>
                                <td>0911234567</td>
                                <td>ricardo.navarrete@biblioteca.edu</td>
                                <td>Urb. La Puntilla, Samborondón</td>
                            </tr>
                            <tr>
                                <td>Sofía</td>
                                <td>Valencia</td>
                                <td>0978901234</td>
                                <td>sofia.valencia@biblioteca.edu</td>
                                <td>Puerto Azul, Vía a la Costa</td>
                            </tr>
                            <tr>
                                <td>Daniel</td>
                                <td>Morales</td>
                                <td>0989012345</td>
                                <td>daniel.morales@biblioteca.edu</td>
                                <td>Cdla. Los Esteros</td>
                            </tr>
                            <tr>
                                <td>Gabriela</td>
                                <td>Ruiz</td>
                                <td>0990123456</td>
                                <td>gabriela.ruiz@biblioteca.edu</td>
                                <td>Av. Francisco de Orellana</td>
                            </tr>
                            <tr>
                                <td>Ricardo</td>
                                <td>Navarrete</td>
                                <td>0911234567</td>
                                <td>ricardo.navarrete@biblioteca.edu</td>
                                <td>Urb. La Puntilla, Samborondón</td>
                            </tr>
                            <tr>
                                <td>Sofía</td>
                                <td>Valencia</td>
                                <td>0978901234</td>
                                <td>sofia.valencia@biblioteca.edu</td>
                                <td>Puerto Azul, Vía a la Costa</td>
                            </tr>
                            <tr>
                                <td>Daniel</td>
                                <td>Morales</td>
                                <td>0989012345</td>
                                <td>daniel.morales@biblioteca.edu</td>
                                <td>Cdla. Los Esteros</td>
                            </tr>
                            <tr>
                                <td>Gabriela</td>
                                <td>Ruiz</td>
                                <td>0990123456</td>
                                <td>gabriela.ruiz@biblioteca.edu</td>
                                <td>Av. Francisco de Orellana</td>
                            </tr>
                            <tr>
                                <td>Ricardo</td>
                                <td>Navarrete</td>
                                <td>0911234567</td>
                                <td>ricardo.navarrete@biblioteca.edu</td>
                                <td>Urb. La Puntilla, Samborondón</td>
                            </tr>
                            <tr>
                                <td>Sofía</td>
                                <td>Valencia</td>
                                <td>0978901234</td>
                                <td>sofia.valencia@biblioteca.edu</td>
                                <td>Puerto Azul, Vía a la Costa</td>
                            </tr>
                            <tr>
                                <td>Daniel</td>
                                <td>Morales</td>
                                <td>0989012345</td>
                                <td>daniel.morales@biblioteca.edu</td>
                                <td>Cdla. Los Esteros</td>
                            </tr>
                            <tr>
                                <td>Gabriela</td>
                                <td>Ruiz</td>
                                <td>0990123456</td>
                                <td>gabriela.ruiz@biblioteca.edu</td>
                                <td>Av. Francisco de Orellana</td>
                            </tr>
                            <tr>
                                <td>Ricardo</td>
                                <td>Navarrete</td>
                                <td>0911234567</td>
                                <td>ricardo.navarrete@biblioteca.edu</td>
                                <td>Urb. La Puntilla, Samborondón</td>
                            </tr>
                            <tr>
                                <td>Sofía</td>
                                <td>Valencia</td>
                                <td>0978901234</td>
                                <td>sofia.valencia@biblioteca.edu</td>
                                <td>Puerto Azul, Vía a la Costa</td>
                            </tr>
                            <tr>
                                <td>Daniel</td>
                                <td>Morales</td>
                                <td>0989012345</td>
                                <td>daniel.morales@biblioteca.edu</td>
                                <td>Cdla. Los Esteros</td>
                            </tr>
                            <tr>
                                <td>Gabriela</td>
                                <td>Ruiz</td>
                                <td>0990123456</td>
                                <td>gabriela.ruiz@biblioteca.edu</td>
                                <td>Av. Francisco de Orellana</td>
                            </tr>
                            <tr>
                                <td>Ricardo</td>
                                <td>Navarrete</td>
                                <td>0911234567</td>
                                <td>ricardo.navarrete@biblioteca.edu</td>
                                <td>Urb. La Puntilla, Samborondón</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
    <script src="/SistemaBiblioteca/public/js/AdministracionBibliotecarios.js"></script>
</body>

</html>