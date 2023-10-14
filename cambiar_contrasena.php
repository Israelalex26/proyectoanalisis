<!DOCTYPE html>

<html>

<head>
    
  <meta charset="UTF-8">
  <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="css/cambiar_contrasena.css" rel="stylesheet" />
  <title>Nomina PA</title>
  

</head>

<body>
  <header>
      <div class="logo">
          <img src="img/v42_4.png" alt="Logo">
      </div>
   

  
    </header>

  <nav class="nav1">

    <div class="nav10_123">
    </div>

    <span class="title">Cambiar contraseña</span> <!--titulo de la web-->
  
    <form action="cambiar_contrasena.php" method="post">


    <div class="div_id_comision">
      <label for="id_comision" class="label_id_comision">Contraseña actual</label>
      <input type="password" id="id_comision" name="contrasena_actual" class="input_id_comision" placeholder="Ingrese su anterior contraseña">
  </div>

  <div class="div_rango">
    <label for="rango" class="label_rango">Contraseña nueva</label>
    <input type="password" id="rango" name="contrasena_nueva" class="input_rango" placeholder="Ingresa una nueva contraseña">
  </div>

  <div class="div_porcentaje">
    <label for="porcentaje_comision" class="label_porcentaje">Repetir contraseña nueva</label>
    <input type="password" id="porcentaje_comision" name="repetir_contrasena" class="input_porcentaje" placeholder="Repita la nueva contraseña">
</div>



<button class="v150_35">
  <span class="v150_36">Cancelar</span>
</button>


<button class="v150_40">
  <span class="v150_41">Guardar</span>
</button>

</form>


  </nav>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


</body>

</html>

<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "id21355203_nomina";

// Crear una conexión a la base de datos
$conn = new mysqli($server, $user, $pass, $db);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}

// Recuperar datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contrasena_actual = $_POST['contrasena_actual'];
    $contrasena_nueva = $_POST['contrasena_nueva'];
    $repetir_contrasena = $_POST['repetir_contrasena'];

    // Verificar si algún campo está vacío
    if (empty($contrasena_actual) || empty($contrasena_nueva) || empty($repetir_contrasena)) {
        echo '<div id="liveAlertPlaceholder" class="alert alert-warning" role="alert">Por favor, complete todos los campos.</div>';
    } else {
        if (strlen($contrasena_actual) < 7 || strlen($contrasena_actual) > 16 ||
            strlen($contrasena_nueva) < 7 || strlen($contrasena_nueva) > 16 ||
            strlen($repetir_contrasena) < 7 || strlen($repetir_contrasena) > 16) {
            echo '<div class="alert alert-warning" role="alert">Cada contraseña debe tener entre 7 y 16 caracteres.</div>';
        } else {
            // Obtener el ID del usuario actual, puedes ajustar esto según tu lógica de autenticación
            $id_usuario_actual = 1; // Reemplaza 1 con el ID del usuario actual

            // Consulta SQL para obtener la contraseña almacenada para el usuario
            $sql = "SELECT contrasena FROM usuarios WHERE id_usuario = $id_usuario_actual";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $contrasena_almacenada = $row['contrasena'];

                // Verificar si la contraseña actual coincide con la contraseña almacenada
                if ($contrasena_actual == $contrasena_almacenada) {
                    // Contraseña actual es válida, puedes continuar con el procesamiento.
                    // Aquí puedes agregar el código para actualizar la contraseña en la base de datos.

                    
                    // Actualizar la contraseña en la base de datos
                    $sql = "UPDATE usuarios SET contrasena = '$contrasena_nueva' WHERE id_usuario = $id_usuario_actual";

                    if ($conn->query($sql) === TRUE) {
                        echo '<div class="alert alert-success" role="alert">La contraseña se actualizó correctamente.</div>';
                    } else {
                        echo '<div class="alert alert-warning" role="alert">Error al actualizar la contraseña: ' . $conn->error . '</div>';
                    }
                } else {
                    // Contraseña actual no coincide, muestra una alerta
                    echo '<div class="alert alert-warning" role="alert">La contraseña actual no es válida.</div>';
                }
            } else {
                // No se encontró un usuario con ese ID
                echo '<div class="alert alert-warning" role="alert">Usuario no encontrado.</div>';
            }
        }
    }
}
?>
