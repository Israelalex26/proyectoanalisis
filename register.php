<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet" />
    <link href="./css/register.css" rel="stylesheet" />
    <title>Nomina PA</title>
</head>

<body>

    <img class="logo_pa" src="img/v42_4.png" />

    <nav class="nav1_register">
        <div class="nav10_123"></div>
        <span class="title">Crear cuenta</span>
        <span class="description">Introduce los datos para crear tu cuenta</span>
    </nav>

    <form action="register.php" method="POST">
        <div class="div_correo">
            <label for="correo_electronico" class="label_correo">Correo electrónico</label>
            <input type="email" id="correo_electronico" name="correo_electronico" class="input_correo" placeholder="Ingrese su correo electrónico">
        </div>

        <div class="div_username">
            <label for="nombre_usuario" class="label_username">Nombre de usuario</label>
            <input type="text" id="nombre_usuario" name="nombre_usuario" class="input_username" placeholder="Ingrese su nombre de usuario">
        </div>

        <div class="div_password">
            <label for="contrasena" class="label_password">Contraseña</label>
            <input type="password" id="contrasena" name="contrasena" class="input_password" placeholder="Ingrese su contraseña">
        </div>

        <button type="submit" class="register_btn">
            <span class="text_register">Crear cuenta</span>
        </button>
    </form>

    <a href="polity_terms_login.php" class="termsPolicy1">Al registrarte, aceptas los <span class="termsPolicy2">Términos de servicio</span> y la
        <span class="termsPolicy2">Política de privacidad</span>, incluida la política de <span class="termsPolicy2">Uso
            de Cookies</span>.</a>

    <span class="v10_136">¿Ya tienes una cuenta? <a href="index.php" class="v10_136-bold">Iniciar sesión</a> </span>

</body>

</html>

<?php
// Incluye el archivo de conexión
include('conexion.php');

if ($conn){

// Recuperar datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo_electronico = isset($_POST['correo_electronico']) ? $_POST['correo_electronico'] : '';
    $nombre_usuario = isset($_POST['nombre_usuario']) ? $_POST['nombre_usuario'] : '';
    $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : '';

    // Verificar que los campos no estén vacíos
    if (empty($correo_electronico) || empty($nombre_usuario) || empty($contrasena)) {
        echo '<script>alert("Por favor, complete todos los campos."); window.location.href = "register.php";</script>';
        exit();
    }else{

      // Verificar que el correo electrónico esté bien escrito
    if (!filter_var($correo_electronico, FILTER_VALIDATE_EMAIL)) {
      echo '<script>alert("El correo electrónico ingresado no es válido."); window.location.href = "register.php";</script>';
      exit();
  }else{

     // Modificar la estructura de la tabla para hacer que "id_users" sea autoincremental
  $alterTableSql = "ALTER TABLE usuarios MODIFY COLUMN id_usuario INT AUTO_INCREMENT";

  if ($conn->query($alterTableSql) === TRUE) {
      // Ahora, la columna "id_users" está configurada como autoincremental

      // Insertar datos en la tabla "users" sin especificar un valor para "id_users"
      
      //Para incriptar la contraseña
      $contrasena_encrip = password_hash($contrasena, PASSWORD_DEFAULT);

      $sql = "INSERT INTO usuarios (correo_electronico, nombre_usuario, contrasena, rol) VALUES ('$correo_electronico', '$nombre_usuario', '$contrasena_encrip', 'Pendiente')";

      if ($conn->query($sql) === TRUE) {
          echo '<script>alert("Registro exitoso, Espere un momento."); window.location.href = "index.php";</script>';
      } else {
          echo '<script>alert("Error al registrar usuario:"); window.location.href = "register.php";</script>';
      }
  } else {
      echo '<script>alert("Error al modificar la tabla:"); window.location.href = "register.php";</script>';
  }


  }

 
    }

    
}
}else{
    echo "No se pudo establecer conexión a la base de datos.";

}
?>
