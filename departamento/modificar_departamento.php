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
$server = "localhost";
$user = "root";
$pass = "";
$db = "id21355203_nomina";

$conn = new mysqli($server, $user, $pass, $db);

if ($conn->connect_error) {
  die("Conexion Fallida: " . $conn->connect_error);
}

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


  } else {
    echo "No se encontró un departamento con ese nombre.";
  }
}

$conn->close();
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>