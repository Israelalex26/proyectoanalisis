<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="./css/horaextra.css" rel="stylesheet">
  <title>Nomina solidarista</title>

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
        <div class="card bg-white"> 
          <div class="card-header text-center">
            <h4>Hora Extra</h4>
          </div>
          <div class="card-body">
            <form action="horaextra.php" method="post">
              <div class="mb-3">
                <label for="nombre">Codigo empleado:</label>
                <input type="text" class="form-control" name="cod_empleado"  placeholder="">
              </div>
              <div class="mb-3">
                <label for="fecha">Fecha:</label>
                <input type="date" class="form-control" name="fecha">
              </div>
              <div class="mb-3">
                <label for="cantidad">Hora extra:</label>
                <input type="number" class="form-control" name="hora_extra" placeholder="">
              </div>
            </div>
             <button class="btn cancelar-button" type="button" onclick="cancelar()">
                Cancelar
            </button>
            <button class="btn guardar-button">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
        function cancelar() {
            window.location.href = "http://nominasolidarista.wuaze.com/extra.php";
        }
    </script>
</body>
</html>

<?php
// Incluye el archivo de conexión
include('conexion.php');

if ($conn) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtén los valores del formulario
        $cod_empleado = $_POST["cod_empleado"];
        $fecha = $_POST["fecha"];
        $hora_extra = $_POST["hora_extra"];

        // Verifica que los campos no estén vacíos
        if (empty($cod_empleado) || empty($fecha) || empty($hora_extra)) {
            echo '<script>alert("Por favor, debes de llenar todos los campos."); window.location.href = "http://nominasolidarista.wuaze.com/horaextra.php";</script>';

        } else {
            // Consulta el salario del empleado desde la tabla historialsalario
            $sql_salario = "SELECT salario_nuevo FROM historialsalario WHERE fk_cod_empleado = '$cod_empleado'";
            $result_salario = $conn->query($sql_salario);

            if ($result_salario && $result_salario->num_rows > 0) {
                $row_salario = $result_salario->fetch_assoc();
                $nuevo_salario = $row_salario["salario_nuevo"];

                // Realiza el cálculo del monto de las horas extras
               $monto_horas_extras = ($nuevo_salario / 30);
               $monto8 = ($monto_horas_extras / 8);
               $monto2 = ($monto8 / 2);
               $sumaTotal = ($monto8 + $monto2);
               $totalhoraextra = ($sumaTotal * $hora_extra);



                // Inserta la información en la tabla horaextra
                $sql_insert = "INSERT INTO horaextra (fk_cod_empleado, fecha, hora_extra, monto) VALUES ('$cod_empleado', '$fecha', $hora_extra, $totalhoraextra)";

                if ($conn->query($sql_insert) === TRUE) {
                    echo '<script>alert("Horas extras registrado correctamente."); window.location.href = "http://nominasolidarista.wuaze.com/inicio.php";</script>';

                } else {
                    echo "Error al registrar las horas extras: " . $conn->error;
                }
            } else {
                echo "No se encontró información de salario para el empleado.";
            }
        }
    }
}
?>
