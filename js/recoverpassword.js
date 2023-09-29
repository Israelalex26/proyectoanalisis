function recoverpassword(){

    var emailtv = document.getElementById('correo_electronico').value;

    if (!validateEmail(emailtv)) {
        //Validar si el email es correcto
        alert('Por favor, ingresa un correo electrónico válido.');
        return;
    } 
}

function irAIncex() {
    window.location.href = "index.html";
}

function validateEmail(emailtv) {
    // Validación básica de correo electrónico
    // Puedes implementar una validación más detallada si lo deseas
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(emailtv);
}