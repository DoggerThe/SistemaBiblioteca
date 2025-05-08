// Evento que se ejecuta cuando el DOM ha sido completamente cargado.
// Realiza una solicitud POST para obtener los libros que un usuario ha solicitado.
document.addEventListener("DOMContentLoaded", function () {
    // Realiza una solicitud POST al backend para obtener los libros prestados por el usuario.
    fetch('/SistemaBiblioteca/public/action.php?action=listarLibrosPrestaUsu', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json' // Envia los datos en formato JSON
        },
        body: JSON.stringify({
            action: 'listarLibrosPrestaUsu', // Acción para obtener los libros prestados
            usuario_id: idUsuario // El ID del usuario para filtrar los libros que le pertenecen
        })
    })
    .then(res => res.json()) // Convierte la respuesta del servidor a formato JSON
    .then(data => {
        // Selecciona el cuerpo de la tabla donde se mostrarán los datos de los libros
        const tbody = document.querySelector("#tablaLibros tbody");
        tbody.innerHTML = "";// Limpia la tabla antes de agregar nuevos datos
        // Itera sobre cada libro obtenido y crea una nueva fila en la tabla para mostrar los datos
        data.forEach(Libro => {
            const tr = document.createElement("tr");
            // Inserta los datos del libro en la fila de la tabla
            tr.innerHTML = `
                <td>${Libro.libro_id}</td>
                <td>${Libro.titulo_libro}</td>
                <td>${Libro.fecha_inicio}</td>
                <td>${Libro.fecha_fin}</td>
                <td class="acciones">
                    <button class="btn-confirmar" title="Confirmar">
                        <i class="fas fa-check"></i> Ver Detalles
                    </button>
                </td>
            `;
            // Selecciona el botón "Ver Detalles" y agrega un evento de click para mostrar detalles del libro
            const btn = tr.querySelector(".btn-confirmar");
            btn.addEventListener("click", () => VerDetalles(btn));
            // Agrega la nueva fila a la tabla
            tbody.appendChild(tr);
        });
    });
});