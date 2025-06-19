// Espera a que el DOM esté completamente cargado para iniciar la solicitud de datos del perfil
document.addEventListener("DOMContentLoaded", function () {
    // Realiza una petición POST para obtener los datos del usuario
    fetch("/SistemaBiblioteca/index.php?action=verPerfilUsuario", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: `usuario_id=${encodeURIComponent(idUsuario)}`
    })
        .then((res) => res.json())
        .then((usuario) => {
            // Verifica si se obtuvo correctamente el objeto del usuario
            if (!usuario || usuario.error) {
                console.error("Error al obtener datos del usuario.");
                return;
            }

            // Rellena los campos del formulario con los datos del usuario
            document.getElementById("nombres").value = usuario.nombre;
            document.getElementById("apellidos").value = usuario.apellido;
            document.getElementById("cedula").value = usuario.cedula;
            document.getElementById("correo").value = usuario.email;
            document.getElementById("direccion").value = usuario.direccion;
        })
        .catch((error) => {
            // Maneja errores de conexión o del servidor
            console.error("Error en la solicitud:", error);
        });
});

// Evento para mostrar el modal de cambio de contraseña cuando se hace clic en el botón correspondiente
document.addEventListener("DOMContentLoaded", function () {
    const btnCambiar = document.querySelector(".change-password-btn");
    const modal = document.getElementById("modal");

    // Solo si existen los elementos en el DOM
    if (btnCambiar && modal) {
        btnCambiar.addEventListener("click", function () {
            modal.style.display = "block"; // Muestra el modal
        });
    } else {
        console.error("No se encontró el botón o el modal");
    }
});

// Función para cerrar el modal de cambio de contraseña
function cerrarModal() {
    document.getElementById("modal").style.display = "none";
}

// Función para validar y enviar el formulario de cambio de contraseña
function confirmarCambio() {
    const antigua = document.getElementById("ContrasenaAntigua").value.trim();
    const nueva = document.getElementById("ContrasenaNueva").value.trim();
    const nuevaConf = document
        .getElementById("ContrasenaNuevaConfir")
        .value.trim();
    // Validación de campos obligatorios
    if (!antigua || !nueva || !nuevaConf) {
        alert("Todos los campos son obligatorios.");
        return;
    }

    // Verifica que las nuevas contraseñas coincidan
    if (nueva !== nuevaConf) {
        alert("Las contraseñas nuevas no coinciden.");
        return;
    }

    // Requiere una contraseña de mínimo 6 caracteres
    if (nueva.length < 6) {
        alert("La nueva contraseña debe tener al menos 6 caracteres.");
        return;
    }

    // Envío de la solicitud para actualizar la contraseña
    fetch("/SistemaBiblioteca/index.php?action=cambiarPassword", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            usuario_id: idUsuario,
            antigua: antigua,
            nueva: nueva,
        }),
    })
        .then((res) => res.json())
        .then((data) => {
            if (data.success) {
                alert("Contraseña actualizada con éxito.");
                cerrarModal(); // Cierra el modal tras éxito
            } else {
                alert(data.message || "No se pudo cambiar la contraseña.");
            }
        })
        .catch((err) => {
            console.error(err.message);
            alert("Error en la conexión.");
        });
}