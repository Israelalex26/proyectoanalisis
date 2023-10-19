<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Modificar Departamento</title>
    <style>
        body {
            background-color: #F6F2EB;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>

<?php
// Incluye el archivo de conexión
include('conexion.php');

if ($conn){

include('verificarloggin.php');


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["nombre"])) {
  $nombreDepartamento = $_GET["nombre"];

  $sql = "SELECT * FROM departamento WHERE departamento = '$nombreDepartamento'";
  $result = $conn->query($sql);

  if (!$result) {
    die("Error en la consulta: " . $conn->error);
  }

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    echo '<form action="guardar_modificacion_departamento.php" method="POST">
            <input type="hidden" name="nombre_departamento" value="' . $row['departamento'] . '">

            <div class="form-group">
                <label for="nombreDepartamento">Nombre del Departamento</label>
                <input type="text" class="form-control" id="nombreDepartamento" name="nombreDepartamento" value="' . $row['departamento'] . '">
            </div>

            <div class="form-group">
                <label for="piso">Piso</label>
                <input type="text" class="form-control" id="piso" name="piso" value="' . $row['piso'] . '">
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>';

        echo '<a href="http://nominasolidarista.wuaze.com/departamento.php" class="btn btn-secondary">Cancelar</a>';



  } else {
    echo "No se encontró un departamento con ese nombre.";
  }
}


}else{
  echo "No se pudo establecer conexión a la base de datos.";

}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
