<?php
include('conexion.php');

if ($conn){

include('verificarloggin.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["nombre"])) {
  $nombreDepartamento = $_GET["nombre"];

  // Elimina el departamento con el nombre especificado
  $sql = "DELETE FROM empleado WHERE cod_empleado = '$nombreDepartamento'";

  if ($conn->query($sql) === TRUE) {
    echo '<script>alert("empledo eliminado con éxito."); window.location.href = "http://nominasolidarista.wuaze.com/empleado.php";</script>';

  } else {
    echo '<script>alert("Error al eliminar el empledo."); window.location.href = "http://nominasolidarista.wuaze.com/empleado.php";</script>';
  }
}
}else{
  echo "No se pudo establecer conexión a la base de datos.";

}
?>
