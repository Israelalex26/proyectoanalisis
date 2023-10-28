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

// Consulta SQL para obtener los datos de la tabla "horaextra" con filtro por nombre de departamento
$sql = "SELECT id_horaextra, fk_cod_empleado,fecha,hora_extra,monto FROM horaextra WHERE fk_cod_empleado LIKE '%$search'";


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
      background-color: #F6F2EB;
      }
    .borrar-btn{
        background-color:#B20000;
        color:#ffffff;
    }
  </style>
</head>

<body>
    <form action="index.php" method="POST">
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
            <input type="text" class="form-control" placeholder="Buscar por codigo del empleado" name="search" aria-label="Buscar" aria-describedby="btnBuscar">
            <button class="btn btn-outline-secondary" type="submit" id="btnBuscar">Buscar</button>
        </div>
    </form>

    <!-- Botón para agregar departamento con margen -->
<form action="horaextra/horaextra.php" method="GET" style="margin-left: 30px;">
    <button class="btn btn-outline-secondary" type="submit" style="background-color: #D99C53; color: black;">
        &#9733; Agregar horas extras
    </button>
</form>



    <table>
        <tr>
            <th>Id hora extra</th>
            <th>Codigo empleado</th>
            <th>Fecha</th>
            <th>Horas extras</th>
            <th>Total hora extra</th>
            <th>Acciones</th>
        </tr>
        <?php
        // Mostrar los datos obtenidos de la tabla "departamento"
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id_horaextra"] . "</td>";
                echo "<td>" . $row["fk_cod_empleado"] . "</td>";
                echo "<td>" . $row["fecha"] . "</td>";
                echo "<td>" . $row["hora_extra"] . "</td>";
                echo "<td>" . $row["monto"] . "</td>";
                echo "<td>
                        <button class='btn borrar-btn' onclick='borrarhora(\"" . $row["id_horaextra"] . "\")'>Borrar</button>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No se encontraron resultados.</td></tr>";
        }
        ?>
    </table>

    <script>
        function borrarhora(idhora) {
            if (confirm("¿Estás seguro que deseas eliminar este departamento?")) {
                window.location.href = "horaextra/eliminar_hora.php?id=" + idhora;
            }
        }
    </script>

    <?php
    // Cerrar la conexión
    $conn->close();
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
