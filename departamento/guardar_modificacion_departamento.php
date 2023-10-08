<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "id21355203_nomina";

// Crear una nueva conexión a la base de datos
$conn = new mysqli($server, $user, $pass, $db);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexion Fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombreDepartamento = $_POST["nombre_departamento"];
    $nuevoNombreDepartamento = $_POST["nombreDepartamento"];
    $nuevoPiso = $_POST["piso"];

    // Actualizar el departamento en la base de datos
    $sql = "UPDATE departamento SET departamento = '$nuevoNombreDepartamento', piso = '$nuevoPiso' WHERE departamento = '$nombreDepartamento'";

    if ($conn->query($sql) === TRUE) {
        // Redirigir de nuevo a la página de departamentos después de la actualización
        echo '<script>alert("Se actulaizo correctamente."); window.location.href = "http://localhost/proyectoanalisis/departamento.php";</script>';
        exit;
    } else {
        echo "Error al actualizar el departamento: " . $conn->error;
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
