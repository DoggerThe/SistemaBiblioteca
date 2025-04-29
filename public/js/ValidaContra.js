function mostrarContrasena(id) {
    var input = document.getElementById(id);
    if (input.type === "password") {
        input.type = "text";
    } else {
        input.type = "password";
    }
}

function validarContrasenas() {
    var contrasena = document.getElementById('contrasena').value;
    var confirmarContrasena = document.getElementById('confirmar').value;  // Cambié 'confirmarcontraseña' por 'confirmar'

    if (contrasena !== confirmarContrasena) {
        alert('Las contraseñas no coinciden. Por favor, verifique e intente de nuevo.');
        return false; // Evita el envío del formulario
    }
    return true; // Permite el envío del formulario
}
