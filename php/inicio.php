<?php
session_start(); // Inicia la sesión para manejar variables de sesión

$server = "localhost";
$user = "root";
$pass = "";
$db = "prueba";

// Establece la conexión a la base de datos
$conexion = new mysqli($server, $user, $pass, $db);

// Verifica si hay errores en la conexión
if ($conexion->connect_error){
    die("Conexion Fallida: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["cerrar_sesion"])) {
        // Cerrar sesión
        session_destroy(); // Destruye la sesión actual
        echo '<script>alert("Cerró sesión exitosamente."); window.location.href = "http://localhost/recuperarcontrasena/index.html";</script>';
        exit(); // Termina la ejecución del script
    } else {
        // Si no es una solicitud para cerrar sesión, intenta autenticar al usuario
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

        if ($stmt->num_rows == 1) {
            // Las credenciales son válidas
            $stmt->bind_result($correo_electronico, $rol);
            $stmt->fetch();

            // Almacenar el correo electrónico del usuario en una sesión
            $_SESSION["correo_electronico"] = $correo_electronico;

            // Resto del código según el rol
            if ($rol == "admin") {
                echo '<script>window.location.href = "http://localhost/recuperarcontrasena/inicio.html";</script>';
            } elseif ($rol == "trabajador") {
                echo '<script>window.location.href = "http://localhost/recuperarcontrasena/iniciotrabajador.html";</script>';
            } elseif ($rol == "pendiente") {
                echo '<script>alert("Este usuario no está autorizado, espere un momento."); window.location.href = "http://localhost/recuperarcontrasena/index.html";</script>';
            }
        } else {
            // Las credenciales son inválidas
            echo '<script>alert("Credenciales incorrectas. Intente nuevamente."); window.location.href = "http://localhost/recuperarcontrasena/index.html";</script>';
        }

        $stmt->close();
    }
}

$conexion->close(); // Cierra la conexión a la base de datos
?>
