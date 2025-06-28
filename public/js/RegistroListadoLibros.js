document.addEventListener("DOMContentLoaded", function(){
    fetch('/SistemaBiblioteca/index.php?action=listarLibrosAdmin')
    .then(res => res.json())
    .then(data =>{
        const tbody = document.querySelector("#tablaLibros tbody");
        tbody.innerHTML="";

        if (data.length === 0){
            const tr = document.createElement("tr");
            tr.innerHTML = `<td colspan="5" class="text-center">No hay libros para mostrar.</td>`;
            tbody.appendChild(tr);
            return;
        }
        else{
            data.forEach(libro => {
                const tr = document.createElement("tr");
                tr.innerHTML = `
                    <td>${libro.isbn}</td>
                    <td>${libro.titulo}</td>
                    <td>${libro.autor}</td>
                    <td>${libro.genero}</td>
                    <td>${libro.editorial}</td>
                    <td>${libro.total_cantidad}</td>
                    <td></td>
                `;
                const celdaAcciones = tr.querySelector("td:last-child");
                const boton = document.createElement("button");
                boton.textContent = "Ver detalles";
                boton.className = "btn";
                boton.onclick = function(){
                    abrirModal(libro);
                };
                celdaAcciones.appendChild(boton);

                tbody.appendChild(tr);
            });
        }
    });
});
function abrirModal(libro){
    const modal = document.getElementById("modal");
    document.getElementById("ISBN_M").value = libro.isbn;
    document.getElementById("Titulo_M").value = libro.titulo;
    document.getElementById("Autor_M").value = libro.autor;
    document.getElementById("Genero_M").value = libro.genero;
    document.getElementById("Editorial_M").value = libro.editorial;
    document.getElementById("Cantidad_M").value = libro.total_cantidad;

    modal.style.display = "block";

}
function cerrarModal() {
    document.getElementById("modal").style.display = "none";
}
async function confirmarCambio(){
    const Data = new URLSearchParams();
    Data.append("action", "cambiarDatosLibroAdmin");
    Data.append("isbn", document.getElementById("ISBN_M").value );
    Data.append("titulo", document.getElementById("Titulo_M").value );
    Data.append("autor", document.getElementById("Autor_M").value );
    Data.append("genero", document.getElementById("Genero_M").value );
    Data.append("editorial", document.getElementById("Editorial_M").value );
    Data.append("cantidad", document.getElementById("Cantidad_M").value );
    try{
        const response = await fetch('/SistemaBiblioteca/index.php',{
            method: 'POST',
            headers:{
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: Data
        })
        const resol = await response.json();
        if (resol){
            alert ("Actualizado correctamente.")
        }
        else{
            alert ("No se pudo actualizar.")
        }
        cerrarModal();
        location.reload();
    }catch(error){
        console.error('Error al actualizar: ',error)
    }
}


document.getElementById('FormularioInscripcion').addEventListener('submit', async(event)=>{
    event.preventDefault();
    const isbn = document.getElementById("isbn").value || null;
    const titulo = document.getElementById("titulo").value || null;
    const genero = document.getElementById("genero").value || null;
    const cantidad = document.getElementById("cantidad").value || null;
    const autor = document.getElementById("autor").value || null;
    const editorial = document.getElementById("editorial").value || null;

    if (!isbn || !titulo || !genero || !cantidad || !autor || !editorial){
        alert ("Falta por rellenar algun campo");
        return;
    }

    const datos = new URLSearchParams();
    datos.append("rol", Rol);
    datos.append("isbn", isbn);
    datos.append("titulo", titulo);
    datos.append("genero", genero);
    datos.append("cantidad", cantidad);
    datos.append("autor", autor);
    datos.append("editorial", editorial);

    fetch('/SistemaBiblioteca/index.php?action=registrarLibros',{
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: datos.toString()
    })
    .then(res => res.json())
    .then(data => {
        if (data){
            alert("Registrado de forma exitosa.");
            location.reload();
        }else{
            alert("No se pudo registrar.");
        }
    })
    .catch(error =>{
        console.error("Error al tratar de registrar:", error)
    })
});
document.getElementById('form-busqueda').addEventListener('submit', async(event)=>{
    event.preventDefault();
    const termino = document.getElementById('busqueda').value.trim();
    try{
        const response = await fetch(`/SistemaBiblioteca/index.php?action=buscarLibrosAdmin&q=${encodeURIComponent(termino)}`);
        if (!response.ok){
            throw new Error ('Error en la busqueda');
        }
        const resultados = await response.json();
        const tbody = document.querySelector('#tablaLibros tbody');
        tbody.innerHTML = '';
        if (resultados.length === 0){
            const tr = document.createElement("tr");
            tr.innerHTML = `<td colspan="5" class="text-center">No hay libros para mostrar.</td>`;
            tbody.appendChild(tr);
            return;
        } else{
            resultados.forEach(libro =>{
                const tr = document.createElement("tr");
                tr.innerHTML = `
                    <td>${libro.titulo}</td>
                    <td>${libro.autor}</td>
                    <td>${libro.genero}</td>
                    <td>${libro.editorial}</td>
                    <td>${libro.total_cantidad}</td>
                `;
                tbody.appendChild(tr);
            })
        }
    }catch(error){
        console.error('Error al buscar:', error);
    }
});
document.getElementById('isbn').addEventListener('blur', async (event) => {
    const isbnValor = event.target.value.trim();
    if (!isbnValor) return; // Salir si está vacío

    const campos = {
        titulo: document.getElementById('titulo'),
        genero: document.getElementById('genero'),
        cantidad: document.getElementById('cantidad'),
        autor: document.getElementById('autor'),
        editorial: document.getElementById('editorial')
    };

    try {
        const response = await fetch(`/SistemaBiblioteca/index.php?action=rellenoExistBibli&q=${encodeURIComponent(isbnValor)}`);
        
        // Verifica si la respuesta es OK (status 200-299)
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const resultado = await response.json();

        // Verifica si resultado es un objeto con datos
        if (resultado && typeof resultado === 'object') {
            Object.keys(campos).forEach(key => {
                if (resultado[key] !== undefined) {
                    campos[key].value = resultado[key];
                    campos[key].disabled = true;
                }
            });
            campos.cantidad.disabled = false; // Cantidad siempre editable
        } else {
            // Habilitar todos si no hay resultados
            Object.values(campos).forEach(campo => campo.disabled = false);
        }
        
    } catch(error) {
        console.error('Error en la búsqueda:', error);
        // Opcional: Mostrar mensaje al usuario
        alert('Error al buscar el ISBN. Por favor intente nuevamente.');
    }
});
