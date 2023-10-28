<?php
include('conexion.php');

if ($conn){

include('verificarloggin.php');


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
  $idhora = $_GET["id"];

  // Elimina el departamento con el nombre especificado
  $sql = "DELETE FROM horaextra WHERE id_horaextra = '$idhora'";

  if ($conn->query($sql) === TRUE) {
    echo '<script>alert("horas eliminadas con éxito."); window.location.href = "http://nominasolidarista.wuaze.com/extra.php";</script>';

  } else {
    echo '<script>alert("Error al eliminar las horas."); window.location.href = "http://nominasolidarista.wuaze.com/extra.php";</script>';
  }
}
}else{
  echo "No se pudo establecer conexión a la base de datos.";

}
?>
