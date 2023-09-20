<?php
session_start();

$server = "localhost";
$user = "root";
$pass = "";
$db = "nomina";

$conexion = new mysqli($server, $user, $pass, $db);

if ($conexion->connect_error){
    die("Conexion Fallida: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo_electronico = $_POST["correo_electronico"];
    $contrasena = $_POST["contrasena"];

    // Aquí estamos realizando la consulta a la DB para verificar las credenciales.
    $sql = "SELECT * FROM users WHERE correo_electronico = '$correo_electronico' AND contrasena = '$contrasena'";
    $result = $conexion->query($sql);

    if ($result->num_rows == 1) {
        // Las credenciales son válidas, inicia sesión y redirige al usuario a la página de inicio.
        $_SESSION["correo_electronico"] = $correo_electronico;
        header("Location: inicio.php"); // Cambia "inicio.php" por la URL de la página a la que deseas redirigir.
    } else {
        // Las credenciales son inválidas, muestra un mensaje de error.
        echo '<script>alert("Credenciales incorrectas. Intente nuevamente.");</script>';

    }
}

$conexion->close();

?>
