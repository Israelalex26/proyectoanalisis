<?php
include('conexion.php');

if ($conn){

include('verificarloggin.php');


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["nombre"])) {
  $nombreDepartamento = $_GET["nombre"];

  // Elimina el departamento con el nombre especificado
  $sql = "DELETE FROM departamento WHERE departamento = '$nombreDepartamento'";

  if ($conn->query($sql) === TRUE) {
    echo '<script>alert("Departamento eliminado con éxito."); window.location.href = "/proyectoanalisis/departamento.php";</script>';

  } else {
    echo '<script>alert("Error al eliminar el departamento."); window.location.href = "/proyectoanalisis/departamento.php";</script>';
  }
}
}else{
  echo "No se pudo establecer conexión a la base de datos.";

}
?>
