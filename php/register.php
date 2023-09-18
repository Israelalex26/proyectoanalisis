<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "nomina";

// Crear una conexión
$conn = new mysqli($server, $user, $pass, $db);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo_electronico = $_POST["correo_electronico"];
    $contrasena = $_POST["contrasena"];
    $rol = $_POST["rol"];
    $nombre_usuario = $_POST["nombre_usuario"];

    // Hash de la contraseña (para mayor seguridad)
    $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

    // Consulta SQL para insertar el usuario en la tabla
    $sql = "INSERT INTO users (correo_electronico, contrasena, rol, nombre_usuario) VALUES (?, ?, ?, ?)";

    // Preparar la consulta
    $stmt = $conn->prepare($sql);
    
    // Vincular los parámetros
    $stmt->bind_param("ssss", $correo_electronico, $hashed_password, $rol, $nombre_usuario);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Usuario registrado correctamente.";
    } else {
        echo "Error al registrar el usuario: " . $stmt->error;
    }

    // Cerrar la conexión
    $stmt->close();
}

// Cerrar la conexión a la base de datos
$conn->close();



?>