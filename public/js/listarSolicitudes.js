let prestamoSeleccionado = null;

document.addEventListener("DOMContentLoaded", function () {
    fetch('/SistemaBiblioteca/public/action.php?action=listarSolicitudesPendientes')
        .then(res => res.json())
        .then(data => {
            const tbody = document.querySelector("#tablaLibros tbody");
            tbody.innerHTML = "";

            data.forEach(prestamo => {
                const tr = document.createElement("tr");

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

                // Añadir evento al botón desde JS (mejor práctica)
                const btn = tr.querySelector(".btn-confirmar");
                btn.addEventListener("click", () => Confirmar(btn));

                tbody.appendChild(tr);
            });
        });
});
/*amor a la patria*/

function Confirmar(btn) {
    const fila = btn.closest("tr");
    const celdas = fila.children;

    prestamoSeleccionado = {
        id: celdas[0].textContent.trim(),
        libro: celdas[2].textContent.trim()
    };

    // Mostrar datos en el modal
    document.getElementById("modalLibro").textContent = celdas[2].textContent;
    document.getElementById("modalFechaSolicitud").textContent = celdas[3].textContent;
    document.getElementById("modalFechaInicio").textContent = celdas[4].textContent;
    document.getElementById("modalFechaFin").textContent = celdas[5].textContent;

    document.getElementById("modal").style.display = "block";
}

function cerrarModal() {
    document.getElementById("modal").style.display = "none";
}

// Acción que llama al backend
function cambiarEstado() {
    fetch('/SistemaBiblioteca/public/action.php?action=aceptarPrestamo', {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "id=" + prestamoSeleccionado.id
    })
    .then(res => res.json())
    .then(respuesta => {
        if (respuesta.success) {
            alert("Solicitud confirmada.");
            cerrarModal();
            location.reload(); // Refrescar tabla
        } else {
            alert(respuesta.mensaje || "Error al confirmar el préstamo.");
        }
    })
    .catch(error => {
        console.log("Hola1: " + error);
    });
}


/*
let prestamoSeleccionado = null;

document.addEventListener("DOMContentLoaded", function () {
    fetch('/SistemaBiblioteca/public/action.php?action=listarSolicitudesPendientes')
        .then(res => res.json())
        .then(data => {
            const tbody = document.querySelector("#tablaLibros tbody");
            tbody.innerHTML = "";
            data.forEach(prestamo => {
                const tr = document.createElement("tr");
                tr.innerHTML = `
                    <td>${prestamo.id_prestamo}</td>
                    <td>${prestamo.cedula_usuario}</td>
                    <td>${prestamo.titulo_libro}</td>
                    <td>${prestamo.fecha_solicitud}</td>
                    <td>${prestamo.fecha_inicio}</td>
                    <td>${prestamo.fecha_fin}</td>
                    <td>${prestamo.estado}</td>
                    <td class="acciones">
                        <button onclick='Confirmar(this)' class="btn-confirmar">
                            <i class="fas fa-check"></i> Confirmar
                        </button>
                    </td>
                `;
                tbody.appendChild(tr);
            });
        });
});

window.Confirmar = function(btn) {
    console.log("Confirmar fue llamado");
    const fila = btn.closest("tr");
    const celdas = fila.children;

    prestamoSeleccionado = {
        id: celdas[0].textContent,
        libro: celdas[2].textContent
    };

    document.getElementById("modalLibro").textContent = celdas[2].textContent;
    document.getElementById("modalFechaSolicitud").textContent = celdas[3].textContent;
    document.getElementById("modalFechaInicio").textContent = celdas[4].textContent;
    document.getElementById("modalFechaFin").textContent = celdas[5].textContent;

    document.getElementById("modal").style.display = "block";
}

function cerrarModal() {
    document.getElementById("modal").style.display = "none";
}

function cambiarEstado() {
    fetch('/SistemaBiblioteca/public/action.php?action=aceptarPrestamo', {
        method: "POST",
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: "id=" + prestamoSeleccionado.id
    })
    .then(res => res.json())
    .then(respuesta => {
        if (respuesta.success) {
            alert("Préstamo activado correctamente.");
            cerrarModal();
            location.reload(); // Recargar tabla
        } else {
            alert(respuesta.mensaje || "Error al activar el préstamo.");
        }
    });
}
*/