/*
 * Función para mostrar u ocultar la contraseña
 * Cambia el tipo del input de 'password' a 'text' y viceversa
 */
function mostrarContrasena(id) {
    var input = document.getElementById(id);
    if (input.type === "password") {
        input.type = "text";
    } else {
        input.type = "password";
    }
}
/*
 * Espera a que el contenido del documento se haya cargado completamente
 * y luego añade un manejador al formulario de inicio de sesión
 */
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('loginForm');

    if (form) {
        // Escucha el evento de envío del formulario
        form.addEventListener('submit', async function (e) {
            e.preventDefault();
            // Crea un objeto FormData para enviar los datos del formulario al servidor
            const formData = new FormData(form);
            formData.append('action', 'login');// Indica que la acción es iniciar sesión

            const response = await fetch('/SistemaBiblioteca/public/action.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();
            // Si el inicio de sesión fue exitoso, redirige al usuario a la página indicada
            if (result.success) {
                window.location.href = result.redirect;
            } else {
                // Si hubo un error, muestra el mensaje devuelto por el servidor
                document.getElementById('mensaje-error').innerText = result.message;
            }
        });
    }
});
/*
 * Función de validación para asegurarse de que las contraseñas coincidan
 * (Usada principalmente en el formulario de registro)
*/

function validarContrasenas() {
    var contrasena = document.getElementById('contrasena').value;
    var confirmarContrasena = document.getElementById('confirmar').value;  // Cambié 'confirmarcontraseña' por 'confirmar'

    if (contrasena !== confirmarContrasena) {
        alert('Las contraseñas no coinciden. Por favor, verifique e intente de nuevo.');
        return false; // Evita el envío del formulario
    }
    return true; // Permite el envío del formulario
}

