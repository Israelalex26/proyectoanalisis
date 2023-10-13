<!DOCTYPE html>

<html>

<head>
    
  <meta charset="UTF-8">
  <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet" />
  <link href="./css/main.css" rel="stylesheet" />
  <title>Nomina PA</title>

</head>

<body>

  <img class="logo_pa"  src="img/v42_4.png"/>

  <nav class="nav1_index">

    
    <div class="nav10_123">
    </div>

    <span class="title_index">Inicia sesión</span> <!--titulo de la web-->

    <span class="description_index">Introduce tus datos para iniciar sesión
      con tu cuenta</span> <!--Descripcion de la web-->

      <!--Conexion al php-->
      <form action="index.php" method="POST">

        <div class="div_correo">
          <label for="correo_electronico" class="label_correo">Correo electrónico</label>
          <input type="text" id="correo_electronico" name="correo_electronico" class="input_correo" placeholder="Ingrese su correo electrónico">
      </div>

      
      <div class="div_password">
        <label for="contrasena" class="label_password">Contraseña</label>
        <input type="password" id="contrasena" name="contrasena" class="input_password" placeholder="Ingrese su contraseña">
    </div>

    <button class="login_btn" type="submit">
        <span class="text_login">Iniciar sesión</span>
    </button>


  </form>


      <button class="recover_btn">
        <a href="recoverpassword.php">
            <span class="recover_text">¿Olvidaste tu contraseña?</span>
        </a>
      </button>
      
      <span class="v10_136">¿No tienes una cuenta? <a href="register.php" class="v10_136-bold">Regístrate</a> </span>


  </nav>

  <span class="v10_199">Copyright @PA 2023 | Privacy Policy</span>


</body>

</html>


<?php
session_start();

$server = "localhost";
$user = "root";
$pass = "";
$db = "id21355203_nomina";

// Establece la conexión a la base de datos
$conexion = new mysqli($server, $user, $pass, $db);

// Verifica si hay errores en la conexión
if ($conexion->connect_error){
    die("Conexion Fallida: " . $conexion->connect_error);
}

// Verifica si la solicitud es de tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo_electronico = $_POST["correo_electronico"];
    $contrasena = $_POST["contrasena"];

    //verificar si los campos estan vacios o no
    if (empty($correo_electronico) || empty($contrasena)) {
        echo '<script>alert("Por favor, complete todos los campos."); window.location.href = "http://localhost/proyectoanalisis/index.php";</script>';
    }else{
        // Escapa caracteres especiales para prevenir SQL injection
    $correo_electronico = $conexion->real_escape_string($correo_electronico);
    $contrasena = $conexion->real_escape_string($contrasena);

    


    // Consulta preparada para prevenir SQL injection
    $stmt = $conexion->prepare("SELECT correo_electronico, rol FROM usuarios WHERE correo_electronico = ? AND contrasena = ?");
    $stmt->bind_param("ss", $correo_electronico, $contrasena);
    $stmt->execute();
    $stmt->store_result();

    // Verifica si se encontró un resultado
    if ($stmt->num_rows == 1) {
        // Las credenciales son válidas
        $stmt->bind_result($correo_electronico, $rol);
        $stmt->fetch();

        // Redirige según el rol
        if ($rol == "Admin") {
            echo '<script>window.location.href = "http://localhost/proyectoanalisis/inicio.php";</script>';
        } elseif ($rol == "Trabajador") {
            echo '<script>window.location.href = "http://localhost/proyectoanalisis/iniciotrabajador.php";</script>';
        } elseif ($rol == "Pendiente") {
            echo '<script>alert("Este usuario no está autorizado, espere un momento."); window.location.href = "http://localhost/proyectoanalisis/index.php";</script>';
        } elseif ($rol == "Jefe"){
            echo '<script>window.location.href = "http://localhost/proyectoanalisis/inicio.php";</script>';
        }
    } else {
        // Las credenciales son inválidas
        echo '<script>alert("Credenciales incorrectas. Intente nuevamente."); window.location.href = "http://localhost/proyectoanalisis/index.php";</script>';
    }

    $stmt->close();

    }

    }

$conexion->close();
?>