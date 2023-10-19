<?php
include('conexion.php');

if ($conn){

include('verificarloggin.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombreDepartamento = $_POST["nombre_departamento"];
    $nuevoNombreDepartamento = $_POST["nombreDepartamento"];
    $nuevoPiso = $_POST["piso"];

    // Actualizar el departamento en la base de datos
    $sql = "UPDATE departamento SET departamento = '$nuevoNombreDepartamento', piso = '$nuevoPiso' WHERE departamento = '$nombreDepartamento'";

    if ($conn->query($sql) === TRUE) {
        // Redirigir de nuevo a la página de departamentos después de la actualización
        echo '<script>alert("Se actulaizo correctamente."); window.location.href = "http://nominasolidarista.wuaze.com/departamento.php";</script>';
        exit;
    } else {
        echo "Error al actualizar el departamento: " . $conn->error;
    }
}

}else{
    echo "No se pudo establecer conexión a la base de datos.";

}
?>
