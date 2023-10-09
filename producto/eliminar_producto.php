<?php
// Establece la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "id21355203_nomina";

$conn = new mysqli($servername, $username, $password, $database);

// Verifica la conexión
if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}

// Obtiene el ID del departamento a eliminar
$departamento_id = $_GET['id']; // Asegúrate de validar y sanear esta entrada para evitar SQL Injection

// Prepara la consulta SQL para eliminar el departamento
$sql = "DELETE FROM departamentos WHERE id = $departamento_id";

if ($conn->query($sql) === TRUE) {
    echo '<script>alert("Producto eliminado con éxito."); window.location.href = "http://localhost/proyectoanalisis/producto.php";</script>';

} else {
    echo '<script>alert("Error al eliminar el producto."); window.location.href = "http://localhost/proyectoanalisis/producto.php";</script>';

}

// Cierra la conexión a la base de datos
$conn->close();
?>
