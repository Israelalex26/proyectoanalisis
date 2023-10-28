<?php
// Incluye el archivo de conexión
include('conexion.php');

if ($conn){

  include('verificarloggin.php');


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["user_id"])) {
  $userId = $_POST["user_id"];
  $correo = $_POST["correo"];
  $nombreUsuario = $_POST["nombre_usuario"];
  $rol = $_POST["rol"];

  // Verifica que el correo electrónico tenga un formato válido
  if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    echo '<script>alert("El correo electrónico no tiene un formato válido."); window.location.href = "http://nominasolidarista.wuaze.com/modificar_usuario.php";</script>';
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
    echo '<script>alert("Los datos se actualizaron correctamente."); window.location.href = "http://nominasolidarista.wuaze.com/inicio.php";</script>';

  } else {
    echo '<div class="alert alert-danger" role="alert">Error al actualizar el producto: ' . $conn->error . '</div>';

  }
  }

  }
}
}else{
  echo "No se pudo establecer conexión a la base de datos.";

}


?>
<?php
// Incluye el archivo de conexión
include('conexion.php');

if ($conn){

  include('verificarloggin.php');


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["user_id"])) {
  $userId = $_POST["user_id"];
  $correo = $_POST["correo"];
  $nombreUsuario = $_POST["nombre_usuario"];
  $rol = $_POST["rol"];

  // Verifica que el correo electrónico tenga un formato válido
  if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    echo '<script>alert("El correo electrónico no tiene un formato válido."); window.location.href = "http://nominasolidarista.wuaze.com/modificar_usuario.php";</script>';
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
    echo '<script>alert("Los datos se actualizaron correctamente."); window.location.href = "http://nominasolidarista.wuaze.com/inicio.php";</script>';

  } else {
    echo '<div class="alert alert-danger" role="alert">Error al actualizar el producto: ' . $conn->error . '</div>';

  }
  }

  }
}
}else{
  echo "No se pudo establecer conexión a la base de datos.";

}


?>
<?php
// Incluye el archivo de conexión
include('conexion.php');

if ($conn){

  include('verificarloggin.php');


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["user_id"])) {
  $userId = $_POST["user_id"];
  $correo = $_POST["correo"];
  $nombreUsuario = $_POST["nombre_usuario"];
  $rol = $_POST["rol"];

  // Verifica que el correo electrónico tenga un formato válido
  if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    echo '<script>alert("El correo electrónico no tiene un formato válido."); window.location.href = "http://nominasolidarista.wuaze.com/modificar_usuario.php";</script>';
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
    echo '<script>alert("Los datos se actualizaron correctamente."); window.location.href = "http://nominasolidarista.wuaze.com/inicio.php";</script>';

  } else {
    echo '<div class="alert alert-danger" role="alert">Error al actualizar el producto: ' . $conn->error . '</div>';

  }
  }

  }
}
}else{
  echo "No se pudo establecer conexión a la base de datos.";

}


?>
<?php
// Incluye el archivo de conexión
include('conexion.php');

if ($conn){

  include('verificarloggin.php');


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["user_id"])) {
  $userId = $_POST["user_id"];
  $correo = $_POST["correo"];
  $nombreUsuario = $_POST["nombre_usuario"];
  $rol = $_POST["rol"];

  // Verifica que el correo electrónico tenga un formato válido
  if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    echo '<script>alert("El correo electrónico no tiene un formato válido."); window.location.href = "http://nominasolidarista.wuaze.com/modificar_usuario.php";</script>';
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
    echo '<script>alert("Los datos se actualizaron correctamente."); window.location.href = "http://nominasolidarista.wuaze.com/inicio.php";</script>';

  } else {
    echo '<div class="alert alert-danger" role="alert">Error al actualizar el producto: ' . $conn->error . '</div>';

  }
  }

  }
}
}else{
  echo "No se pudo establecer conexión a la base de datos.";

}


?>
