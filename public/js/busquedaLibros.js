// Función que maneja el evento de búsqueda
function buscar(event) {
    event.preventDefault(); // Evita que se recargue la página al enviar el formulario
    // Obtiene el término de búsqueda desde el input con id 'busqueda'
    const termino = document.getElementById('busqueda').value;
    // Realiza una solicitud POST al servidor para buscar los libros
    fetch('/SistemaBiblioteca/public/action.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',// Define el tipo de contenido como URL-encoded
        },
        body: new URLSearchParams({
            action: 'buscar',// Indica que la acción es buscar
            termino: termino// El término de búsqueda que el usuario ingresó
        })
    })

    .then(response => response.json())// Convierte la respuesta en formato JSON
    .then(libros => {
        // Selecciona el cuerpo de la tabla donde se mostrarán los libros encontrados
        const tbody = document.querySelector('#tablaLibros tbody');
        tbody.innerHTML = ''; // Limpia la tabla antes de insertar nuevos resultados
        // Si no se encontraron libros, se muestra un mensaje de "No se encontraron resultados"
        if (libros.length === 0) {
            tbody.innerHTML = '<tr><td colspan="3">No se encontraron resultados</td></tr>';
        } else {
            // Si hay libros encontrados, se agregan las filas a la tabla
            libros.forEach(libro => {
                const fila = `
                    <tr>
                        <td>${libro.titulo}</td>
                        <td>${libro.autor}</td>
                        <td>${libro.cantidad}</td>
                    </tr>
                `;
                tbody.innerHTML += fila;// Añade cada fila a la tabla
            });
        }
    })
    .catch(error => {
        // Maneja cualquier error que ocurra durante la solicitud
        console.error('Error al buscar:', error);
    });
}