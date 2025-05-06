document.addEventListener("DOMContentLoaded", function () {
    fetch('/SistemaBiblioteca/public/action.php?action=listarLibrosPrestaUsu', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            action: 'listarLibrosPrestaUsu',
            usuario_id: idUsuario
        })
    })
    .then(res => res.json())
    .then(data => {
        const tbody = document.querySelector("#tablaLibros tbody");
        tbody.innerHTML = "";

        data.forEach(Libro => {
            const tr = document.createElement("tr");

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

            const btn = tr.querySelector(".btn-confirmar");
            btn.addEventListener("click", () => VerDetalles(btn));

            tbody.appendChild(tr);
        });
    });
});
