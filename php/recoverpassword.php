<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "nomina";

// Crear una conexión a la base de datos
$conn = new mysqli($server, $user, $pass, $db);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}


// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el correo electrónico proporcionado por el usuario
    $correo_electronico = $_POST["correo_electronico"];

    // Realizar una consulta para verificar si el correo electrónico existe en la base de datos
    // (Debes tener una conexión a la base de datos configurada previamente)
    $sql = "SELECT * FROM users WHERE correo_electronico = '$correo_electronico'";
    // Ejecutar la consulta y verificar si se encontró un resultado

    if ($conexion->query($sql)->num_rows == 1) {
        // Generar un token único y asociarlo al correo electrónico (esto es un ejemplo simplificado)
        $token = bin2hex(random_bytes(16));

        // Guardar el token en la base de datos junto con una marca de tiempo de expiración

        // Enviar un correo electrónico al usuario con un enlace que incluye el token
        $mensaje = "Haga clic en el siguiente enlace para restablecer su contraseña: ";
        $mensaje .= "<a href='resetpassword.php?token=$token'>Restablecer Contraseña</a>";

        mail($correo_electronico, "Recuperación de Contraseña", $mensaje);

        // Redirigir al usuario a una página de confirmación
        header("Location: confirmation.php");
        exit();
    } else {
        // El correo electrónico no existe en la base de datos, mostrar un mensaje de error
        echo "El correo electrónico no existe en nuestros registros.";
    }
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
