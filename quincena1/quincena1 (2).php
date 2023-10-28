<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="./css/quince1.css" rel="stylesheet">
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
            <h4>Quincena 1</h4>
          </div>
          <div class="card-body">
            <form action="quincena1.php" method="post">
              <div class="mb-3">
                <label for="nombre">Codigo empleado:</label>
                <input type="text" class="form-control" name="cod_empleado"  placeholder="">
              </div>
              <div class="mb-3">
                <label for="fecha">Comisiones:</label>
                <input type="number" class="form-control" name="comisiones">
              </div>
              <div class="mb-3">
                <label for="nombre">Mes:</label>
                <input type="text" class="form-control" name="mes"  placeholder="">
              </div>
              <div class="mb-3">
                <label for="fecha">Año:</label>
                <input type="text" class="form-control" name="ano" placeholder="">
              </div>

            </div>
            <div class="card-footer text-end">
                   <button class="btn cancelar-button" type="button" onclick="cancelar()">Cancelar</button>

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
            window.location.href = "http://nominasolidarista.wuaze.com/quincena1.php";
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
        $comisiones = $_POST["comisiones"];
        $mes = $_POST["mes"];
        $año = $_POST["ano"];

        // Verifica que los campos no estén vacíos
        if (empty($cod_empleado) || empty($comisiones) || empty($mes)|| empty($año)) {
            echo "Todos los campos son obligatorios. Por favor, complete el formulario.";
        } else {
            // Consulta el nombre del empleado y salario nuevo desde la tabla empleado e historialsalario
            $sql_empleado = "SELECT nombre_completo, fecha_contratacion FROM empleado WHERE cod_empleado = '$cod_empleado'";
            $result_empleado = $conn->query($sql_empleado);

            $sql_salario = "SELECT salario_nuevo FROM historialsalario WHERE fk_cod_empleado = '$cod_empleado'";
            $result_salario = $conn->query($sql_salario);

            if ($result_empleado && $result_salario && $result_empleado->num_rows > 0 && $result_salario->num_rows > 0) {
                $row_empleado = $result_empleado->fetch_assoc();
                $nombre_empleado = $row_empleado["nombre_completo"];
                $contrato = $row_empleado["fecha_contratacion"];

                $row_salario = $result_salario->fetch_assoc();
                $salario_nuevo = $row_salario["salario_nuevo"];

                $fecha_bono14 = "2023-07-01";

                    $segundos_transcurrido = strtotime($fecha_bono14) - strtotime($contrato);
                    $minutos_transcurrido = $segundos_transcurrido / 60;
                    $horas_transcurrida = $minutos_transcurrido / 60;
                    $dias = $horas_transcurrida / 24;

                    $fecha = "2023-12-01";

                    $segundos_transcurridos = strtotime($fecha) - strtotime($contrato);
                    $minutos_transcurridos = $segundos_transcurridos / 60;
                    $horas_transcurridas = $minutos_transcurridos / 60;
                    $diass = $horas_transcurridas / 24;

                // Calcular el anticipo (45% del salario_nuevo)
                $anticipo = ($salario_nuevo * 0.45);

                // Calcular las comisiones (se divide por 100 y luego se multiplica por el salario nuevo)
                $comisiones = ($comisiones * 0.01) ;

                $igss_porcentaje = 4.83; // Porcentaje de IGSS
                $irtra_porcentaje = 1;   // Porcentaje de IRTRA
               // $limite_isr = 4500;     // Límite para no pagar ISR
                $porcentaje_isr = 5;    // Porcentaje de ISR para salarios de 4500 a 9000
                $porcentaje_isr_alto = 7; // Porcentaje de ISR para salarios superiores a 9000
        
                    if ($salario_nuevo <= 300000) {
                        // ISR para salarios de 4500 a 9000
                        $isr = $anticipo  * ($porcentaje_isr / 100);
                         
                    } else {
                        // ISR para salarios superiores a 9000
                        $isr = $anticipo * ($porcentaje_isr_alto / 100);
                       
                    }
                
                
                // Cálculo del IGSS y el IRTRA
                $igss = $anticipo  * ($igss_porcentaje / 100);
                $irtra = $anticipo * ($irtra_porcentaje / 100);
               $suma=  $isr + $igss + $irtra;
                $total = $anticipo - $suma;

                
                if(strcasecmp($mes, 'Julio') == 0){
                  if($dias <= 366){
                    $fecha_bono14 = "2023-07-01";

                    $segundos_transcurridos = strtotime($fecha_bono14) - strtotime($contrato);
                    $minutos_transcurridos = $segundos_transcurridos / 60;
                    $horas_transcurridas = $minutos_transcurridos / 60;
                    $dias = $horas_transcurridas / 24;
                    $devengado = $comisiones + $salario_nuevo;

                    $bono14 = ($devengado * $dias) / 365;
                  }else if ($dias > 366) {
                      $devengado = $comisiones + $salario_nuevo;
                    $bono14 = ($devengado * 365) / 365;
                  }

                }else if(strcasecmp($mes, 'Diciembre') == 0){
                    if($diass <= 366){
                    $fecha_aguinaldo = "2023-12-01";

                    $segundos = strtotime($fecha_aguinaldo) - strtotime($contrato);
                    $minutos = $segundos / 60;
                    $horas = $minutos / 60;
                    $dia = $horas / 24;
                    $deve = $comisiones + $salario_nuevo;

                    $aguinaldo = ($deve * $dia) / 365;
                  } else{
                      $deve = $comisiones + $salario_nuevo;
                      $aguinaldo = ($deve * 365) / 365;
                  }
                }
                
                
                $alterQuincena1Sql = "ALTER TABLE quincena1 MODIFY COLUMN id_quincena1 INT AUTO_INCREMENT";

                    if ($conn->query($alterQuincena1Sql) !== TRUE) {
                      echo "Error al modificar la tabla usuarios: " . $conn->error;
                  }

                  $sqlQuincena1 = "INSERT INTO quincena1 (empleado, salario, anticipo, comisiones, igss, irtra, isr, Total, mes ,ano, aguinaldo, bono14)
                  VALUES ('$nombre_empleado', '$salario_nuevo', '$anticipo', '$comisiones', '$igss', '$irtra', '$isr', '$total', '$mes', '$año', '$aguinaldo' , '$bono14')";
                  
                  if ($conn->query($sqlQuincena1) === TRUE){
                    echo '<script>alert("La Quincena1 se guardo correctamente."); window.location.href = "http://nominasolidarista.wuaze.com/quincena1.php";</script>';
                  }
  

            } else {
                echo "No se encontró información de salario o empleado para el código de empleado proporcionado.";
            }
        }
    }
}
?>
