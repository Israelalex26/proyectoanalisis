<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Modificar Usuario</title>

    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-analytics.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-storage.js"></script>


    <style>
        body {
            background-color: #F6F2EB;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 1rem;
        }
          .guardar-button {
    background-color: #FEC887;
    color: #000; 
  }

  .cancelar-button {
    border: 1px solid #C1C1C1;
    color:#000000;
  }

    </style>
</head>
<body>

<?php

include('conexion.php');

if ($conn){

   //verifica si ha iniciado session o no
   include('verificarloggin.php');


  if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $expedienteId = $_GET["id"];
  
    $sql = "SELECT * FROM expediente WHERE id_expediente = $expedienteId";
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
        <div class="card-header text-center"><h4>Modificar expediente</h4></div>
      <form action="guardar_modificacion.php" method="POST">
              <input type="hidden" name="expediente_id" value="' . $row['id_expediente'] . '">
  
              <div class="input-group mb-3">
              <label for="correo">Agregar Expediente</label>
  
              <input type="text" class="form-control" id="archivo_pdf" name="archivo_pdf">
  
              <button class="btn btn-outline-secondary" type="button" onclick="loginpdf()" >Seleccionar PDF</button>
                </div>
  
              <button type="submit" class="btn guardar-button">Actualizar</button>
              <a href="http://nominasolidarista.wuaze.com/expediente.php" class="btn cancelar-button">Cancelar</a>
          </form>
          
          </div>
          </div>
          </div>
          </div>';
    
    } else {
      echo "No se encontró un usuario con ese ID.";
    }
  }
  

}

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="firebase-config.js"></script>
    <script src="js/expediente_empleado.js"></script>

</body>
</html>
