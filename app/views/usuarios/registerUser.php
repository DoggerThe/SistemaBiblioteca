<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro de Usuario</title>
</head>
<body>
  <h1>Registro de Usuario</h1>
    <form action="/SistemaBiblioteca/public/action.php?action=register" method="POST">
      <label>Cédula:</label><br>
      <input type="text" name="cedula" required><br><br>
  
      <label>Nombre:</label><br>
      <input type="text" name="nombre" required><br><br>
  
      <label>Apellido:</label><br>
      <input type="text" name="apellido" required><br><br>
  
      <label>Email:</label><br>
      <input type="email" name="email" required><br><br>
  
      <label>Contraseña:</label><br>
      <input type="password" name="password" required><br><br>
  
      <button type="submit">Registrarse</button>
    </form>
</body>
</html>
