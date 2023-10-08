<!DOCTYPE html>

<html>

<head>
    
  <meta charset="UTF-8">
  <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="css/departamento.css" rel="stylesheet" />
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
            <li><a href="inicio.php">Inicio</a>
            </li>
            <li><a class="dropdown-item" href="empleado.php">Empleado</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Nomina</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Hora extra</a></li>
                    <li><a class="dropdown-item" href="#">Bono 14</a></li>
                    <li><a class="dropdown-item" href="#">Aguinaldo</a></li>
                    <li><a class="dropdown-item" href="#">Departamento</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Tienda Solidarista</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="ventas.html">Ventas</a></li>
                    <li><a class="dropdown-item" href="producto.html">Producto</a></li>
                    <li><a class="dropdown-item" href="produccion.html">Producción</a></li>
                    <li><a class="dropdown-item" href="comision.html">Comisión</a></li>
                    <li><a class="dropdown-item" href="piezas.html">Piezas</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Ajustes</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="changepasswordlogin.html">Cambiar contraseña</a></li>
                    <li><a class="dropdown-item" href="#">Editar usuario</a></li>
                    <li><a class="dropdown-item" href="#">Politica y Privacidad</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</header>

  <nav class="nav1">

    <div class="nav10_123">
    </div>

    <span class="title">Agregar departamento</span> <!--titulo de la web-->
  
    <form action="departamento.php" method="POST">


    <div class="div_departamento">
      <label for="departamento" class="label_departamento">Departamento:</label>
      <input type="text" name="departamento" class="input_departamento" placeholder="Agregar el nombre del departamento0">
  </div>

  <div class="div_piso">
    <label for="piso" class="label_piso">Piso:</label>
    <input type="number" name="piso" class="input_piso" placeholder="Ingresa el número de piso">
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

//Establece  la conexion  a la base de datos

$server = "localhost";
$user = "root";
$pass = "";
$db = "id21355203_nomina";

// Crear una conexión a la base de datos
$conn = new mysqli($server, $user, $pass, $db);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}


// Verifica si la solicitud es de tipo POST
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //obten los datos del formulario
    $departamento = $_POST["departamento"];
    $piso = $_POST["piso"];

    //Verifica que todos los campos esten llenos
    if(empty($departamento) || empty($piso)){

        echo '<script>alert("Debes de llenar todos los campos."); window.location.href = "http://localhost/proyectoanalisis/departamento.php";</script>';

    }else{
        //insertar los datos en la tabla departmant
        $sql_departamento = "INSERT INTO departamento (departamento, piso) VALUES ('$departamento', '$piso');";

        if ($conn->query($sql_departamento) === TRUE) {
            echo '<script>alert("Departamento agregado correctamente."); window.location.href = "http://localhost/proyectoanalisis/departamento.php";</script>';
        } else {
            echo '<script>alert("Error al subir a la DB"); window.location.href = "http://localhost/proyectoanalisis/departamento.php";</script>';
        }

    }

}

$conn->close();

?>