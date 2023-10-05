<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "nomina";

$conn = new mysqli($server, $user, $pass, $db);

if ($conn->connect_error) {
  die("Conexion Fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["user_id"])) {
  $userId = $_POST["user_id"];
  $correo = $_POST["correo"];
  $nombreUsuario = $_POST["nombre_usuario"];
  $rol = $_POST["rol"];

  // Verifica que el correo electrónico tenga un formato válido
  if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    echo "El correo electrónico no tiene un formato válido.";
    exit();
  }else{

      // Verifica que los campos no estén vacíos
      if (empty($correo) || empty($nombreUsuario) || empty($rol)) {
        echo "Por favor, complete todos los campos.";
        exit();
  } else{
      // Actualiza los datos en la base de datos
  $sql = "UPDATE usuarios SET correo_electronico='$correo', nombre_usuario='$nombreUsuario', rol='$rol' WHERE id_usuario='$userId'";

  if ($conn->query($sql) === TRUE) {
    echo '<script>alert("Los datos se actualizaron correctamente."); window.location.href = "http://localhost/proyectoanalisis/inicio.php";</script>';

  } else {
    echo '<script>alert("Error al actualizar los datos."); window.location.href = "http://localhost/proyectoanalisis/modificar_usuario.php";</script>';

  }
  }

  }
}

$conn->close();
?>
