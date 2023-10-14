<!DOCTYPE html>

<html>

<head>
    
  <meta charset="UTF-8">
  <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="css/empleado2.css" rel="stylesheet" />
  <title>Nomina PA</title>
  
  <!-- Incluye Firebase aquí -->
  <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-storage.js"></script>

  
</head>

<body>
  <header>
      <div class="logo">
          <img src="img/v42_4.png" alt="Logo">
      </div>
      <nav>
          <ul>

              <li><a href="inicio.html">Inicio</a>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Empleado</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="empleado.html">Empleado</a></li>
                  <li><a class="dropdown-item" href="#">Expediente Empleado</a></li>
                  <li><a class="dropdown-item" href="#">Hora extra</a></li>
                  <li><a class="dropdown-item" href="#">Bono 14</a></li>
                  <li><a class="dropdown-item" href="#">Aguinaldo</a></li>
                  <li><a class="dropdown-item" href="#">Salario</a></li>
                  <li><a class="dropdown-item" href="#">Salario</a></li>


                </ul>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Pólizas</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Polizas</a></li>
                  <li><a class="dropdown-item" href="#">Tipo de Poliza</a></li>
                  <li><a class="dropdown-item" href="#">Anticipo salario</a></li>
                </ul>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Tienda Solidarista</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="ventas.html">Ventas</a></li>
                  <li><a class="dropdown-item" href="#">Producto</a></li>
                  <li><a class="dropdown-item" href="#">Producción</a></li>
                  <li><a class="dropdown-item" href="#">Comisión</a></li>
                  <li><a class="dropdown-item" href="#">Piezas</a></li>
                </ul>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Ajustes</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Cambiar contraseña</a></li>
                  <li><a class="dropdown-item" href="#">Editar usuario</a></li>
                  <li><a class="dropdown-item" href="#">Politica y Privacidad</a></li>
                </ul>
              </li>

          </ul>
      </nav>

  
    </header>

  <nav class="nav1">

    <div class="nav10_123">
    </div>

    <span class="title">Agregar empleado</span> <!--titulo de la web-->
  
    <form action="empleado.php" method="post">


    <div class="div_cod_empleado">
      <label  class="label_cod_empleado">Codigo del empleado:</label>
      <input type="text"  name="cod_empleado" class="input_cod_empleado" placeholder="">
  </div>

  <div class="div_nombre_completo">
    <label  class="label_nombre_completo">Nombre completo del empleado:</label>
    <input type="text"  name="nombre_completo" class="input_nombre_completo" placeholder="">
</div>


<div class="div_correo_electronico">
    <label  class="label_correo_electronico">Correo electronico:</label>
    <input type="email"  name="correo_electronico" class="input_correo_electronico" placeholder="">
</div>

<div class="div_dpi">
  <label  class="label_dpi">DPI del empleado:</label>
  <input type="number"  name="dpi" class="input_dpi" placeholder="">
</div>


<div class="div_salario">
    <label  class="label_salario">Salario del empleado:</label>
    <input type="number"  name="salario" class="input_salario" placeholder="">
</div>

<div class="div_numero_telefono">
  <label  class="label_numero_telefono">Numero de telefono del empleado:</label>
  <input type="number"  name="numero_telefono" class="input_numero_telefono" placeholder="">
</div>


<div class="div_conyuge">
    <label  class="label_conyuge">conyuge del empleado (optional):</label>
    <input type="text"  name="conyuge" class="input_conyuge" placeholder="">
</div>

<div class="div_jornada">
  <label  class="label_jornada">jornada:</label>
  <input type="text"  name="jornada" class="input_jornada" placeholder="">
</div>


<div class="div_activo">
    <label  class="label_activo">activo:</label>
    <input type="text"  name="activo" class="input_activo" placeholder="">
</div>

<div class="div_expediente_empleado">
  <label  class="label_expediente_empleado">Número de expediente del empleado:</label>
  <input type="text"  name="expediente_empleado" class="input_expediente_empleado" placeholder="">
</div>


<div class="div_foto_empleado">
    <label class="label_foto_empleado">Seleccionar foto del empleado:</label>
    <input type="text" name="foto_empleado" class="input_foto_empleado" placeholder="">
</div>


<div class="div_fk_departamento">
  <label  class="label_fk_departamento">Nombre del departamento:</label>
  <input type="text"  name="fk_departamento" class="input_fk_departamento" placeholder="">
