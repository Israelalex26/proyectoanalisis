<!DOCTYPE html>

<html>

<head>
    
  <meta charset="UTF-8">
  <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="css/empleado.css" rel="stylesheet" />
  <title>Nomina PA</title>
  
  <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-analytics.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-storage.js"></script>

  
</head>

<body>

  <nav class="nav1">

    <div class="nav10_123">
    </div>

    <span class="title">Agregar empleado</span> <!--titulo de la web-->
  
    <form action="agregar_empleado.php" method="post">


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
  <label  class="label_expediente_empleado">Seleccionar expediente (PDF):</label>
  <input type="text" id="expediente_empleado" name="expediente_empleado" class="input_expediente_empleado" placeholder="">
</div>


<div class="div_foto_empleado">
    <label class="label_foto_empleado">Seleccionar foto del empleado:</label>
    <input type="text" id="foto_empleado" name="foto_empleado" class="input_foto_empleado" placeholder="">
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

<button class="foto_btn" onclick="login()">
  <span >Elegir foto</span>
</button>

<button class="pdf_btn" onclick="loginpdf()">
  <span>Elegir PDF</span>
</button>

  </nav>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


      <script src="firebase-config.js"></script>
    <script src="js/foto_empleado.js"></script>

</body>

</html>

<?php

include('conexion.php');

if ($conn){

include('verificarloggin.php');


    // Asumiendo que 'fk_cod_empleado' es una columna de la tabla 'expediente'
$alterExpedienteSql = "ALTER TABLE expediente MODIFY COLUMN id_expediente INT AUTO_INCREMENT";

if ($conn->query($alterExpedienteSql) !== TRUE) {
    echo "Error al modificar la tabla expediente: " . $conn->error;
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
        echo '<script>alert("El correo electrónico ingresado no es válido."); window.location.href = "agregar_empleado.php";</script>';
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

                if ($conn->query($alterUsuariosSql) !== TRUE) {
                    echo "Error al modificar la tabla usuarios: " . $conn->error;
                }

                $sql_usuarios = "INSERT INTO usuarios (correo_electronico, nombre_usuario, contrasena, rol)
                VALUES ('$correo_electronico', '$nombre_completo', 'Nomina123', 'Pendiente')";

                if ($conn->query($sql_usuarios) === TRUE) {
                    echo '<script>alert("La información se guardo correctamente."); window.location.href = "/proyectoanalisis/empleado.php";</script>';
                } else {
                    echo "Error al insertar en la tabla usuarios: " . $conn->error;
                }
            } else {
                echo "Error al insertar en la tabla expediente: " . $conn->error;
            }
        } else {
            echo "Error al insertar en la tabla empleado: " . $conn->error;
        }
    }
  }

}


?>
