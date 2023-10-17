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
          <input type="email" id="correo_electronico" name="correo_electronico" class="input_correo" placeholder="Ingrese su correo electrónico">
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
// Incluye el archivo de conexión
include('conexion.php');

if ($conn){

// Verifica si la solicitud es de tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo_electronico = $_POST["correo_electronico"];
    $contrasena = $_POST["contrasena"];

    //verificar si los campos estan vacios o no
    if (empty($correo_electronico) || empty($contrasena)) {
        echo '<script>alert("Por favor, complete todos los campos."); window.location.href = "http://localhost/proyectoanalisis/index.php";</script>';
    } else {
        // Escapa caracteres especiales para prevenir SQL injection
        $correo_electronico = $conexion->real_escape_string($correo_electronico);

        // Consulta preparada para prevenir SQL injection
        $stmt = $conexion->prepare("SELECT correo_electronico, contrasena, rol FROM usuarios WHERE correo_electronico = ?");
        $stmt->bind_param("s", $correo_electronico);
        $stmt->execute();
        $resultado = $stmt->get_result();

        // Verifica si se encontró un resultado
        if ($resultado->num_rows == 1) {
            // Las credenciales son válidas
            $row = $resultado->fetch_assoc();
            $contrasena_desencriptada = $row['contrasena'];
            $rol = $row['rol'];

            // Verifica si la contraseña ingresada coincide con la contraseña almacenada
            if (password_verify($contrasena, $contrasena_desencriptada)) {
                $_SESSION['correo_electronico'] = $correo_electronico;
                $_SESSION['rol'] = $rol;
                
                // Redirige según el rol
                if ($rol == "Admin") {
                    header("Location: inicio.php");
                } elseif ($rol == "Trabajador") {
                    header("Location: inicio.php");
                } elseif ($rol == "Pendiente") {
                    header("Location: index.php");
                } elseif ($rol == "Jefe") {
                    header("Location: index.php");
                }
            } else {
                // Las credenciales son inválidas
                echo '<script>alert("Credenciales incorrectas. Intente nuevamente."); window.location.href = "index.php";</script>';
            }
        } else {
            // El correo electrónico no existe en la base de datos
            echo '<script>alert("Correo electronico no registrado."); window.location.href = "index.php";</script>';
        }

        $stmt->close();
    }
}

}

?>
