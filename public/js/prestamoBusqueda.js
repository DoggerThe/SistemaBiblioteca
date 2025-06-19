
cargarTablaActivos();
cargarTablaInactivos();
/*
 * Función para buscar préstamos activos según un término ingresado por el usuario.
 * Se activa con el evento submit del formulario o botón correspondiente.
*/
function cargarTablaActivos() {
    const tipo = 'activos';
    const action = 'obtenerActivos';
    const tbody = '#tablaLibroPres tbody';

    cargar(tipo, action, tbody);
};
function cargarTablaInactivos() {
    const tipo = 'inactivos';
    const action = 'obtenerInactivos';
    const Ntbody = '#tablaLibroPres2 tbody';

    cargar(tipo, action, Ntbody);
};
async function cargar(tipo, action, Ntbody){
    try{
        const response = await fetch(`/SistemaBiblioteca/index.php?action=${action}`);
        if (!response.ok) {
            throw new Error(`Error al cargar los préstamos ${tipo}`);
        }
        const prestamos = await response.json();

        const tbody = document.querySelector(`${Ntbody}`);
        tbody.innerHTML = ''; // Limpia la tabla antes de insertar nuevos datos
        if (prestamos.length === 0) {
            // Si no hay préstamos activos, muestra un mensaje
            tbody.innerHTML = `<tr><td colspan="7">No hay préstamos ${tipo}</td></tr>`;
        } else {
            // Si hay préstamos activos, los agrega a la tabla
            prestamos.forEach(p => {
                const fila =`
                    <tr>
                        <td>${p.id_prestamo}</td>
                        <td>${p.cedula_usuario}</td>
                        <td>${p.titulo_libro}</td>
                        <td>${p.fecha_solicitud}</td>
                        <td>${p.fecha_inicio}</td>
                        <td>${p.fecha_fin}</td>
                        <td>${p.estado}</td>
                    </tr>
                `;
                tbody.innerHTML += fila;
            });
        }
    }catch (error) {
        // Maneja cualquier error que ocurra durante la solicitud
        console.error('🚨 Error al cargar los préstamos activos:', error);
        alert(`Ocurrió un error: ${error.message}`);
    }
}
document.getElementById('BusquedaActivos').addEventListener('submit', async (event)=>{
    event.preventDefault();

    const termino = document.getElementById('busquedaAct').value.trim();
    if (termino === '') {
        cargarTablaActivos(); // Si el término está vacío, recarga la tabla completa
        return;
    }
    try {
        const response = await fetch(`/SistemaBiblioteca/index.php?action=buscarActivos&q=${encodeURIComponent(termino)}`);
        if (!response.ok) {
            throw new Error('Error al buscar préstamos activos');
        }
        const resultados = await response.json();

        const tbody = document.querySelector('#tablaLibroPres tbody');
        tbody.innerHTML = ''; // Limpia la tabla antes de insertar nuevos resultados
        if (resultados.length === 0) {
            // Si no se encontraron resultados, muestra un mensaje
            tbody.innerHTML = '<tr><td colspan="7">No se encontraron resultados</td></tr>';
        } else {
            // Si hay resultados, los agrega a la tabla
            resultados.forEach(p => {
                const fila = `
                    <tr>
                        <td>${p.id_prestamo}</td>
                        <td>${p.cedula_usuario}</td>
                        <td>${p.titulo_libro}</td>
                        <td>${p.fecha_solicitud}</td>
                        <td>${p.fecha_inicio}</td>
                        <td>${p.fecha_fin}</td>
                        <td>${p.estado}</td>
                    </tr>
                `;
                tbody.innerHTML += fila;
            });
        }
    } catch (error) {
        console.error('🚨 Error al buscar préstamos activos:', error);
        alert(`Ocurrió un error: ${error.message}`);
    }
})

document.getElementById('BusquedaInactivos').addEventListener('submit', async (event)=>{
    event.preventDefault();

    const termino = document.getElementById('busquedaInac').value.trim();
    if (termino === '') {
        cargarTablaInactivos(); // Si el término está vacío, recarga la tabla completa
        return;
    }
    try {
        const response = await fetch(`/SistemaBiblioteca/index.php?action=buscarInactivos&q=${encodeURIComponent(termino)}`);
        if (!response.ok) {
            throw new Error('Error al buscar préstamos inactivos');
        }
        const resultados = await response.json();

        const tbody = document.querySelector('#tablaLibroPres2 tbody');
        tbody.innerHTML = ''; // Limpia la tabla antes de insertar nuevos resultados
        if (resultados.length === 0) {
            // Si no se encontraron resultados, muestra un mensaje
            tbody.innerHTML = '<tr><td colspan="7">No se encontraron resultados</td></tr>';
        } else {
            // Si hay resultados, los agrega a la tabla
            resultados.forEach(p => {
                const fila = `
                    <tr>
                        <td>${p.id_prestamo}</td>
                        <td>${p.cedula_usuario}</td>
                        <td>${p.titulo_libro}</td>
                        <td>${p.fecha_solicitud}</td>
                        <td>${p.fecha_inicio}</td>
                        <td>${p.fecha_fin}</td>
                        <td>${p.estado}</td>
                    </tr>
                `;
                tbody.innerHTML += fila;
            });
        }
    } catch (error) {
        console.error('🚨 Error al buscar préstamos inactivos:', error);
        alert(`Ocurrió un error: ${error.message}`);
    }
})