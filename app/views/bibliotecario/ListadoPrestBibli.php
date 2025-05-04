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
    <link rel="stylesheet" href="/SistemaBiblioteca/public/css/ListadoPresBibli.css">
 
</head>
<body>
    <div class="bibliotecario-container">
        
        <header class="header">
            <h1 class="welcome">Bienvenido Bibliotecario</h1>

            <div class="button-group">
            <button class="logout-btn" onclick="location.href='/logout'">CERRAR SESION</button>
            <button class="image-button" onclick="location.href='/logout'">
            <img src="/public/img/user.png" alt="Login">
            </button>
        </div>
        </header>

        
        <div class="separator"></div>
        
        <aside class="sidebar">
            <div class="menu-list">
                <button class="menu-button" onclick="location.href='ListadoLibrosBibli.php'">Libros</button>
                <button class="menu-button" onclick="location.href='ListadoPrestBibli.php'">Solicitudes de Préstamos</button>
                <button class="menu-button" onclick="location.href='SolicPrestBibli.php'">Listado de Préstamos</button>
            </div>
        </aside>
        
        <div class="container-General"> 

            <div class="Container-1">
            <div class="Container-barra">
                <form class="barra-busqueda" onsubmit="buscarActivos(event)">
                    <input type="text" id="busqueda" placeholder="Buscar Id Préstamos Activos...">
                    <button type="submit">🔍</button>
                  </form>
                </div>
            <div class="Container-Tabla">
                <h1>Solicitudes de Préstamos Activos</h1>
                <table id="tablaLibroPres">
                    <thead>
                        <tr>
                            <th>Id Préstamo</th>
                            <th>Usuario</th>
                            <th>Libros</th>
                            <th>Fecha de Solicitud</th>
                            <th>Fecha de Inicio</th>
                            <th>Fecha de Fin</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                     <tbody>
                        <tr>
                            <td>1001</td>
                            <td>0912345678</td>
                            <td>1984</td>
                            <td>2024-04-28</td>
                            <td>2024-04-29</td>
                            <td>2024-05-13</td>
                            <td>Activo</td>
                        </tr>
                        <tr>
                            <td>1002</td>
                            <td>0923456789</td>
                            <td>Cien Años de Soledad</td>
                            <td>2024-04-30</td>
                            <td>2024-05-01</td>
                            <td>2024-05-15</td>
                            <td>Activo</td>
                        </tr>
                        <tr>
                            <td>1003</td>
                            <td>0934567890</td>
                            <td>El Principito</td>
                            <td>2024-05-01</td>
                            <td>2024-05-02</td>
                            <td>2024-05-16</td>
                            <td>Activo</td>
                        </tr>
                        <tr>
                            <td>1004</td>
                            <td>0945678901</td>
                            <td>Fahrenheit 451</td>
                            <td>2024-04-27</td>
                            <td>2024-04-28</td>
                            <td>2024-05-12</td>
                            <td>Activo</td>
                        </tr>
                        <tr>
                            <td>1005</td>
                            <td>0956789012</td>
                            <td>Sapiens: De Animales a Dioses</td>
                            <td>2024-04-26</td>
                            <td>2024-04-27</td>
                            <td>2024-05-11</td>
                            <td>Activo</td>
                        </tr>
                        <tr>
                            <td>1006</td>
                            <td>0967890123</td>
                            <td>El Señor de los Anillos</td>
                            <td>2024-05-02</td>
                            <td>2024-05-03</td>
                            <td>2024-05-17</td>
                            <td>Activo</td>
                        </tr>
                        <tr>
                            <td>1007</td>
                            <td>0978901234</td>
                            <td>Los Juegos del Hambre</td>
                            <td>2024-04-29</td>
                            <td>2024-04-30</td>
                            <td>2024-05-14</td>
                            <td>Activo</td>
                        </tr>
                        <tr>
                            <td>1008</td>
                            <td>0989012345</td>
                            <td>Rayuela</td>
                            <td>2024-05-03</td>
                            <td>2024-05-04</td>
                            <td>2024-05-18</td>
                            <td>Activo</td>
                        </tr>
                        <tr>
                            <td>1009</td>
                            <td>0990123456</td>
                            <td>El Amor en los Tiempos del Cólera</td>
                            <td>2024-04-25</td>
                            <td>2024-04-26</td>
                            <td>2024-05-10</td>
                            <td>Activo</td>
                        </tr>
                        <tr>
                            <td>1010</td>
                            <td>0901234567</td>
                            <td>Crónica de una Muerte Anunciada</td>
                            <td>2024-05-05</td>
                            <td>2024-05-06</td>
                            <td>2024-05-20</td>
                            <td>Activo</td>
                        </tr>                        
                    </tbody>
                </table>
            </div>
        </div>
        <div class="Container-2">
            <div class="Container-barra">
                <form class="barra-busqueda" onsubmit="buscarInactivos(event)">
                    <input type="text" id="busqueda" placeholder="Buscar Id Préstamos Inactivo...">
                    <button type="submit">🔍</button>
                  </form>
                </div>
            <div class="Container-Tabla2">
                <h1>Solicitudes de Préstamos Inactivo</h1>
                <table id="tablaLibroPres2">
                    <thead>
                        <tr> 
                            <th>Id Préstamo</th>
                            <th>Usuario</th>
                            <th>Libros</th>
                            <th>Fecha de Solicitud</th>
                            <th>Fecha de Inicio</th>
                            <th>Fecha de Fin</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                     <tbody>
                        <tr>
                            <td>1011</td>
                            <td>0911122233</td>
                            <td>La Sombra del Viento</td>
                            <td>2024-04-20</td>
                            <td>2024-04-21</td>
                            <td>2024-05-05</td>
                            <td>Inactivo</td>
                        </tr>
                        <tr>
                            <td>1012</td>
                            <td>0922233344</td>
                            <td>Don Quijote de la Mancha</td>
                            <td>2024-04-15</td>
                            <td>2024-04-16</td>
                            <td>2024-04-30</td>
                            <td>Inactivo</td>
                        </tr>
                        <tr>
                            <td>1013</td>
                            <td>0933344455</td>
                            <td>Orgullo y Prejuicio</td>
                            <td>2024-04-18</td>
                            <td>2024-04-19</td>
                            <td>2024-05-03</td>
                            <td>Inactivo</td>
                        </tr>
                        <tr>
                            <td>1014</td>
                            <td>0944455566</td>
                            <td>La Metamorfosis</td>
                            <td>2024-04-22</td>
                            <td>2024-04-23</td>
                            <td>2024-05-07</td>
                            <td>Inactivo</td>
                        </tr>
                        <tr>
                            <td>1015</td>
                            <td>0955566677</td>
                            <td>El Alquimista</td>
                            <td>2024-04-24</td>
                            <td>2024-04-25</td>
                            <td>2024-05-09</td>
                            <td>Inactivo</td>
                        </tr>
                        <tr>
                            <td>1016</td>
                            <td>0966677788</td>
                            <td>It (Eso)</td>
                            <td>2024-04-19</td>
                            <td>2024-04-20</td>
                            <td>2024-05-04</td>
                            <td>Inactivo</td>
                        </tr>
                        <tr>
                            <td>1017</td>
                            <td>0977788899</td>
                            <td>Drácula</td>
                            <td>2024-04-17</td>
                            <td>2024-04-18</td>
                            <td>2024-05-02</td>
                            <td>Inactivo</td>
                        </tr>
                        <tr>
                            <td>1018</td>
                            <td>0988899900</td>
                            <td>El Psicoanalista</td>
                            <td>2024-04-21</td>
                            <td>2024-04-22</td>
                            <td>2024-05-06</td>
                            <td>Inactivo</td>
                        </tr>
                        <tr>
                            <td>1019</td>
                            <td>0999900011</td>
                            <td>La Isla Misteriosa</td>
                            <td>2024-04-23</td>
                            <td>2024-04-24</td>
                            <td>2024-05-08</td>
                            <td>Inactivo</td>
                        </tr>
                        <tr>
                            <td>1020</td>
                            <td>0900011223</td>
                            <td>La Tregua</td>
                            <td>2024-04-25</td>
                            <td>2024-04-26</td>
                            <td>2024-05-10</td>
                            <td>Inactivo</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="../js/Registro.js"></script>
</body>
</html>