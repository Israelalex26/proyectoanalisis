<?php
include('conexion.php');

if ($conn){

  if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $expedienteId = $_GET["id"];
  
    // Elimina el usuario con el ID especificado
    $sql = "DELETE FROM expediente WHERE id_expediente = $expedienteId";
  
    if ($conn->query($sql) === TRUE) {
      echo '<script>alert("Expediente eliminado con exito."); window.location.href = "/proyectoanalisis/inicio.php";</script>';
  
    } else {
      echo "Error al eliminar el usuario: " . $conn->error;
      echo '<script>alert("Error al eliminar el expediente."); window.location.href = "/proyectoanalisis/inicio.php";</script>';
  
    }
  }

}

?>