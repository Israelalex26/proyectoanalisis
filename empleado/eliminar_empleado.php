<?php
include('conexion.php');

if ($conn){

include('verificarloggin.php');


  if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["cod_empleado"])) {
    $cod_empleado = $_GET["cod_empleado"];
  
    // Elimina el empleado con el código especificado
    $sql = "DELETE FROM empleados WHERE cod_empleado = $cod_empleado";
  
    if ($conn->query($sql) === TRUE) {
      echo '<script>alert("Empleado eliminado con éxito."); window.location.href = "/proyectoanalisis/inicio.php";</script>';
  
    } else {
      echo "Error al eliminar el empleado: " . $conn->error;
      echo '<script>alert("Error al eliminar el empleado."); window.location.href = "/proyectoanalisis/inicio.php";</script>';
  
    }
  }

}

?>
