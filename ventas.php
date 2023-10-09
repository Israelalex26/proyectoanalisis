<!DOCTYPE html>

<html>

<head>
    
  <meta charset="UTF-8">
  <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="css/ventas.css" rel="stylesheet" />
  <title>Nomina PA</title>
  
  <!-- Incluye Firebase aquí -->
  <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-storage.js"></script>


</head>

<body>
  <header>
      <div class="logo">
          <img src="img/v42_4.png" alt="Logo">
      </div>
      <nav>
          <ul>

              <li><a href="inicio.html">Inicio</a>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Empleado</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="empleado.html">Empleado</a></li>
                  <li><a class="dropdown-item" href="#">Expediente Empleado</a></li>
                  <li><a class="dropdown-item" href="#">Hora extra</a></li>
                  <li><a class="dropdown-item" href="#">Bono 14</a></li>
                  <li><a class="dropdown-item" href="#">Aguinaldo</a></li>
                  <li><a class="dropdown-item" href="#">Salario</a></li>
                  <li><a class="dropdown-item" href="#">Salario</a></li>


                </ul>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Pólizas</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Polizas</a></li>
                  <li><a class="dropdown-item" href="#">Tipo de Poliza</a></li>
                  <li><a class="dropdown-item" href="#">Anticipo salario</a></li>
                </ul>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Tienda Solidarista</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="ventas.php">Ventas</a></li>
                  <li><a class="dropdown-item" href="producto.php">Producto</a></li>
                  <li><a class="dropdown-item" href="produccion.php">Producción</a></li>
                  <li><a class="dropdown-item" href="comision.php">Comisión</a></li>
                  <li><a class="dropdown-item" href="piezas.php">Piezas</a></li>
                </ul>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Ajustes</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="cambiar_contrasena.php">Cambiar contraseña</a></li>
                  <li><a class="dropdown-item" href="#">Politica y Privacidad</a></li>
                </ul>
              </li>

          </ul>
      </nav>

  
    </header>

  <nav class="nav1">

    <div class="nav10_123">
    </div>

    <span class="title">Agregar venta</span> <!--titulo de la web-->
  
    <form >


    <div class="div_monto">
      <label for="monto" class="label_monto">Monto venta</label>
      <input type="number" id="monto" name="monto" class="input_monto" placeholder="Ingresa en monto de la venta">
  </div>

  <div class="div_descripcion">
    <label for="descripcion" class="label_descripcion">Descripción</label>
    <input type="text" id="descripcion" name="descripcion" class="input_descripcion" placeholder="Ingresa una descripcion">
  </div>

  <div class="div_fecha">
    <label for="fecha_venta" class="label_fecha">Fecha de venta</label>
    <input type="date" id="fecha_venta" name="fecha_venta" class="input_fecha" placeholder="Ingrese la fecha de venta">
</div>

<div class="div_id">
  <label for="id_empleado" class="label_id">ID del empleado</label>
  <input type="id_empleado" id="id_empleado" name="id_empleado" class="input_id" placeholder="Ingrese el ID del empleado">
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


</body>

</html>