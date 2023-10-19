<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Modificar Empleado</title>

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
    </style>
</head>
<body>

<?php
include('conexion.php');

if ($conn){

include('verificarloggin.php');


    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["cod_empleado"])) {
        $cod_empleado = $_GET["cod_empleado"];
      
        $sql = "SELECT * FROM empleado WHERE cod_empleado = '$cod_empleado'";
        $result = $conn->query($sql);
      
        if (!$result) {
          die("Error en la consulta: " . $conn->error);
        }
      
        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
      
          echo '
          <form action="modificacion_empleado.php" method="POST">
          
          <input type="hidden" name="empleado_id" value="' . $row['cod_empleado'] . '">
      
      
          <div class="form-group">
            <label for="nombre_completo">Codigo empleado</label>
            <span class="form-control" name="cod_empleado" id="nombre_completo">' . $row['cod_empleado'] . '</span>
          </div>
      
                  <div class="form-group">
                      <label for="nombre_completo">Nombre Completo</label>
                      <input type="text" class="form-control" id="nombre_completo" name="nombre_completo" value="' . $row['nombre_completo'] . '">
                  </div>
      
                  <div class="form-group">
                      <label for="correo_electronico">Correo Electrónico</label>
                      <input type="text" class="form-control" id="correo_electronico" name="correo_electronico" value="' . $row['correo_electronico'] . '">
                  </div>
      
                  <div class="form-group">
                      <label for="dpi">DPI</label>
                      <input type="text" class="form-control" id="dpi" name="dpi" value="' . $row['dpi'] . '">
                  </div>
      
                  <div class="form-group">
                      <label for="salario">Salario</label>
                      <input type="number" class="form-control" id="salario" name="salario" value="' . $row['salario'] . '">
                  </div>
      
                  <div class="form-group">
                      <label for="numero_telefono">Número de Teléfono</label>
                      <input type="text" class="form-control" id="numero_telefono" name="numero_telefono" value="' . $row['numero_telefono'] . '">
                  </div>
      
                  <div class="form-group">
                      <label for="conyuge">Cónyuge</label>
                      <input type="text" class="form-control" id="conyuge" name="conyuge" value="' . $row['conyuge'] . '">
                  </div>
      
                  <div class="form-group">
                      <label for="jornada">Jornada</label>
                      <input type="text" class="form-control" id="jornada" name="jornada" value="' . $row['jornada'] . '">
                  </div>
      
                  <div class="form-group">
                      <label for="activo">Activo</label>
                      <input type="text" class="form-control" id="activo" name="activo" value="' . $row['activo'] . '">
                  </div>
      
                  <div class="form-group">
                      <label for="fk_departamento">Departamento:</label>
                      <input type="text" class="form-control" name="fk_departamento" value="' . $row['fk_departamento'] . '">
              
                  </div>
      
      
                  <div class="input-group mb-3">
                  <input type="text" class="form-control" id="foto_empleado" name="foto_empleado" value="">
      
      
                  <button class="btn btn-outline-secondary" type="button" onclick="login()" >Seleccionar foto</button>
                    </div>
      
              
                  <div class="form-group">
                      <label for="fecha_contratacion">Fecha de contratación:</label>
                      <input type="date" class="form-control" name="fecha_contratacion" value="' . $row['fecha_contratacion'] . '">
              
                  </div>
      
                  <div class="form-group">
                      <label for="cartnet_irtra">Carnet del irtra:</label>
                      <input type="text" class="form-control" name="cartnet_irtra" value="' . $row['cartnet_irtra'] . '">
              
                  </div>
      
                  <div class="form-group">
                      <label for="carnet_igss">Carnet del IGSS:</label>
                      <input type="text" class="form-control" name="carnet_igss" value="' . $row['carnet_igss'] . '">
              
                  </div>
      
                  <button type="submit" class="btn btn-primary">Actualizar</button>
              
                  <button type="submit"  class="btn btn-secondary">Cancelar</button>
      
              </form>
              ';
      
      
        } else {
          echo "No se encontró un empleado con ese código.";
        }
      }
      

}

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="firebase-config.js"></script>
    <script src="js/foto_empleado.js"></script>

</body>
</html>
