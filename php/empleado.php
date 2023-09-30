<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "nomina";

$conn = new mysqli($server, $user, $pass, $db);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nombre_completo = $_POST['nombre_completo'];
  $correo_electronico = $_POST['correo_eñectronico'];
  $numero_telefono = $_POST['numero_telefono'];
  $conyuge = $_POST['Conyuge'];
  $jornada = $_POST['jornada'];
  $activo = $_POST['activo'];

  // URL de los archivos
  $expediente_url = $_POST['expediente'];
  $foto_url = $_POST['foto'];

  // Mueve los archivos temporales a una ubicación permanente y obtén las URLs
  $expediente_url = moveArchivo($_FILES['expediente_file']['tmp_name'], 'expediente');
  $foto_url = moveArchivo($_FILES['foto_file']['tmp_name'], 'foto');

  // Función para mover el archivo y devolver la URL
  function moveArchivo($file, $tipo) {
      $target_dir = "uploads/";
      $target_file = $target_dir . basename($_FILES["$tipo_file"]["name"]);

      if (move_uploaded_file($file, $target_file)) {
          return $target_file;
      } else {
          return null;
      }
  }

  // Insertar datos en la base de datos
  $sql = "INSERT INTO empleado (nombre_completo, correo_electronico, numero_telefono, conyuge, jornada, activo, expediente_empleado, foto_empleado)
          VALUES ('$nombre_completo', '$correo_electronico', '$numero_telefono', '$conyuge', '$jornada', '$activo', '$expediente_url', '$foto_url')";

  if ($conn->query($sql) === TRUE) {
    echo "Empleado guardado correctamente.";
  } else {
    echo "Error al guardar el empleado: " . $conn->error;
  }
}

$conn->close();
?>

