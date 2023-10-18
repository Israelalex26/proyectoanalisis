<!DOCTYPE html>

<html>

<head>
    
  <meta charset="UTF-8">
  <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="css/producto.css" rel="stylesheet" />
  <title>Nomina PA</title>
  
  <!-- Incluye Firebase aquí -->
  <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-storage.js"></script>


</head>

<body>
 

<nav class="nav1">

<div class="nav10_123">
</div>

<span class="title">Agregar producto</span> <!--titulo de la web-->

<form action="agregar_producto.php" method="POST">

<div class="div_nombre">
<label for="nombre" class="label_nombre">Nombre</label>
<input type="text" id="nombre" name="nombre" class="input_nombre" placeholder="Ingresa el nombre del producto">
</div>

<div class="div_precio">
<label for="precio" class="label_precio">Precio</label>
<input type="number" id="precio" name="precio" class="input_precio" placeholder="Ingrese el precio del producto">
</div>

<div class="div_cantidad">
<label for="cantidad" class="label_cantidad">Cantidad</label>
<input type="number" id="cantidad" name="cantidad" class="input_cantidad" placeholder="Ingrese la cantidad del producto">
</div>



<button class="v150_35">
<span class="v150_36">Cancelar</span>
</button>


<button class="v150_40">
<span class="v150_41">Guardar</span>
</button>

</form>


</nav>



      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
      <script src="js/foto_empleado.js"></script>  


</body>

</html>

<?php
// Incluye el archivo de conexión
include('conexion.php');

if ($conn){

// Recuperar datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $precio = isset($_POST['precio']) ? $_POST['precio'] : '';
    $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : '';

    // Verificar que los campos no estén vacíos
    if (empty($nombre) || empty($precio) || empty($cantidad)) {
        echo '<script>alert("Por favor, complete todos los campos."); window.location.href = "/proyectoanalisis/producto/agregar_producto.php";</script>';
        exit();
    }else{

     // Modificar la estructura de la tabla para hacer que "id_users" sea autoincremental
  $alterTableSql = "ALTER TABLE producto MODIFY COLUMN id_producto INT AUTO_INCREMENT";

  if ($conn->query($alterTableSql) === TRUE) {
      // Ahora, la columna "id_users" está configurada como autoincremental

      // Insertar datos en la tabla "users" sin especificar un valor para "id_users"
      $sql = "INSERT INTO producto (nombre, precio, cantidad) VALUES ('$nombre', '$precio', '$cantidad')";

      if ($conn->query($sql) === TRUE) {
          echo '<script>alert("Registro exitoso, Espere un momento."); window.location.href = "/proyectoanalisis/producto.php";</script>';
      } else {
          echo '<script>alert("Error al registrar producto:"); window.location.href = "/proyectoanalisis/producto/agregar_producto.php";</script>';
      }
  } else {
      echo '<script>alert("Error al modificar"); window.location.href = "/proyectoanalisis/producto/agregar_producto.php";</script>';
  }


 
    }

    
}

}else{
    echo "No se pudo establecer conexión a la base de datos.";

}
?>