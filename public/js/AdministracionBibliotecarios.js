function mostrarContrasena(idCampo) {
    const input = document.getElementById(idCampo);
    if (input.type === "password") {
        input.type = "text";
    } else {
        input.type = "password";
    }
}