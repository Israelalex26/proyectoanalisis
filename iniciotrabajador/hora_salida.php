<?php
// Conexión a la base de datos (incluye tu archivo de conexión)
include('conexion.php');

if ($conn) {
    // Recibe los datos del formulario
    $id_asistencia = $_POST["id_asistencia"];
    $nuevaHoraSalida = $_POST["hora_salida"];

    // Actualiza la hora de salida en la tabla "asistencia"
    $sql = "UPDATE asistencia SET hora_salida = '$nuevaHoraSalida' WHERE id_asistencia = $id_asistencia";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Se registro su hora de salida, ¡feliz viaje!."); window.location.href = "http://nominasolidarista.wuaze.com/inicio_trabajador.php";</script>';
    } else {
        echo "Error al actualizar la hora de salida: " . $conn->error;
    }

    // Cierra la conexión a la base de datos
    $conn->close();
} else {
    echo "No se pudo establecer conexión a la base de datos.";
}
?>
