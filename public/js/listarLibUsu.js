document.addEventListener("DOMContentLoaded", function () {
    fetch('/SistemaBiblioteca/public/action.php?action=listarLibrosDisponibles')
        .then(res => res.json())
        .then(data => {
            const tbody = document.querySelector("#tablaLibros tbody");
            tbody.innerHTML = "";

            data.forEach(Libro => {
                const tr = document.createElement("tr");

                tr.innerHTML = `
                    <td>${Libro.id}</td>
                    <td>${Libro.titulo}</td>
                    <td>${Libro.autor}</td>
                    <td>${Libro.genero}</td>
                    <td>${Libro.cantidad}</td>
                    <td class="acciones">
                        <button class="btn-confirmar" title="Confirmar">
                            <i class="fas fa-check"></i> Solicitar
                        </button>
                    </td>
                `;

                // Añadir evento al botón desde JS (mejor práctica)
                const btn = tr.querySelector(".btn-confirmar");
                btn.addEventListener("click", () => Solicitar(btn));

                tbody.appendChild(tr);
            });
        });
});
//Sacar los datos de la tabla y ponerlos en el modal
function Solicitar(btn) {
    const fila = btn.closest("tr");
    const celdas = fila.children;

    libroSeleccionado = {
        id: celdas[0].textContent.trim(),
        titulo: celdas[1].textContent.trim()

    };

    // Mostrar datos en el modal
    document.getElementById("modalId").textContent = celdas[0].textContent;
    document.getElementById("modalLibro").textContent = celdas[1].textContent;
    document.getElementById("modalAutor").textContent = celdas[2].textContent;
    document.getElementById("modalGenero").textContent = celdas[3].textContent;

    // Configurar fechas
    const hoy = new Date();
    const maxInicio = new Date();
    maxInicio.setDate(hoy.getDate() + 3);

    const fechaInicioInput = document.getElementById("fechaInicio");
    fechaInicioInput.min = hoy.toISOString().split('T')[0];
    fechaInicioInput.max = maxInicio.toISOString().split('T')[0];
    fechaInicioInput.value = '';

    const fechaFinInput = document.getElementById("fechaFin");
    fechaFinInput.value = '';
    fechaFinInput.min = '';
    fechaFinInput.max = '';

    document.getElementById("modal").style.display = "block";
}
function cerrarModal() {
    document.getElementById("modal").style.display = "none";
}
// ajusto la fecha fin
document.getElementById("fechaInicio").addEventListener("change", function () {
    const inicio = new Date(this.value);
    if (isNaN(inicio)) return;

    const minFin = new Date(inicio);
    minFin.setDate(minFin.getDate() + 1); // mínimo 1 día después

    const maxFin = new Date(inicio);
    maxFin.setDate(maxFin.getDate() + 20); // máximo 20 días después

    const fechaFinInput = document.getElementById("fechaFin");
    fechaFinInput.min = minFin.toISOString().split('T')[0];
    fechaFinInput.max = maxFin.toISOString().split('T')[0];
    fechaFinInput.value = '';
});
//comunicacion con el backend
function confirmarSolicitud() {
    const fechaInicio = document.getElementById("fechaInicio").value;
    const fechaFin = document.getElementById("fechaFin").value;

    if (!fechaInicio || !fechaFin) {
        alert("Por favor, selecciona ambas fechas.");
        return;
    }

    // Obtener fecha actual (formato YYYY-MM-DD)
    const hoy = new Date();
    const fechaSolicitud = hoy.toISOString().split('T')[0];

    const datos = new URLSearchParams();
    datos.append("id_libro", libroSeleccionado.id);
    datos.append("fecha_inicio", fechaInicio);
    datos.append("fecha_fin", fechaFin);
    datos.append("id_usuario", idUsuario); // Ya está disponible en JS
    datos.append("fecha_solicitud", fechaSolicitud);

    fetch('/SistemaBiblioteca/public/action.php?action=solicitarLibro', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: datos.toString()
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert("Solicitud realizada con éxito.");
            cerrarModal();
            location.reload(); // Recargar para actualizar
        } else {
            alert("Error al realizar la solicitud: " + data.message);
        }
    })
    .catch(error => {
        console.error("Error al enviar la solicitud:", error);
    });
}