<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="./css/liquidacionlaboral.css" rel="stylesheet">
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
            <h4>liquidacionlaboral</h4>
          </div>
          <div class="card-body">
            <form action="liquidacionlaboral.php" method="post">
              <div class="mb-3">
                <label for="codigo">Codigo empleado:</label>
                <input type="text" class="form-control" name="cod">
              </div>
              <div class="mb-3">
                <label for="fecha">Fecha terminación de trabajo:</label>
                <input type="date" class="form-control" name="fecha_terminacion_trabajo">
              </div>
            </div>
            <div class="card-footer text-end">
              <button class="v150_35" type="button" onclick="cancelar()">
                <span class="v150_36">Cancelar</span>
              </button>
              <button class="v150_40">
                <span class="v150_41">Guardar</span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function cancelar() {
      window.location.href = "http://nominasolidarista.wuaze.com/liquidacion.php";
    }
  </script>


<?php
// Incluye el archivo de conexión
include('conexion.php');

if ($conn) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtén los valores del formulario
        $cod = $_POST["cod"];
        $fecha_terminacion_trabajo = $_POST["fecha_terminacion_trabajo"];

        // Verifica que los campos no estén vacíos
        if (empty($cod) || empty($fecha_terminacion_trabajo)) {
            echo "Todos los campos son obligatorios. Por favor, complete el formulario.";
        } else {
            // Consulta el nombre_completo, fecha_contratación y salario_nuevo desde la tabla empleado e historialsalario
            $sql = "SELECT empleado.nombre_completo, empleado.fecha_contratacion, historialsalario.salario_nuevo FROM empleado 
                    INNER JOIN historialsalario ON empleado.cod_empleado = historialsalario.fk_cod_empleado
                    WHERE empleado.cod_empleado = '$cod'";

            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $nombre_completo = $row["nombre_completo"];
                $fecha_contratacion = $row["fecha_contratacion"];
                $salario_nuevo = $row["salario_nuevo"];

                // Calcular monto_liquidación entre la fecha_contratación y la fecha_terminacion_trabajo
                $segundos_transcurridos = strtotime($fecha_terminacion_trabajo) - strtotime($fecha_contratacion);
                $minutos_transcurridos = $segundos_transcurridos / 60;
                $horas_transcurridas = $minutos_transcurridos / 60;
                $dias = $horas_transcurridas / 24;

               

                $liquidacion = $salario_nuevo * 14;
                $suma = $liquidacion / 12;
                $monto = ($suma * $dias) / 365;
                if($dias >= 365){
                // Fórmula para calcular el Bono 14 
                 $bono14l = '2023-07-01';

                $segundos =  strtotime($fecha_terminacion_trabajo) -  strtotime($bono14l) ;
                $minutos = $segundos / 60;
                $horas = $minutos / 60;
                $dia = $horas / 24;

                $bono14 = ($salario_nuevo * $dia) / 365;

               $aguinaldol = '2022-12-01';

                $segundo  = strtotime($fecha_terminacion_trabajo) - strtotime($aguinaldol) ;
                $minuto = $segundo / 60;
                $hora = $minuto / 60;
                $di = $hora / 24;
                // Fórmula para calcular el Aguinaldo

                $aguinaldo = ($salario_nuevo * $di) / 365;
                }else{
                  $segun = strtotime($fecha_terminacion_trabajo) - strtotime($fecha_contratacion);
                $minu = $segun / 60;
                $hor = $minu / 60;
                $d = $hor / 24;
                $bono14 = ($salario_nuevo * $d) / 365;

               $segu = strtotime($fecha_terminacion_trabajo) - strtotime($fecha_contratacion);
                $min = $segu / 60;
                $ho = $min / 60;
                $dl = $ho / 24;
                $aguinaldo = ($salario_nuevo * $dl) / 365;

                }
                  $seg = strtotime($fecha_terminacion_trabajo) - strtotime($fecha_contratacion);
                $mi = $seg / 60;
                $h = $mi / 60;
                $dv = $h / 24;
                $anos = $dv / 365;
                if ($anos >= 1 && $anos < 5) {
                    $diasVacaciones = 15;
                    } elseif ($anos >= 5 && $anos < 10) {
                      $diasVacaciones = 20;
                    } else {
                    $diasVacaciones = 30;
                        }
                
                $bono = ($salario_nuevo / 365) * $diasVacaciones;
            

                $sql_horas_extras = "SELECT SUM(IFNULL(monto,0)) AS total_horas_extras FROM horaextra WHERE fk_cod_empleado = $cod;";
                $result_horas_extras = $conn->query($sql_horas_extras);

               

                 if($result_horas_extras === null){
                    // Si no hay horas extras, el total de horas extras es igual a 0
                    $total_horas_extras = 0;
                } else if ($result_horas_extras && $result_horas_extras->num_rows > 0) {

                    $row_horas_extras = $result_horas_extras->fetch_assoc();
                    $total_horas_extras = $row_horas_extras["total_horas_extras"];
                } 
                $indermizacion= $monto + $bono14 + $aguinaldo + $bono + $total_horas_extras;

                $alterLiquidacionLaboralSql = "ALTER TABLE liquidacionlaboral MODIFY COLUMN id_liquidacionlaboral INT AUTO_INCREMENT";

                if ($conn->query($alterLiquidacionLaboralSql) !== TRUE) {
                    echo "Error al modificar la tabla usuarios: " . $conn->error;
                }

                $sqlLiquidacionLaboral = "INSERT INTO liquidacionlaboral (empledo, fecha_contratacion, fecha_terminacion_trabajo, monto_liquidacion, bono14, aguinaldo, vacaciones, horas_extras, totalprestacion) VALUES ('$nombre_completo', '$fecha_contratacion', '$fecha_terminacion_trabajo', '$monto', '$bono14', '$aguinaldo', '$bono', '$total_horas_extras', '$indermizacion')";

                if ($conn->query($sqlLiquidacionLaboral) === TRUE) {
                    echo '<script>alert("La Liquidacion laboral se guardo correctamente."); window.location.href = "http://nominasolidarista.wuaze.com/liquidacion.php";</script>';
                }
            } else {
                echo "No se encontró información de empleado y salario para el código de empleado proporcionado.";
            }
        }
    }
}
?>


</body>
</html>