cargarBibliotecarios();
function mostrarContrasena(idCampo) {
    const input = document.getElementById(idCampo);
    if (input.type === "password") {
        input.type = "text";
    } else {
        input.type = "password";
    }
}
function compatibilidad(op1, op2){
    if (op1 === op2){
        return true;
    }
    return false;
}
document.getElementById("FormularioNuevoBiblio").addEventListener('submit', async(event)=>{
    event.preventDefault();
    const Nombre = document.getElementById("nombre").value.trim();
    const Apellido = document.getElementById("apellido").value.trim();
    const Cedula = document.getElementById("cedula").value.trim();
    const CorreoE = document.getElementById("email").value.trim();
    const Direccion = document.getElementById("direccion").value.trim();
    const Contra = document.getElementById("contrasena").value.trim();
    const ConfirmContra = document.getElementById("confirmar").value.trim();
    if (!compatibilidad(Contra,ConfirmContra)){
        alert ("Contraseñas diferentes por favor revisar.")
        return;
    }
    if (!Nombre || !Apellido || !Cedula || !CorreoE || !Direccion || !Contra){
        alert("Faltan campos por rellenar.")
        return;
    }
    if(parseInt(RolID) !== 3){
        window.location.href = "/SistemaBiblioteca/app/views/errors/404.php"
        return;
    }
    const Data = new URLSearchParams();
    Data.append("action", "registrar");
    Data.append("registrador", RolID)
    Data.append("nombre", Nombre);
    Data.append("apellido", Apellido);
    Data.append("cedula", Cedula);
    Data.append("email", CorreoE);
    Data.append("direccion", Direccion);
    Data.append("password", Contra);
    try{
        const response = await fetch('/SistemaBiblioteca/index.php',{
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: Data
        })
        const resultados =await response.json();
        if(resultados.success){
            alert (resultados.message)
        }else{
            alert (resultados.message)
        }
    }catch(error){
        console.error('Error en el registro.');
    };
})
async function cargarBibliotecarios(){
    const Data = new URLSearchParams();
    Data.append("action", "listaBibliotecarios");
    try{
        const response = await fetch('/SistemaBiblioteca/index.php',{
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: Data
        })
        const bibliotecarios = await response.json();
        const tbody = document.querySelector('#tablaBibliotecarios tbody');
        tbody.innerHTML = '';
        if (bibliotecarios.length === 0){
            tbody.innerHTML = '<tr><td colspan="5">No hay bibliotecarios registrados</td></tr>';
        }else{
            bibliotecarios.forEach(element => {
                const fila = `
                    <tr>
                        <td>${element.nombre}</td>
                        <td>${element.apellido}</td>
                        <td>${element.cedula}</td>
                        <td>${element.email}</td>
                        <td>${element.direccion}</td>
                    </tr>
                `;
                tbody.innerHTML += fila;
            });
        }
    }catch (error){
        console.error('Error al cargar los bibliotecarios:',error)
    }
}
document.getElementById("formBusquedaBiblio").addEventListener('submit', async(event)=>{
    event.preventDefault();
    const q = document.getElementById("busqueda").value.trim();
    if(q === ''){
        cargarBibliotecarios();
        return;
    }
    const Data = new URLSearchParams();
    Data.append("action", "busquedaBibliotecario");
    Data.append("busqueda", q);
    try{
        const response = await fetch('/SistemaBiblioteca/index.php',{
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: Data
        });
        const resultados = await response.json();
        const tbody = document.querySelector('#tablaBibliotecarios tbody');
        tbody.innerHTML = '';
        if (resultados.length === 0){
            tbody.innerHTML = '<tr><td colspan="5">No hay bibliotecarios registrados</td></tr>';
        }else{
            resultados.forEach(element => {
                const fila = `
                    <tr>
                        <td>${element.nombre}</td>
                        <td>${element.apellido}</td>
                        <td>${element.cedula}</td>
                        <td>${element.email}</td>
                        <td>${element.direccion}</td>
                    </tr>
                `;
                tbody.innerHTML += fila;
            });
        }
    }catch (error){
        console.error('Error al cargar los bibliotecarios:',error);
    }
})