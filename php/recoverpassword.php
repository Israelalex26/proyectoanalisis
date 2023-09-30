<?php
// Conexión a la base de datos
$server = "localhost";
$user = "root";
$pass = "";
$db = "prueba";

// Establece la conexión a la base de datos
$conexion = new mysqli($server, $user, $pass, $db);

// Verifica si hay errores en la conexión
if ($conexion->connect_errno){
    die("Conexion Fallida". $conexion->connect_errno);
}

if (isset($_POST['correo_electronico'])) {
    $correo_electronico = $_POST['correo_electronico'];
    
    // Verificar si el correo electrónico existe en la base de datos
    $consulta = "SELECT * FROM users WHERE correo_electronico = '$correo_electronico'";
    $resultado = $conexion->query($consulta);

    if ($resultado->num_rows > 0) {
        // Si el correo electrónico existe en la base de datos

        // Generar un token único
        $token = uniqid();

        // Guardar el token en la base de datos para este usuario (puedes crear una tabla para tokens)
        $insertar_token = "INSERT INTO tokens (usuario_id, token) VALUES ('$usuario_id', '$token')";
        $conexion->query($insertar_token);

        // Envía un correo electrónico al usuario con un enlace a changepassword.html que incluya el token
        $link = "/recuperarcontrasena/changepassword.html?token=$token";
        $mensaje = "Haga clic en el siguiente enlace para cambiar su contraseña: $link";
        mail($correo_electronico, "Recuperación de contraseña", $mensaje);

        // Redirecciona al usuario a una página de changepassword
        echo '<script>window.location.href = "http://localhost/recuperarcontrasena/changepassword.html";</script>';

    } else {
        // El correo electrónico no existe en la base de datos
        echo '<script>alert("El correo electrónico no está registrado."); window.location.href = "http://localhost/recuperarcontrasena/recoverpassword.html";</script>';
    }
}
?>
