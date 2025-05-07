function mostrarContrasena(id) {
    var input = document.getElementById(id);
    if (input.type === "password") {
        input.type = "text";
    } else {
        input.type = "password";
    }
}
//
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('loginForm');

    if (form) {
        form.addEventListener('submit', async function (e) {
            e.preventDefault();

            const formData = new FormData(form);
            formData.append('action', 'login');

            const response = await fetch('/SistemaBiblioteca/public/action.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                window.location.href = result.redirect;
            } else {
                document.getElementById('mensaje-error').innerText = result.message;
            }
        });
    }
});
//

function validarContrasenas() {
    var contrasena = document.getElementById('contrasena').value;
    var confirmarContrasena = document.getElementById('confirmar').value;  // Cambié 'confirmarcontraseña' por 'confirmar'

    if (contrasena !== confirmarContrasena) {
        alert('Las contraseñas no coinciden. Por favor, verifique e intente de nuevo.');
        return false; // Evita el envío del formulario
    }
    alert('Las contraseñas coinciden. Por favor, verifique e intente de nuevo.');
    return true; // Permite el envío del formulario
}

