<?php
session_start();

$server = "localhost";
$user = "root";
$pass = "";
$db = "nomina";

// Establece la conexión a la base de datos
$conexion = new mysqli($server, $user, $pass, $db);

// Verifica si hay errores en la conexión
if ($conexion->connect_error){
    die("Conexion Fallida: " . $conexion->connect_error);
}

// Verifica si la solicitud es de tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo_electronico = $_POST["correo_electronico"];
    $contrasena = $_POST["contrasena"];

    // Escapa caracteres especiales para prevenir SQL injection
    $correo_electronico = $conexion->real_escape_string($correo_electronico);
    $contrasena = $conexion->real_escape_string($contrasena);

    // Consulta preparada para prevenir SQL injection
    $stmt = $conexion->prepare("SELECT correo_electronico, rol FROM users WHERE correo_electronico = ? AND contrasena = ?");
    $stmt->bind_param("ss", $correo_electronico, $contrasena);
    $stmt->execute();
    $stmt->store_result();

    // Verifica si se encontró un resultado
    if ($stmt->num_rows == 1) {
        // Las credenciales son válidas
        $stmt->bind_result($correo_electronico, $rol);
        $stmt->fetch();

        // Redirige según el rol
        if ($rol == "admin") {
            echo '<script>window.location.href = "http://localhost/proyectoanalisis/inicio.html";</script>';
        } elseif ($rol == "trabajador") {
            echo '<script>window.location.href = "http://localhost/proyectoanalisis/iniciotrabajador.html";</script>';
        } elseif ($rol == "pendiente") {
            echo '<script>alert("Este usuario no está autorizado, espere un momento."); window.location.href = "http://localhost/proyectoanalisis/index.html";</script>';
        }
    } else {
        // Las credenciales son inválidas
        echo '<script>alert("Credenciales incorrectas. Intente nuevamente."); window.location.href = "http://localhost/proyectoanalisis/index.html";</script>';
    }

    $stmt->close();
}

$conexion->close();
?>
