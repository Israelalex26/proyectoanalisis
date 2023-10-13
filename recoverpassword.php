<!DOCTYPE html>
<html>
<head>

    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet" />
    <link href="./css/recoverpassword.css" rel="stylesheet" />
    <title>Nomina PA</title>
   
</head>
<body>

    <img class="logo_pa" src="img/v42_4.png">

  <nav class="nav1_recoverpassword">

    <div class="nav10_123">
    </div>

    <span class="title">Recuperar contraseña</span> <!--titulo de la web-->

    <span class="description">Debes de ingresar tu coreo electrónico que
        registraste con nosotros.</span> <!--Descripcion de la web-->

        <form  action="recoverpassword.php" method="POST">

            <div class="div_correo">
              <label for="correo_electronico" class="label_correo">Correo electrónico</label>
              <input type="text" id="correo_electronico" name="correo_electronico" class="input_correo" placeholder="Ingrese su correo electrónico">
          </div>
       
        <button class="v150_40">
          <span class="v150_41">Recupear contraseña</span>
        </button>
        
        

        </form>

        <button class="v150_35">
          <span class="v150_36">Cancelar</span>
        </button>
       

  </nav>

   
</body>
</html>


<?php
// Conexión a la base de datos (sustituye 'tu_host', 'tu_usuario', 'tu_contraseña' y 'tu_base_de_datos' con los valores reales)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "id21355203_nomina";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el correo electrónico enviado por el usuario
    $correo_electronico = $_POST['correo_electronico'];

    // Consulta para verificar si el correo electrónico existe en la tabla de usuarios
    $sql = "SELECT id_usuario FROM usuarios WHERE correo_electronico = '$correo_electronico'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // El correo electrónico existe en la base de datos
        $row = $result->fetch_assoc();
        $id_usuario = $row["id_usuario"];
        // Redireccionar a la página changepassword.php con el ID de usuario
        header("Location: changepassword.php?id_usuario=$id_usuario");
        exit();
    } else {
        // El correo electrónico no existe en la base de datos
        echo '<script>alert("El correo electrónico ingresado no está registrado."); window.location.href = "http://localhost/proyectoanalisis/recoverpassword.php";</script>';

    }
}

$conn->close();
?>
