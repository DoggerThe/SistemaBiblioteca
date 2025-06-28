// Evento que se ejecuta cuando el DOM ha sido completamente cargado.
// Realiza una solicitud POST para obtener los libros que un usuario ha solicitado.
document.addEventListener("DOMContentLoaded", function () {
    // Realiza una solicitud POST al backend para obtener los libros prestados por el usuario.
    const datos = new URLSearchParams();
    datos.append("action", "listarLibrosPrestaUsu");
    datos.append("usuario_id",idUsuario);
    datos.append("tipo", 1);

    fetch('/SistemaBiblioteca/index.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded' // Envia los datos
        },
        body: datos.toString()
    })
    .then(res => res.json()) // Convierte la respuesta del servidor a formato JSON
    .then(data => {
        // Selecciona el cuerpo de la tabla donde se mostrarán los datos de los libros
        const tbody = document.querySelector("#tablaLibros tbody");
        if (data.lenght === 0){
            const tr = document.createElement("tr");
            tr.innerHTML = `<td colspan = "5" class="text-center">No hay libros Prestados</td>`;
            tbody.appendChild(tr);
            return;
        }
        else{
            tbody.innerHTML = "";// Limpia la tabla antes de agregar nuevos datos
            // Itera sobre cada libro obtenido y crea una nueva fila en la tabla para mostrar los datos
            data.forEach(Libro => {
                const tr = document.createElement("tr");
                // Inserta los datos del libro en la fila de la tabla
                tr.innerHTML = `
                    <td>${Libro.id}</td>
                    <td>${Libro.titulo_libro}</td>
                    <td>${Libro.fecha_inicio}</td>
                    <td>${Libro.fecha_fin}</td>
                `;
                // Agrega la nueva fila a la tabla
                tbody.appendChild(tr);
            });
        }
    });
});