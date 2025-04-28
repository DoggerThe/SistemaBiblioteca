<?php

require_once '../../config/database.php';
try{
    $db = $databaseConexion -> getConnection();
    echo "Abemus papa";
    //Con esto nos guiamos
    /*
    // 3. Crear tabla de prueba si no existe
    $db->exec("CREATE TABLE IF NOT EXISTS prueba_sistema (
        id INT AUTO_INCREMENT PRIMARY KEY,
        mensaje VARCHAR(255) NOT NULL,
        fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    
    // 4. Insertar datos
    $stmt = $db->prepare("INSERT INTO prueba_sistema (mensaje) VALUES (:mensaje)");
    $stmt->execute([':mensaje' => 'Primer mensaje de prueba']);
    
    echo "Dato insertado correctamente.<br><br>";
    
    // 5. Leer datos
    $stmt = $db->query("SELECT * FROM prueba_sistema");
    $resultados = $stmt->fetchAll();
    
    echo "Datos en la tabla:<br>";
    foreach ($resultados as $fila) {
        echo "ID: {$fila['id']}, Mensaje: {$fila['mensaje']}, Fecha: {$fila['fecha_creacion']}<br>";
    }
    
    // 6. Actualizar datos
    $stmt = $db->prepare("UPDATE prueba_sistema SET mensaje = :nuevo_mensaje WHERE id = :id");
    $stmt->execute([
        ':nuevo_mensaje' => 'Mensaje actualizado',
        ':id' => 1
    ]);
    
    echo "<br>Dato actualizado.<br><br>";
    
    // 7. Leer datos nuevamente para ver cambios
    $stmt = $db->query("SELECT * FROM prueba_sistema");
    $resultados = $stmt->fetchAll();
    
    echo "Datos actualizados:<br>";
    foreach ($resultados as $fila) {
        echo "ID: {$fila['id']}, Mensaje: {$fila['mensaje']}, Fecha: {$fila['fecha_creacion']}<br>";
    }
    
    // 8. Eliminar datos (opcional)
    // $db->exec("DROP TABLE IF EXISTS prueba_sistema");
    // echo "<br>Tabla eliminada (descomenta esta línea para activar).<br>";
    */
}
catch (PDOException $e) {
    die("Error durante las operaciones: " . $e->getMessage());
}