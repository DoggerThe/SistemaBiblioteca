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
                    <td>${libro.titulo}</td>
                    <td>${libro.autor}</td>
                    <td>${libro.genero}</td>
                    <td>${libro.editorial}</td>
                    <td>${libro.total_cantidad}</td>
                `;
                tbody.appendChild(tr);
            });
        }
    });
});
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
        console.error('🚨 Error al buscar:', error);
    }
});
