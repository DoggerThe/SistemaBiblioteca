# 📚  SISTEMA DE GESTION DE PRÉSTAMO  ONLINE DE  BIBLIOTECA
 
<img
src="/public/img/logo.jpg"
alt="logo"
width="535px"
height="400px"
/>
<br>
<br>
Grupo de Construccion de Software Sof-Ve-6-3
## 📝 Descripción:
El **Sistema de Gestion de Prestamos Online de Biblioteca** es un sitio web que permite a usuarios registrados realizar solicitudes de préstamo desde cualquier lugar con acceso a Internet.
Los **usuarios generales** pueden registrarse, buscar libros, visualizar información detallada y solicitar préstamos en línea. 
Los **bibliotecarios**, en cambio, cuentan con herramientas para aprobar solicitudes, llevar el control del inventario y registrar las devoluciones de libros.

## 💻 Tecnologías usadas:
- **Entorno de desarrollo**: Visual Studio Code.
- **Lenguajes**:
  - **Frontend**: HTML5, CSS3, JavaScript.
  - **Backend**: PHP.
- **Base de datos**: MySQL.
- **Patrón de diseño**: MVC (Modelo-Vista-Controlador) para una mejor organización y mantenimiento del proyecto.
- **Control de versiones**: Git (local) y GitHub (colaboración remota).

## 🛠️ Cómo ejecutar el proyecto:
1. **Instalar MySQL Server** desde [MySQL](https://dev.mysql.com/downloads/mysql/) y anotar la contraseña del usuario `root`.  
   Opcional: instalar [MySQL Workbench](https://dev.mysql.com/downloads/workbench/) para gestionar la base de datos con interfaz gráfica.

2. **Instalar XAMPP** desde [Apache Friends](https://www.apachefriends.org/es/index.html).  
   Dejar todas las opciones por defecto durante la instalación.

3. **Instalar Visual Studio Code** desde [VS Code](https://code.visualstudio.com/).

4. **Clonar o descargar el repositorio** desde [GitHub - SistemaBiblioteca](https://github.com/DoggerThe/SistemaBiblioteca).

5. **Mover el proyecto a la carpeta `htdocs` de XAMPP**, ubicada normalmente en `C:\xampp\htdocs`, y descomprimirlo ahí.

6. **Crear la base de datos en MySQL**:  
   - Abrir el archivo SQL que está en la carpeta `scripts` del proyecto.  
   - Crear una base de datos con el nombre `biblioteca_mvc`.  
   - Ejecutar el script SQL para crear las tablas necesarias.

7. **Configurar el archivo `config/database.php`** con los datos de tu base de datos:  
   - Nombre de la base de datos: `biblioteca_mvc`  
   - Usuario: `root`  
   - Contraseña: *(la que usaste al instalar MySQL)*

8. **Iniciar Apache desde XAMPP**.

9. **Abrir el navegador y acceder al proyecto** desde:  
   `http://localhost/SistemaBiblioteca/public/index.php`
## 👥 Autores
- [Martinez Gamarra Daniel Andrés](https://github.com/Daniel-M31)  
- [Banchon Salas Roger Adonis](https://github.com/DoggerThe?tab=stars)  
- [Loza Orozco Cristopher Mauricio](https://github.com/Crenshaws1975) 
- [Valencia Mora Carlos Alexander](https://github.com/ExoriusSama) 
- [Macas Jiménez David Alejandro](https://github.com/Macas-David)