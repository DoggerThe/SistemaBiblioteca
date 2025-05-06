function buscarActivos(event) {
    event.preventDefault();
    const termino = document.querySelector('.Container-1 #busqueda').value;

    fetch('/SistemaBiblioteca/public/action.php?action=buscar_activos', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ termino })
    })
    .then(res => res.json())
    .then(data => {
        const tbody = document.querySelector('#tablaLibroPres tbody');
        tbody.innerHTML = '';
        if (data.length === 0) {
            tbody.innerHTML = '<tr><td colspan="7">No se encontraron resultados.</td></tr>';
        } else {
            data.forEach(p => {
                tbody.innerHTML += `
                    <tr>
                        <td>${p.id_prestamo}</td>
                        <td>${p.cedula_usuario}</td>
                        <td>${p.titulo_libro}</td>
                        <td>${p.fecha_solicitud}</td>
                        <td>${p.fecha_inicio}</td>
                        <td>${p.fecha_fin}</td>
                        <td>${p.estado}</td>
                    </tr>`;
            });
        }
    }).catch(err => console.error('Error activos:', err));
}

function buscarInactivos(event) {
    event.preventDefault();
    const termino = document.querySelector('.Container-2 #busqueda').value;

    fetch('/SistemaBiblioteca/public/action.php?action=buscar_inactivos', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ termino })
    })
    .then(res => res.json())
    .then(data => {
        const tbody = document.querySelector('#tablaLibroPres2 tbody');
        tbody.innerHTML = '';
        if (data.length === 0) {
            tbody.innerHTML = '<tr><td colspan="7">No se encontraron resultados.</td></tr>';
        } else {
            data.forEach(p => {
                tbody.innerHTML += `
                    <tr>
                        <td>${p.id_prestamo}</td>
                        <td>${p.cedula_usuario}</td>
                        <td>${p.titulo_libro}</td>
                        <td>${p.fecha_solicitud}</td>
                        <td>${p.fecha_inicio}</td>
                        <td>${p.fecha_fin}</td>
                        <td>${p.estado}</td>
                    </tr>`;
            });
        }
    }).catch(err => console.error('Error inactivos:', err));
}