</div>


<div class="div_fecha_contratacion">
    <label  class="label_fecha_contratacion">fecha de contratacion del empleado:</label>
    <input type="date"  name="fecha_contratacion" class="input_fecha_contratacion" placeholder="">
</div>

<div class="div_cartnet_irtra">
  <label  class="label_cartnet_irtra">Carnet del irtra:</label>
  <input type="text"  name="cartnet_irtra" class="input_cartnet_irtra" placeholder="">
</div>


<div class="div_carnet_igss">
    <label  class="label_carnet_igss">Carnet del IGSS:</label>
    <input type="text"  name="carnet_igss" class="input_carnet_igss" placeholder="">
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


</body>

</html>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "id21355203_nomina";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión a la base de datos fallida: " . $conn->connect_error);
}

// Asumiendo que 'fk_cod_empleado' es una columna de la tabla 'expediente'
$alterExpedienteSql = "ALTER TABLE expediente MODIFY COLUMN id_expediente INT AUTO_INCREMENT";

if ($conn->query($alterExpedienteSql) === TRUE) {
    echo "La columna 'fk_cod_empleado' ha sido agregada a la tabla 'expediente'.";
} else {
    echo "Error al agregar la columna 'fk_cod_empleado' a la tabla 'expediente': " . $conn->error;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cod_empleado = $_POST['cod_empleado'];
    $nombre_completo = $_POST['nombre_completo'];
    $correo_electronico = $_POST['correo_electronico'];
    $dpi = $_POST['dpi'];
    $salario = $_POST['salario'];
    $numero_telefono = $_POST['numero_telefono'];
    $conyuge = $_POST['conyuge'];
    $jornada = $_POST['jornada'];
    $activo = $_POST['activo'];
    $foto_empleado = $_POST['foto_empleado'];
    $fk_departamento = $_POST['fk_departamento'];
    $fecha_contratacion = $_POST['fecha_contratacion'];
    $cartnet_irtra = $_POST['cartnet_irtra'];
    $carnet_igss = $_POST['carnet_igss'];
    $expediente_empleado = $_POST['expediente_empleado'];

    if (!filter_var($correo_electronico, FILTER_VALIDATE_EMAIL)) {
        echo '<script>alert("El correo electrónico ingresado no es válido."); window.location.href = "http://localhost/proyectoanalisis/register.php";</script>';
        exit();
    } else {
        // Insertar datos en la tabla de empleado
        $sql_empleado = "INSERT INTO empleado (cod_empleado, nombre_completo, correo_electronico, dpi, salario, numero_telefono, conyuge, jornada, activo, foto_empleado, fk_departamento, fecha_contratacion, cartnet_irtra, carnet_igss)
                VALUES ('$cod_empleado', '$nombre_completo', '$correo_electronico', '$dpi', '$salario', '$numero_telefono', '$conyuge', '$jornada', '$activo', '$foto_empleado', '$fk_departamento', '$fecha_contratacion', '$cartnet_irtra', '$carnet_igss')";

        if ($conn->query($sql_empleado) === TRUE) {
            // Insertar datos en la tabla de expediente
            $sql_expediente = "INSERT INTO expediente (archivo_pdf, fk_cod_empleado)
            VALUES ('$expediente_empleado', '$cod_empleado')";

            if ($conn->query($sql_expediente) === TRUE) {
                // Resto del código
                $alterUsuariosSql = "ALTER TABLE usuarios MODIFY COLUMN id_usuario INT AUTO_INCREMENT";

                if ($conn->query($alterUsuariosSql) === TRUE) {

                    $sql_usuarios = "INSERT INTO usuarios (correo_electronico, nombre_usuario, contrasena, rol)
                    VALUES ('$correo_electronico', '$nombre_completo', 'Nomina123', 'Pendiente')";

                    if ($conn->query($sql_usuarios) === TRUE) {
                        echo "Datos guardados en la base de datos.";
                    } else {
                        echo "Error al insertar en la tabla usuarios: " . $conn->error;
                    }
                } else {
                    echo "Error al modificar la tabla usuarios: " . $conn->error;
                }

            } else {
                echo "Error al insertar en la tabla expediente: " . $conn->error;
            }

        } else {
            echo "Error al insertar en la tabla empleado: " . $conn->error;
        }
    }
}

$conn->close();
?>