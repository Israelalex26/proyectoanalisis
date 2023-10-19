<?php
$servername = "localhost";  // Por lo general, "localhost" en InfinityFree
$port = "3306";
$username = "root";
$password = "";
$dbname = "id21355203_nomina";

// Crear una conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión a la base de datos ha fallado: " . $conn->connect_error);
}
?>
