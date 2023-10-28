<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Nomina Solidarista</title>
        <link href="./css/historialsalario.css" rel="stylesheet" />


</head>
<body>

<?php
// Incluye el archivo de conexión
include('conexion.php');

if ($conn){

  include('verificarloggin.php');


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
  $userId = $_GET["id"];

  $sql = "SELECT * FROM historialsalario WHERE id_historialsalario = $userId";
  $result = $conn->query($sql);

  if (!$result) {
    die("Error en la consulta: " . $conn->error);
  }

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    echo '
    
       <div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header text-center"><h4>Editar salario</h4></div>
        <div class="card-body">

    <form action="http://nominasolidarista.wuaze.com/historialsalario/guardar_modificacion.php" method="POST">
            <input type="hidden" name="historialsalarioId" value="' . $row['id_historialsalario'] . '">

            
            <div class="form-group">
          <label for="salario_anterior">Codigo empleado</label>
          <input type="text" class="form-control" name="cod_empleado" value="' . $row['fk_cod_empleado'] . '" readonly>
          </div>

          <div class="form-group">
          <label for="salario_anterior">Salario</label>
          <input type="text" class="form-control" name="salario_anterior" value="' . $row['salario_nuevo'] . '" readonly>
          </div>


          <div class="form-group">
            <label for="nombre_completo">Salario anterior</label>
            <span class="form-control">' . $row['salario_anterior'] . '</span>
          </div>

                      <div class="form-group">
                <label for="correo">Agregar salario nuevo</label>
                <input type="number" class="form-control" name="salario_nuevo" value="">
            </div>


            <button type="submit" class="btn guardar-button">Actualizar</button>
            <a href="http://nominasolidarista.wuaze.com/historialsalario.php" class="btn cancelar-button">Cancelar</a>

            </div>
            </div>
            </div>
            </div>
            </div>
        </form>';

    echo '';

  } else {
    echo "No se encontró un usuario con ese ID.";
  }
}
}else{
  echo "No se pudo establecer conexión a la base de datos.";

}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
