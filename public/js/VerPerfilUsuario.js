document.addEventListener("DOMContentLoaded", function () {
    fetch('/SistemaBiblioteca/public/action.php?action=verPerfilUsuario', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            usuario_id: idUsuario
        })
    })
    .then(res => res.json())
    .then(usuario => {
        if (!usuario || usuario.error) {
            console.error('Error al obtener datos del usuario.');
            return;
        }

        document.getElementById("nombres").value = usuario.nombre;
        document.getElementById("apellidos").value = usuario.apellido;
        document.getElementById("cedula").value = usuario.cedula;
        document.getElementById("correo").value = usuario.email;
        document.getElementById("direccion").value = usuario.direccion;
    })
    .catch(error => {
        console.error("Error en la solicitud:", error);
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const btnCambiar = document.querySelector(".change-password-btn");
    const modal = document.getElementById("modal");
  
    if (btnCambiar && modal) {
      btnCambiar.addEventListener("click", function () {
        modal.style.display = "block";
      });
    } else {
      console.error("No se encontró el botón o el modal");
    }
});

function cerrarModal() {
    document.getElementById("modal").style.display = "none";
}

function confirmarCambio() {
    const antigua = document.getElementById("ContrasenaAntigua").value.trim();
    const nueva = document.getElementById("ContrasenaNueva").value.trim();
    const nuevaConf = document.getElementById("ContrasenaNuevaConfir").value.trim();

    if (!antigua || !nueva || !nuevaConf) {
        alert("Todos los campos son obligatorios.");
        return;
    }

    if (nueva !== nuevaConf) {
        alert("Las contraseñas nuevas no coinciden.");
        return;
    }

    if (nueva.length < 6) {
        alert("La nueva contraseña debe tener al menos 6 caracteres.");
        return;
    }

    // Enviar la petición (fetch o AJAX)
    fetch("/SistemaBiblioteca/public/action.php?action=cambiarPassword", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            usuario_id: idUsuario,
            antigua: antigua,
            nueva: nueva
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert("Contraseña actualizada con éxito.");
            cerrarModal();
        } else {
            alert(data.message || "No se pudo cambiar la contraseña.");
        }
    })
    .catch(err => {
        console.error(err);
        alert("Error en la conexión.");
    });
}


/*
// Obtener botones
const editBtn = document.querySelector('.edit-profile-btn');
const changePassBtn = document.querySelector('.change-password-btn');
const saveBtn = document.querySelector('.save-profile-btn');
const cancelBtn = document.querySelector('.cancel-profile-btn');

// Obtener todos los campos de entrada
const inputs = document.querySelectorAll('.field-input');

// Guardar los valores originales para restaurar si se cancela
const originalValues = {};

inputs.forEach(input => {
    originalValues[input.id] = input.value;
});

editBtn.addEventListener('click', () => {
    // Habilitar inputs
    inputs.forEach(input => {
        input.removeAttribute('readonly');
        input.classList.add('editing');
    });

    // Mostrar botones de acción
    saveBtn.classList.remove('hidden');
    cancelBtn.classList.remove('hidden');

    // Ocultar botones principales
    editBtn.classList.add('hidden');
    changePassBtn.classList.add('hidden');
});

saveBtn.addEventListener('click', (e) => {
    e.preventDefault();

    // Deshabilitar inputs y guardar valores actuales como "default"
    inputs.forEach(input => {
        input.setAttribute('readonly', true);
        input.classList.remove('editing');
        originalValues[input.id] = input.value;
    });

    // Alternar visibilidad de botones
    saveBtn.classList.add('hidden');
    cancelBtn.classList.add('hidden');
    editBtn.classList.remove('hidden');
    changePassBtn.classList.remove('hidden');

    // Aquí podrías enviar los datos modificados al servidor con fetch o AJAX si lo deseas
});

cancelBtn.addEventListener('click', () => {
    // Restaurar valores originales
    inputs.forEach(input => {
        input.value = originalValues[input.id];
        input.setAttribute('readonly', true);
        input.classList.remove('editing');
    });

    // Alternar visibilidad de botones
    saveBtn.classList.add('hidden');
    cancelBtn.classList.add('hidden');
    editBtn.classList.remove('hidden');
    changePassBtn.classList.remove('hidden');
});
Este codigo puede ser util para cuando toque cambiar los datos pero de momento no es necesario
*/