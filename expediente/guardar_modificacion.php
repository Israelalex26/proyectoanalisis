<?php
include('conexion.php');

if ($conn){

   //verifica si ha iniciado session o no
   include('verificarloggin.php');


  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["expediente_id"])) {
    $expedienteId = $_POST["expediente_id"];
    $archivo_pdf = $_POST["archivo_pdf"];
  
     if (empty($archivo_pdf)){
      echo "Por favor, complete todos los campos.";
      exit();
  } else{
      $sql = "UPDATE expediente SET archivo_pdf='$archivo_pdf' WHERE id_expediente='$expedienteId'";
  
      if ($conn->query($sql) === TRUE) {
          echo '<script>alert("El expediente se actualizo correctamente."); window.location.href = "/proyectoanalisis/inicio.php";</script>';
      } else {
      echo '<div class="alert alert-danger" role="alert">Error al actualizar el expediente: ' . $conn->error . '</div>';
  
    }
    }
  
  }

}

?>
