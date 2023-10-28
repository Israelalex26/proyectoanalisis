<?php
// Conexión a la base de datos (incluye tu archivo de conexión)
include('conexion.php');

if ($conn) {
    // Recibe los datos del formulario
    $cod_empleado = $_POST["cod_empleado"];
    $hora_entrada = $_POST["hora_entrada"];
    $fecha = $_POST["fecha"];

     $alterAsistenciaSql = "ALTER TABLE asistencia MODIFY COLUMN id_asistencia INT AUTO_INCREMENT";
     
     if ($conn->query($alterAsistenciaSql) !== TRUE) {
         echo "Error al modificar la tabla usuarios: " . $conn->error;
         
        }
  

    // Realiza la inserción en la tabla "asistencia"
    $sql = "INSERT INTO asistencia (fk_cod_empleado, hora_entrada, fecha) VALUES ('$cod_empleado', '$hora_entrada', '$fecha')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("La hora entra se guardo correctamente. ¡Bienvenido de nuevo!"); window.location.href = "http://nominasolidarista.wuaze.com/inicio_trabajador.php";</script>';

    } else {
        echo "Error al guardar la asistencia: " . $conn->error;
    }

    // Cierra la conexión a la base de datos
    $conn->close();
} else {
    echo "No se pudo establecer conexión a la base de datos.";
}
?>
