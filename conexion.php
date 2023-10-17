<?php
$servername = "sql113.infinityfree.com";  // Por lo general, "localhost" en InfinityFree
$port = "3306";
$username = "if0_35236724";
$password = "zldJ0dWH4gEdB8";
$dbname = "if0_35236724_nomina";

// Crear una conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión a la base de datos ha fallado: " . $conn->connect_error);
}
?>
