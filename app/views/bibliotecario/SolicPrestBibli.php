<?php
require_once __DIR__ . '/../../helpers/auth.php';
requireRole(2); // 2 es el rol de bibliotecario
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/SistemaBiblioteca/public/css/SolicPrestBibli.css">
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
            <div class="Container-Tabla">
                <h1>Solicitudes de Préstamos</h1>
                <table id="tablaLibros">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Libro</th>
                            <th>Fecha de Solicitud</th>
                            <th>Fecha de Inicio</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                     <tbody>
                        <tr>
                            <td>0645821369</td>
                            <td>Introducción a la Programación</td>
                            <td>2024-04-17</td>
                            <td>---------</td>
                            <td>Pendiente</td>
                            <td class="acciones">
                                <button onclick="Confirmar(this)" title="Confirmar" class="btn-confirmar">
                                    <i class="fas fa-check"></i> Confirmar
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>4578123658</td>
                            <td>Cien años de soledad</td>
                            <td>2024-04-17</td>
                             <td>---------</td>
                            <td>Pendiente</td>
                             <td class="acciones">
                                <button onclick="Confirmar(this)" title="Confirmar" class="btn-confirmar">
                                    <i class="fas fa-check"></i> Confirmar
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>7841524867</td>
                            <td>Orgullo y prejuicio</td>
                            <td>2024-04-12</td>
                            <td>---------</td>
                            <td>Pendiente</td>
                            <td class="acciones">
                                <button onclick="Confirmar(this)" title="Confirmar" class="btn-confirmar">
                                    <i class="fas fa-check"></i> Confirmar
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>9514782436</td>
                            <td>El principito</td>
                            <td>2024-04-10</td>
                            <td>---------</td>
                            <td>Pendiente</td>
                            <td class="acciones">
                                <button onclick="Confirmar(this)" title="Confirmar" class="btn-confirmar">
                                    <i class="fas fa-check"></i> Confirmar
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>4578213695</td>
                            <td>El Código Da Vinci</td>
                            <td>2024-04-14</td>
                            <td>---------</td>
                            <td>Pendiente</td>
                            <td class="acciones">
                                <button onclick="Confirmar(this)" title="Confirmar" class="btn-confirmar">
                                    <i class="fas fa-check"></i> Confirmar
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>0248759614</td>
                            <td>La Sombra del Viento</td>
                            <td>2024-04-16</td>
                            <td>---------</td>
                            <td>Pendiente</td>
                            <td class="acciones">
                                <button onclick="Confirmar(this)" title="Confirmar" class="btn-confirmar">
                                    <i class="fas fa-check"></i> Confirmar
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>0547821364</td>
                            <td>El Hobbit</td>
                            <td>2024-04-17</td>
                            <td>---------</td>
                            <td>Pendiente</td>
                            <td class="acciones">
                                <button onclick="Confirmar(this)" title="Confirmar" class="btn-confirmar">
                                    <i class="fas fa-check"></i> Confirmar
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>0921475364</td>
                            <td>La Casa de los Espíritus</td>
                            <td>2024-04-18</td>
                            <td>---------</td>
                            <td>Pendiente</td>
                            <td class="acciones">
                                <button onclick="Confirmar(this)" title="Confirmar" class="btn-confirmar">
                                    <i class="fas fa-check"></i> Confirmar
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>0241578962</td>
                            <td>Crimen y Castigo</td>
                            <td>2024-04-19</td>
                            <td>---------</td>
                            <td>Pendiente</td>
                            <td class="acciones">
                                <button onclick="Confirmar(this)" title="Confirmar" class="btn-confirmar">
                                    <i class="fas fa-check"></i> Confirmar
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>1542579521</td>
                            <td>Fahrenheit 451</td>
                            <td>2024-04-20</td>
                            <td>---------</td>
                            <td>Pendiente</td>
                            <td class="acciones">
                                <button onclick="Confirmar(this)" title="Confirmar" class="btn-confirmar">
                                    <i class="fas fa-check"></i> Confirmar
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>0958617245</td>
                            <td>El Principito</td>
                            <td>2024-04-21</td>
                            <td>---------</td>
                            <td>Pendiente</td>
                            <td class="acciones">
                                <button onclick="Confirmar(this)" title="Confirmar" class="btn-confirmar">
                                    <i class="fas fa-check"></i> Confirmar
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>0214571289</td>
                            <td>Los Miserables</td>
                            <td>2024-04-22</td>
                            <td>---------</td>
                            <td>Pendiente</td>
                            <td class="acciones">
                                <button onclick="Confirmar(this)" title="Confirmar" class="btn-confirmar">
                                    <i class="fas fa-check"></i> Confirmar
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>0241579165</td>
                            <td>Orgullo y Prejuicio</td>
                            <td>2024-04-23</td>
                            <td>---------</td>
                            <td>Pendiente</td>
                            <td class="acciones">
                                <button onclick="Confirmar(this)" title="Confirmar" class="btn-confirmar">
                                    <i class="fas fa-check"></i> Confirmar
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>0245896325</td>
                            <td>Drácula</td>
                            <td>2024-04-24</td>
                            <td>---------</td>
                            <td>Pendiente</td>
                            <td class="acciones">
                                <button onclick="Confirmar(this)" title="Confirmar" class="btn-confirmar">
                                    <i class="fas fa-check"></i> Confirmar
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>0257896542</td>
                            <td>Los Hermanos Karamazov</td>
                            <td>2024-04-25</td>
                            <td>---------</td>
                            <td>Pendiente</td>
                            <td class="acciones">
                                <button onclick="Confirmar(this)" title="Confirmar" class="btn-confirmar">
                                    <i class="fas fa-check"></i> Confirmar
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>0215489652</td>
                            <td>La Metamorfosis</td>
                            <td>2024-04-26</td>
                            <td>---------</td>
                            <td>Pendiente</td>
                            <td class="acciones">
                                <button onclick="Confirmar(this)" title="Confirmar" class="btn-confirmar">
                                    <i class="fas fa-check"></i> Confirmar
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>0697425816</td>
                            <td>Matar a un Ruiseñor</td>
                            <td>2024-04-27</td>
                            <td>---------</td>
                            <td>Pendiente</td>
                            <td class="acciones">
                                <button onclick="Confirmar(this)" title="Confirmar" class="btn-confirmar">
                                    <i class="fas fa-check"></i> Confirmar
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>0578216952</td>
                            <td>La Trilogía de la Fundación</td>
                            <td>2024-04-28</td>
                            <td>---------</td>
                            <td>Pendiente</td>
                            <td class="acciones">
                                <button onclick="Confirmar(this)" title="Confirmar" class="btn-confirmar">
                                    <i class="fas fa-check"></i> Confirmar
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>0254821365</td>
                            <td>Cien Años de Soledad</td>
                            <td>2024-04-30</td>
                            <td>---------</td>
                            <td>Pendiente</td>
                            <td class="acciones">
                                <button onclick="Confirmar(this)" title="Confirmar" class="btn-confirmar">
                                    <i class="fas fa-check"></i> Confirmar
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>0245896354</td>
                            <td>Rayuela</td>
                            <td>2024-05-01</td>
                            <td>---------</td>
                            <td>Pendiente</td>
                            <td class="acciones">
                                <button onclick="Confirmar(this)" title="Confirmar" class="btn-confirmar">
                                    <i class="fas fa-check"></i> Confirmar
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>0215784215</td>
                            <td>El Amor en los Tiempos del Cólera</td>
                            <td>2024-05-02</td>
                            <td>---------</td>
                            <td>Pendiente</td>
                            <td class="acciones">
                                <button onclick="Confirmar(this)" title="Confirmar" class="btn-confirmar">
                                    <i class="fas fa-check"></i> Confirmar
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>0215846824</td>
                            <td>El Perfume</td>
                            <td>2024-05-03</td>
                            <td>---------</td>
                            <td>Pendiente</td>
                            <td class="acciones">
                                <button onclick="Confirmar(this)" title="Confirmar" class="btn-confirmar">
                                    <i class="fas fa-check"></i> Confirmar
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>0952175642</td>
                            <td>Ensayo sobre la ceguera</td>
                            <td>2024-05-04</td>
                            <td>---------</td>
                            <td>Pendiente</td>
                            <td class="acciones">
                                <button onclick="Confirmar(this)" title="Confirmar" class="btn-confirmar">
                                    <i class="fas fa-check"></i> Confirmar
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>0685125871</td>
                            <td>Neuromante</td>
                            <td>2024-05-05</td>
                            <td>---------</td>
                            <td>Pendiente</td>
                            <td class="acciones">
                                <button onclick="Confirmar(this)" title="Confirmar" class="btn-confirmar">
                                    <i class="fas fa-check"></i> Confirmar
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
    </div>
    <script src="../js/Registro.js"></script>
</body>
</html>