<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Modificar Usuario</title>
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


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
  $userId = $_GET["id"];

  $sql = "SELECT * FROM usuarios WHERE id_usuario = $userId";
  $result = $conn->query($sql);

  if (!$result) {
    die("Error en la consulta: " . $conn->error);
  }

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    echo '<form action="http://nominasolidarista.wuaze.com/usuario/guardar_modificacion.php" method="POST">
            <input type="hidden" name="user_id" value="' . $row['id_usuario'] . '">

            <div class="form-group">
                <label for="correo">Correo Electrónico</label>
                <input type="text" class="form-control" id="correo" name="correo" value="' . $row['correo_electronico'] . '">
            </div>

            <div class="form-group">
                <label for="nombreUsuario">Nombre de Usuario</label>
                <input type="text" class="form-control" id="nombreUsuario" name="nombre_usuario" value="' . $row['nombre_usuario'] . '">
            </div>

            <div class="form-group">
                <label for="rol">Rol</label>
                <select class="form-select" id="rol" name="rol">
                    <option value="Trabajador" ' . ($row['rol'] == 'Trabajador' ? 'selected' : '') . '>Trabajador</option>
                    <option value="Pendiente" ' . ($row['rol'] == 'Pendiente' ? 'selected' : '') . '>Pendiente</option>
                    <option value="Jefe" ' . ($row['rol'] == 'Jefe' ? 'selected' : '') . '>Jefe</option>
                    <option value="Admin" ' . ($row['rol'] == 'Admin' ? 'selected' : '') . '>Admin</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>';

    echo '<a href="http://nominasolidarista.wuaze.com/inicio.php" class="btn btn-secondary">Cancelar</a>';

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
