function buscar(event) {
    event.preventDefault(); // Evita que se recargue la página
    const termino = document.getElementById('busqueda').value;

    fetch('/SistemaBiblioteca/public/action.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            action: 'buscar',
            termino: termino
        })
    })

    .then(response => response.json())
    .then(libros => {
        const tbody = document.querySelector('#tablaLibros tbody');
        tbody.innerHTML = ''; // Limpiar tabla

        if (libros.length === 0) {
            tbody.innerHTML = '<tr><td colspan="3">No se encontraron resultados</td></tr>';
        } else {
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
    })
    .catch(error => {
        console.error('Error al buscar:', error);
    });
}