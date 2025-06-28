// Evento que se ejecuta cuando el DOM ha sido completamente cargado.
// Realiza una solicitud POST para obtener los libros que un usuario ha solicitado.
document.addEventListener("DOMContentLoaded", function () {
    // Realiza una solicitud POST al backend para obtener los libros prestados por el usuario.
    const datos = new URLSearchParams();
    datos.append("action", "listarLibrosPrestaUsu");
    datos.append("usuario_id",idUsuario);
    datos.append("tipo", 3);

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
        }
    });
});

function VerDetalles(btn) {
    const fila = btn.closest("tr");
    const celdas = fila.children;
    // Muestra los datos del préstamo en el modal
    document.getElementById("modalNumPres").textContent = celdas[0].textContent;
    document.getElementById("modalLibro").textContent = celdas[1].textContent;
    document.getElementById("modalFechaInicio").textContent = celdas[2].textContent;
    document.getElementById("modalFechaFin").textContent = celdas[3].textContent;
    // Muestra el modal
    document.getElementById("modal").style.display = "block";
}
/*
 * Cierra el modal sin realizar ninguna acción.
 */
function cerrarModal() {
    document.getElementById("modal").style.display = "none";
}
async function cancelarSolicitud(){
    if(confirm("Seguro que ya no desea solicitar de este libro.")){
        const NumPresta = parseInt(document.getElementById("modalNumPres").textContent);
        const Data = new URLSearchParams();
        Data.append("action", "cancelarSolicitudLibro");
        Data.append("idUser", idUsuario);
        Data.append("NumPrestamo", NumPresta);

        try{
            const response = await fetch('/SistemaBiblioteca/index.php',{
                method: "POST",
                headers:{
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: Data.toString()
            })
            const resol = await response.json();
            if (resol){
                alert ("Solicitud cancelada correctamente.");
                cerrarModal();
                location.reload();
            }else{
                alert ("No se pudo continuar con la solicitud.");
            }

        }catch(error){
            console.error('No se pudo hacer la solicitud: ', error.message);
            alert(`Ocurrió un error.`);
        }
    }else{
        cerrarModal();
    }
}