<?php

include('conexion.php');

if ($conn){

     //verifica si ha iniciado session o no
     include('verificarloggin.php');


    // Definir la variable de búsqueda
$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    
}

// Consulta SQL para obtener los datos de la tabla "empleado" con filtro por código de empleado o nombre completo
$sql = "SELECT * FROM empleado WHERE cod_empleado LIKE '%$search%' OR nombre_completo LIKE '%$search%'";
$result = $conn->query($sql);
}else{
    echo "No se pudo establecer conexión a la base de datos.";
  
  }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="./css/inicio.css" rel="stylesheet" />
    <title>Nomina PA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
    body{
        background-color:#F6F2EB;
    }
    .editar-btn{
        background-color:#D99C53;
        color:#ffffff;
    }
    .borrar-btn{
        background-color:#D40000;
        color:#ffffff;
    }
    </style>


</head>

<body>
    <form action="empleado.php" method="POST">
                <header>
            <div class="logo">
                <img src="img/v42_4.png" alt="Logo">
            </div>
            <nav>
                <ul>
                    <li><a href="inicio.php">Inicio</a>
                    </li>

                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Empleado</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="empleado.php">Empleado</a></li>
                        <li><a class="dropdown-item" href="expediente.php">expediente</a></li>
                        <li><a class="dropdown-item" href="asistenciaestadistica.php">Estadistica asistencia</a></li>
                    </ul>
                </li>
                    
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Planilla</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="planilla.php">IGSS</a></li>
                    </ul>
                </li>
                    

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Nomina</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="extra.php">Hora extra</a></li>
                            <li><a class="dropdown-item" href="historialsalario.php">Historial Salario</a></li>
                            <li><a class="dropdown-item" href="quincena1.php">Primera  Quincena</a></li>
                            <li><a class="dropdown-item" href="quincena2.php">Segunda Quincena</a></li>
                             <li><a class="dropdown-item" href="liquidacion.php">Liquidacion</a></li>
 
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Tienda Solidarista</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="ventas.php">Ventas</a></li>
                            <li><a class="dropdown-item" href="producto.php">Producto</a></li>
                            <li><a class="dropdown-item" href="comprasolidarista.php">Compra tienda Solidarista</a></li>
                            <li><a class="dropdown-item" href="asistencia.php">Asistencia</a></li>
                            <li><a class="dropdown-item" href="estadistica.php">Estadistica grafica</a></li>
                             <li><a class="dropdown-item" href="departamento.php">Departamento</a></li>

                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Ajustes</a>
                        <ul class="dropdown-menu"> 
                            <li><a class="dropdown-item" href="cambiar_contrasena.php">Cambiar contraseña</a></li>
                            <li><a class="dropdown-item" href="polity_terms.php">Politica y Privacidad</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>
    </form>

   <!-- Formulario de búsqueda -->
   <form action="" method="GET" class="my-3">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Buscar por código de empleado o nombre completo" name="search" aria-label="Buscar" aria-describedby="btnBuscar">
            <button class="btn btn-outline-secondary" type="submit" id="btnBuscar">Buscar</button>
        </div> 
    </form>


        <!-- Botón para agregar departamento con margen -->
    <form action="empleado/agregar_empleado.php" method="GET" style="margin-left: 30px;">
      <button class="btn btn-outline-secondary" type="submit" style="background-color: #D99C53; color: black;">
        &#9733; Agregar Empleado
      </button>
    </form>

    <div class="container mt-3">
        <table class="table">
        <thead>
                <tr>
                    <th>Codigo empleado</th>
                    <th>Nombre</th>
                    <th>Correo electronico</th>
                    <th>Número de telefono</th>
                    <th>acciones:</th>
                </tr>
                </thead>
            <tbody>

            <?php
                // Mostrar los datos obtenidos de la tabla "empleado"
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr data-bs-toggle='collapse' data-bs-target='#collapse_" . $row["cod_empleado"] . "' aria-expanded='false'>";
                        echo "<td>" . $row["cod_empleado"] . "</td>";
                        echo "<td>" . $row["nombre_completo"] . "</td>";
                        echo "<td>" . $row["correo_electronico"] . "</td>";
                        echo "<td>" . $row["numero_telefono"] . "</td>";
                        echo "<td>"; // Inicia la celda de acciones
                        echo "<button class='btn editar-btn' onclick='editarEmpleado(\"" . $row["cod_empleado"] . "\")'>Editar</button><br>";
                        echo "<button class='btn borrar-btn' onclick='borrarEmpleado(\"" . $row["cod_empleado"] . "\")'>Borrar</button><br>";
                        echo "</td>"; // Cierra la celda de acciones
                        echo "</tr>";
                        echo "<tr id='collapse_" . $row["cod_empleado"] . "' class='collapse'>";
                        echo "<td colspan='4'>";
                        // Aquí puedes mostrar más información sobre el empleado
                        echo "DPI: " . $row["dpi"] . "<br>";
                        echo "Salario: " . $row["salario"] . "<br>";
                        echo "conyuge: " . $row["conyuge"] . "<br>";
                        echo "jornada: " . $row["jornada"] . "<br>";
                        echo "activo: " . $row["activo"] . "<br>";
                        echo "Foto: <img src='" . $row["foto_empleado"] . "' alt='Foto del empleado' width='50' height='50'><br>" ;
                        echo "Departamento: " . $row["fk_departamento"] . "<br>";
                        echo "Fecha de contratación: " . $row["fecha_contratacion"] . "<br>";
                        echo "Carnet irtra: " . $row["cartnet_irtra"] . "<br>";
                        echo "Carnet IGSS: " . $row["carnet_igss"] . "<br>";
                        // Agrega más información según tus necesidades
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No se encontraron resultados.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        // Resto del código JavaScript para los botones de editar y borrar
        function borrarEmpleado(codempleado) {
            if (confirm("¿Estás seguro que deseas eliminar este empleado?")) {
                window.location.href = "empleado/eliminar_empleado.php?nombre=" + codempleado;
            }
        }

        function editarEmpleado(codEmpleado) {
            window.location.href = "empleado/editar_empleado.php?nombre=" + codEmpleado;
        }
    
    </script>

    <?php
    // Cerrar la conexión
    $conn->close();
    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>