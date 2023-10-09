<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "id21355203_nomina";

// Establece la conexión a la base de datos
$conn = new mysqli($server, $user, $pass, $db);

// Verifica si hay errores en la conexión
if ($conn->connect_error) {
  die("Conexion Fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["nombre"])) {
  $nombreDepartamento = $_GET["nombre"];

  // Elimina el departamento con el nombre especificado
  $sql = "DELETE FROM departamento WHERE departamento = '$nombreDepartamento'";

  if ($conn->query($sql) === TRUE) {
    echo '<script>alert("Departamento eliminado con éxito."); window.location.href = "http://localhost/proyectoanalisis/departamento.php";</script>';

  } else {
    echo '<script>alert("Error al eliminar el departamento."); window.location.href = "http://localhost/proyectoanalisis/departamento.php";</script>';
  }
}

$conn->close();
?>
