/*
 * Función para buscar préstamos activos según un término ingresado por el usuario.
 * Se activa con el evento submit del formulario o botón correspondiente.
 */
function buscarActivos(event) {
    event.preventDefault();// Previene el envío del formulario y recarga de la página
    // Obtiene el valor ingresado en el campo de búsqueda de la sección de activos
    const termino = document.querySelector('.Container-1 #busqueda').value;
    // Realiza una solicitud POST al backend para buscar préstamos activos
    fetch('/SistemaBiblioteca/public/action.php?action=buscar_activos', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ termino }) // Codifica el término como si fuera un formulario
    })
    .then(res => res.json()) // Convierte la respuesta a JSON
    .then(data => {
        const tbody = document.querySelector('#tablaLibroPres tbody');
        tbody.innerHTML = '';// Limpia la tabla antes de mostrar nuevos resultados
        if (data.length === 0) {
            // Muestra un mensaje si no hay resultados
            tbody.innerHTML = '<tr><td colspan="7">No se encontraron resultados.</td></tr>';
        } else {
            // Llena la tabla con los resultados encontrados
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
    }).catch(err => console.error('Error activos:', err));// Captura y muestra errores en consola
}

/*
 * Función para buscar préstamos inactivos según un término ingresado por el usuario.
 * Similar a buscarActivos pero para otra tabla y endpoint.
 */
function buscarInactivos(event) {
    event.preventDefault(); // Evita el comportamiento por defecto del formulario
    // Obtiene el valor del input de búsqueda de la sección de inactivos
    const termino = document.querySelector('.Container-2 #busqueda').value;
    // Realiza la solicitud POST para buscar préstamos inactivos
    fetch('/SistemaBiblioteca/public/action.php?action=buscar_inactivos', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ termino })// Envía el término como formulario codificado
    })
    .then(res => res.json())
    .then(data => {
        const tbody = document.querySelector('#tablaLibroPres2 tbody');
        tbody.innerHTML = '';// Limpia resultados anteriores
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
    }).catch(err => console.error('Error inactivos:', err)); // Muestra errores en consola
}