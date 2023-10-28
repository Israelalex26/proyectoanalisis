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
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

include('conexion.php');

if ($conn) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $correo_electronico = $_POST["correo_electronico"];
        $contrasena = $_POST["contrasena"];

    //verificar si los campos estan vacios o no
    if (empty($correo_electronico) || empty($contrasena)) {
        echo '<script>alert("Por favor, complete todos los campos."); window.location.href = "http://nominasolidarista.wuaze.com/index.php";</script>';
    } else {
        // Escapa caracteres especiales para prevenir SQL injection
        $correo_electronico = $conn->real_escape_string($correo_electronico);

            $stmt = $conn->prepare("SELECT id_usuario, contrasena, rol FROM usuarios WHERE correo_electronico = ?");
            $stmt->bind_param("s", $correo_electronico);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($resultado->num_rows == 1) {
                $row = $resultado->fetch_assoc();
                $contrasena_desencriptada = $row['contrasena'];
                $rol = $row['rol'];

                if (password_verify($contrasena, $contrasena_desencriptada)) {
                    $_SESSION['correo_electronico'] = $correo_electronico;
                    $_SESSION['rol'] = $rol;
                    $_SESSION['loggedin'] = true; 

                    if ($rol == "Admin") {
                        session_regenerate_id();
                        $_SESSION['nombre_usuario'] = $_POST['nombre_usuario'];
                        $_SESSION['id_usuario'] = $row['id_usuario']; 
                        header("Location: inicio.php");

                    } elseif ($rol == "Trabajador") {
                         session_regenerate_id();
                        $_SESSION['nombre_usuario'] = $_POST['nombre_usuario'];
                        $_SESSION['id_usuario'] = $row['id_usuario']; 
                        header("Location: inicio_trabajador.php");

                    } elseif ($rol == "Pendiente") {
                        header("Location: index.php");
                    } elseif ($rol == "Jefe") {
                        header("Location: index.php");
                    }
                } else {
                    echo '<script>alert("Credenciales incorrectas. Intente nuevamente."); window.location.href = "index.php";</script>';
                }
            } else {
                echo '<script>alert("Correo electrónico no registrado."); window.location.href = "index.php";</script>';
            }

            $stmt->close();
        }
    }
} else {
    echo "No se pudo establecer conexión a la base de datos.";
}
?>
