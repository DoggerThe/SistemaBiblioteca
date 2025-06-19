// Variable global para almacenar temporalmente el préstamo seleccionado
let prestamoSeleccionado = null;
/*
 * Evento que se ejecuta cuando el DOM ha sido completamente cargado.
 * Se encarga de solicitar al backend la lista de solicitudes pendientes
 * y mostrarlas en la tabla correspondiente.
 */
document.addEventListener("DOMContentLoaded", function () {
    fetch('/SistemaBiblioteca/index.php?action=listarSolicitudesPendientes')
        .then(res => res.json())
        .then(data => {
            const tbody = document.querySelector("#tablaLibros tbody");
            tbody.innerHTML = ""; // Limpia cualquier contenido previo

            if (data.length === 0) {
                // Si no hay solicitudes, muestra un mensaje en la tabla
                const tr = document.createElement("tr");
                tr.innerHTML = `<td colspan="8" class="text-center">No hay solicitudes pendientes</td>`;
                tbody.appendChild(tr);
                return; // Sale de la función si no hay datos
            }
            else{
                data.forEach(prestamo => {
                    const tr = document.createElement("tr");
                    // Inserta la información del préstamo en la fila
                    tr.innerHTML = `
                        <td>${prestamo.id_prestamo}</td>
                        <td>${prestamo.cedula_usuario}</td>
                        <td>${prestamo.titulo_libro}</td>
                        <td>${prestamo.fecha_solicitud}</td>
                        <td>${prestamo.fecha_inicio}</td>
                        <td>${prestamo.fecha_fin}</td>
                        <td>${prestamo.estado}</td>
                        <td class="acciones">
                            <button class="btn-confirmar" title="Confirmar">
                                <i class="fas fa-check"></i> Confirmar
                            </button>
                        </td>
                    `;
    
                    // Añade evento al botón de confirmar desde JS
                    const btn = tr.querySelector(".btn-confirmar");
                    btn.addEventListener("click", () => Confirmar(btn));
                    // Agrega la fila al cuerpo de la tabla
                    tbody.appendChild(tr);
                });
            }
        });
});
/*
* Función que se ejecuta al hacer clic en el botón "Confirmar" de un préstamo.
* Extrae los datos de la fila seleccionada y muestra el modal con la información.
*/
function Confirmar(btn) {
    const fila = btn.closest("tr");
    const celdas = fila.children;
    // Almacena los datos necesarios para la confirmación
    prestamoSeleccionado = {
        id: celdas[0].textContent.trim(),
        libro: celdas[2].textContent.trim()
    };

    // Muestra los datos del préstamo en el modal
    document.getElementById("modalLibro").textContent = celdas[2].textContent;
    document.getElementById("modalFechaSolicitud").textContent = celdas[3].textContent;
    document.getElementById("modalFechaInicio").textContent = celdas[4].textContent;
    document.getElementById("modalFechaFin").textContent = celdas[5].textContent;
    // Muestra el modal
    document.getElementById("modal").style.display = "block";
}
/*
 * Cierra el modal sin realizar ninguna acción.
 */
function cerrarModal() {
    document.getElementById("modal").style.display = "none";
}
/*
 * Función que realiza una solicitud al backend para cambiar el estado del préstamo.
 * Se llama desde un botón dentro del modal para confirmar la acción del préstamo.
 */
function cambiarEstado() {
    fetch('/SistemaBiblioteca/index.php?action=aceptarPrestamo', {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "id=" + prestamoSeleccionado.id// Envía el ID del préstamo seleccionado
    })
    .then(res => res.json())
    .then(respuesta => {
        if (respuesta.success) {
            alert("Solicitud confirmada.");
            cerrarModal();
            location.reload(); // Recarga la página para actualizar la tabla
        } else {
            alert(respuesta.mensaje || "Error al confirmar el préstamo.");
        }
    })
    .catch(error => {
        console.log("Hola1: " + error);
    });
}