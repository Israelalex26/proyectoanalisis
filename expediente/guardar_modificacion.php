<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "id21355203_nomina";

$conn = new mysqli($server, $user, $pass, $db);

if ($conn->connect_error) {
  die("Conexion Fallida: " . $conn->connect_error);
}

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

$conn->close();
?>
