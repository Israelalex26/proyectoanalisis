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

// Recuperar datos del formulario
$correo_electronico = $_POST['correo_electronico'];
$nombre_usuario = $_POST['nombre_usuario'];
$contrasena = $_POST['contrasena'];

// Modificar la estructura de la tabla para hacer que "id_users" sea autoincremental
$alterTableSql = "ALTER TABLE users MODIFY COLUMN id_user INT AUTO_INCREMENT";

if ($conn->query($alterTableSql) === TRUE) {
    // Ahora, la columna "id_users" está configurada como autoincremental

    // Insertar datos en la tabla "users" sin especificar un valor para "id_users"
    $sql = "INSERT INTO users (correo_electronico, nombre_usuario, contrasena, rol) VALUES ('$correo_electronico', '$nombre_usuario', '$contrasena', 'pendiente')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Registro existoso, Espere un momento."); window.location.href = "http://localhost/proyectoanalisis/index.html";</script>';

    } else {
        echo '<script>alert("Error al registrar usuario:"); window.location.href = "http://localhost/proyectoanalisis/register.html";</script>';
    }
} else {
    echo '<script>alert("Error al modificar la tabla:"); window.location.href = "http://localhost/proyectoanalisis/register.html";</script>';
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
