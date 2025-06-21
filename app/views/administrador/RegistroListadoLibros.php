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
    <link rel="stylesheet" href="/SistemaBiblioteca/public/css/IngresoListadoAdmin.css">
    <title>Ecua Librería - Administrador</title>


</head>

<body>

    <div class="bibliotecario-container">
        <?php include __DIR__ . '/../layout/layoutAdministrador.php'; ?>

        <main class="main-content">
            <div class="columna-izquierda">
                <h2 class="title-Ingreso">Ingresar Nuevo Libro</h2>
                <div class="contenedor-formulario">
                    <form id="FormularioInscripcion">
                        <div class="grupo-Libro">
                            <label for="isbn">ISBN:</label>
                            <input type="text" id="isbn" name="isbn" placeholder="978-0140442892" required>
                        </div>

                        <div class="grupo-Libro">
                            <label for="titulo">Título:</label>
                            <input type="text" id="titulo" name="titulo" placeholder="Cien años de soledad" required>
                        </div>

                        <div class="form-group">
                            <label for="genero">Género:</label>
                            <input type="text" id="genero" name="genero" placeholder="Historia" required>
                        </div>
                        <div class="form-group">
                            <label for="cantidad">Cantidad:</label>
                            <input type="number" id="cantidad" name="cantidad" min="1" placeholder="1" required>
                        </div>

                        <div class="form-group">
                            <label for="autor">Autor:</label>
                            <input type="text" id="autor" name="autor" placeholder="Daniel Martinez" required>
                        </div>

                        <div class="form-group">
                            <label for="editorial">Editorial:</label>
                            <input type="text" id="editorial" name="editorial" placeholder="Historia" required>
                        </div>

                        <button type="submit" class="btn_guardar">Guardar Libro</button>
                    </form>
                </div>
            </div>

            <div class="columna-derecha">
                <h2 class="title-Ingreso">Lista de libros</h2>
                <form class="barra-busqueda" id="form-busqueda">
                    <input type="text" id="busqueda" placeholder="Buscar...">
                    <button type="submit" class="buton-busqueda">🔍</button>
                </form>
                <div class="Container-Tabla">
                    <table id="tablaLibros">
                        <thead>
                            <tr>
                                <th>Titulo</th>
                                <th>Autor</th>
                                <th>Genero</th>
                                <th>Editorial</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--Llenado de JS-->
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
    <script>const Rol = 3</script>
    <script src="/SistemaBiblioteca/public/js/RegistroListadoLibros.js"></script>
</body>

</html>