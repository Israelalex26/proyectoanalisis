<?php
include('conexion.php');

if ($conn){


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
  $userId = $_GET["id"];

  // Elimina el usuario con el ID especificado
  $sql = "DELETE FROM usuarios WHERE id_usuario = $userId";

  if ($conn->query($sql) === TRUE) {
    echo '<script>alert("Usuario eliminado con exito."); window.location.href = "/proyectoanalisis/inicio.php";</script>';

  } else {
    echo "Error al eliminar el usuario: " . $conn->error;
    echo '<script>alert("Error al eliminar el usuario."); window.location.href = "/proyectoanalisis/inicio.php";</script>';

  }
}
}else{
  echo "No se pudo establecer conexión a la base de datos.";

}


?>