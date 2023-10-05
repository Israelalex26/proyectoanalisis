<?php
$servername = "localhost";
$username = "root"; // Reemplaza con tu nombre de usuario de la base de datos
$password = ""; // Reemplaza con tu contraseña de la base de datos
$dbname = "nomina"; // Reemplaza con el nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos enviados desde la solicitud AJAX
$idEmpleado = $_POST['id'];
$newRol = $_POST['rol'];
$newCorreo = $_POST['correo'];
$newUsuario = $_POST['usuario'];

// Realizar la actualización en la base de datos
$sql = "UPDATE tu_tabla SET rol = '$newRol', correo_electronico = '$newCorreo', nombre_usuario = '$newUsuario' WHERE id_usuario = $idEmpleado";

// Ejecutar la consulta y verificar si fue exitosa
if ($conn->query($sql) === TRUE) {
    echo "Registro actualizado exitosamente";
} else {
    echo "Error al actualizar el registro: " . $conn->error;
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
