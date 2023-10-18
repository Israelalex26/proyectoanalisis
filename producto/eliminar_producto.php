<?php
// Incluye el archivo de conexión
include('conexion.php');

if ($conn){

// Obtiene el ID del departamento a eliminar
$departamento_id = $_GET['id']; // Asegúrate de validar y sanear esta entrada para evitar SQL Injection

// Prepara la consulta SQL para eliminar el departamento
$sql = "DELETE FROM departamentos WHERE id = $departamento_id";

if ($conn->query($sql) === TRUE) {
    echo '<script>alert("Producto eliminado con éxito."); window.location.href = "/proyectoanalisis/producto.php";</script>';

} else {
    echo '<script>alert("Error al eliminar el producto."); window.location.href = "/proyectoanalisis/producto.php";</script>';

}

}else{
    echo "No se pudo establecer conexión a la base de datos.";

}
?>
