cargarTablaLibros();

async function cargarTablaLibros() {
    try {
        const response = await fetch('/SistemaBiblioteca/index.php?action=obtenerLibros');
        if (!response.ok) {
            throw new Error('Error al cargar los libros');
        }
        const libros = await response.json();

        const tbody = document.querySelector('#tablaLibros tbody');
        tbody.innerHTML = ''; // Limpia la tabla antes de insertar nuevos datos
        if (libros.length === 0) {
            // Si no hay libros, muestra un mensaje
            tbody.innerHTML = '<tr><td colspan="3">No hay libros disponibles</td></tr>';
        } else {
            // Si hay libros, los agrega a la tabla
            libros.forEach(libro => {
                const fila = `
                    <tr>
                        <td>${libro.titulo}</td>
                        <td>${libro.autor}</td>
                        <td>${libro.cantidad}</td>
                    </tr>
                `;
                tbody.innerHTML += fila;
            });
        }
    } catch (error) {
        // Maneja cualquier error que ocurra durante la solicitud
        console.error('Error al cargar los libros:', error)
        alert(`Ocurrió un error: ${error.message}`)
    };
}
// Función que maneja el evento de búsqueda
document.getElementById('form-busqueda').addEventListener('submit', async (event)=>{
    // Evita que se recargue la página al enviar el formulario
    event.preventDefault();
    
    const termino = document.getElementById('busqueda').value.trim();
    try{
        const response = await fetch(`/SistemaBiblioteca/index.php?action=buscar&q=${encodeURIComponent(termino)}`);
        if (!response.ok) {
            throw new Error('Error en la búsqueda');
        }
        const resultados = await response.json();

        const tbody = document.querySelector('#tablaLibros tbody');
        tbody.innerHTML = ''; // Limpia la tabla antes de insertar nuevos resultados
        if (resultados.length === 0) {
            // Si no se encontraron resultados, muestra un mensaje
            tbody.innerHTML = '<tr><td colspan="3">No se encontraron resultados</td></tr>';
        } else {
            // Si hay resultados, los agrega a la tabla
            resultados.forEach(libro => {
                const fila = `
                    <tr>
                        <td>${libro.titulo}</td>
                        <td>${libro.autor}</td>
                        <td>${libro.cantidad}</td>
                    </tr>
                `;
                tbody.innerHTML += fila;
            });
        }
    }catch(error) {
        // Maneja cualquier error que ocurra durante la solicitud
        console.error('🚨 Error al buscar:', error);
    };

})
