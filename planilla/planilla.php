<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Nomina Solidarista</title>
      <link href="./css/planilla.css" rel="stylesheet" />


</head>

<body>

<header>

<div class="logo">
                <img src="img/v42_4.png" alt="Logo">
            </div>

</header>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header text-center">
          <h4>Crear planilla</h4>
        </div>
        <div class="card-body">
          <form action="planilla.php" method="POST">

            
            <div class="form-group">
                <label for="correo">Fecha</label>
                <input type="date" class="form-control" name="fecha">
            </div>

        </div>
        <div class="card-footer">
            <button type="submit" class="btn guardar-button">Actualizar</button>
            <a href="http://nominasolidarista.wuaze.com/inicio.php" class="btn cancelar-button me-2">Cancelar</a>
        </div>
          </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
include('conexion.php');

if ($conn) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtén la fecha del formulario
        $fecha = $_POST["fecha"];

        // Verifica que la fecha no esté vacía
        if (empty($fecha)) {
            echo "La fecha es obligatoria. Por favor, completa el formulario.";
        } else {
            // Consulta SQL para obtener todos los empleados
            $sql_empleados = "SELECT * FROM empleado";
            $result_empleados = $conn->query($sql_empleados);

            if ($result_empleados && $result_empleados->num_rows > 0) {
                while ($row_empleado = $result_empleados->fetch_assoc()) {
                    $nombre_empleado = $row_empleado["nombre_completo"];
                    $dpi = $row_empleado["dpi"];
                    $salario = $row_empleado["salario"];
                    $depa = $row_empleado["fk_departamento"];
                    $carnet = $row_empleado["carnet_igss"];

                    // Calcular IGSS y IGSS Patrono
                    $igss_empleado = ($salario * 4.83) / 100;
                    $igss_patrono = ($salario * 10.67) / 100;

                    // Insertar la planilla en la base de datos
                    $sqlPlanilla = "INSERT INTO planilla (nombre_empleado, dpi, afiliacion, departamento, sueldo_base, igss, igss_patrono, fecha)
                      VALUES ('$nombre_empleado', '$dpi', '$carnet', '$depa', '$salario', '$igss_empleado', '$igss_patrono', '$fecha')";

                    if ($conn->query($sqlPlanilla) !== TRUE) {
                        echo "Error al insertar planilla: " . $conn->error;
                    }else {
                        echo '<script>alert("Se generó la planilla correctamente."); window.location.href = "http://nominasolidarista.wuaze.com/planilla.php";</script>';
                    }
                }

                echo "Se generaron las planillas para todos los empleados correctamente.";
            } else {
                echo "No se encontraron empleados registrados en la base de datos.";
            }
        }
    }
}
?>

