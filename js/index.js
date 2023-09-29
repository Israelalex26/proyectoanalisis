function login(){

    var emailtv = document.getElementById('correo_electronico').value;
    var passwordtv = document.getElementById('contrasena').value;

    if (!validateEmail(emailtv)) {
        //Validar si el email es correcto
        alert('Por favor, ingresa un correo electrónico válido.');
        return;
    } else if (passwordtv.trim() === '') {
        //validar que el password no este vacio 
        alert('Por favor, ingresa una contraseña.');
        return;
    } else  if(passwordtv.length < 7){
        //verificar que el password tenga como minimo 7 caracteres
        alert('La contraseña por lo menos debe de tener 7 caracteres');
        return;
    } else if(passwordtv.length >16){
        alert('La contraseña debe de tener un máximo de 16 caracteres');
        return;
    } 
}


function validateEmail(emailtv) {
    // Validación básica de correo electrónico
    // Puedes implementar una validación más detallada si lo deseas
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(emailtv);
}