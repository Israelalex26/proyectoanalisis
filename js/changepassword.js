function changePassword() {
    var passwordtv = document.getElementById('contrasena').value;
    var repitPasswordtv = document.getElementById('repit_password').value;

    // Verificar si la contraseña está vacía
    if (passwordtv.trim() === '') {
        alert('Por favor, ingresa una contraseña.');
        return;
    } 
    // Verificar si la contraseña tiene al menos 7 caracteres
    else if (passwordtv.length < 7) {
        alert('La contraseña debe tener al menos 7 caracteres.');
        return;
    } 
    // Verificar si la contraseña tiene más de 16 caracteres
    else if (passwordtv.length > 16) {
        alert('La contraseña debe tener un máximo de 16 caracteres.');
        return;
    } 
    // Verificar si las contraseñas coinciden
    else if (passwordtv.trim() !== repitPasswordtv) {
        alert('Las contraseñas no coinciden.');
        return;
    } 
}
