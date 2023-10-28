<?php
include('conexion.php');

if ($conn) {
    // Verifica si ha iniciado sesión o no
    include('verificarloggin.php');

    // Definir la variable de búsqueda
    $searchName = "";
    if (isset($_GET['searchName'])) {
        $searchName = $_GET['searchName'];
    }

    // Consulta SQL para obtener los datos de la tabla "asistencia" con filtro por fecha
    $sql = "SELECT id_asistencia, hora_entrada, fecha, hora_salida, fk_cod_empleado FROM asistencia WHERE fecha LIKE '%$search'";
    $result = $conn->query($sql);
} else {
    echo "No se pudo establecer conexión a la base de datos.";
}

// Agregar esta parte del código después de la consulta original para obtener el nombre del empleado
function obtenerNombreEmpleado($codigoEmpleado, $conn) {
    $sql = "SELECT nombre_completo FROM empleado WHERE cod_empleado = '$codigoEmpleado'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["nombre_completo"];
    } else {
        return "Empleado no encontrado";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="./css/inicio.css" rel="stylesheet" />
    <title>Nomina Solidarista</title>

    <style>
        .editar-btn {
            background-color: #B26100;
            color: #ffffff;
        }

        .borrar-btn {
            background-color: #B20000;
            color: #ffffff;
        }
    </style>
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
 
    <!-- Formulario de búsqueda por fecha -->
    <form action="" method="GET" class="my-3">
        <div class="input-group">
            <input type="date" class="form-control" placeholder="Buscar por fecha de asistencia" name="search" aria-label="Buscar por fecha">

            <button class="btn btn-outline-secondary" type="submit" id="btnBuscar">Buscar</button>
        </div>
    </form>

      <table>
    <tr>
        <th>ID asistencia:</th>
        <th>Código empleado:</th>
        <th>Nombre:</th>
        <th>Hora entrada:</th>
        <th>Hora salida:</th>
        <th>Fecha:</th>
        <th>Horas trabajadas:</th>
    </tr>
    <?php
    // Mostrar los datos obtenidos de la tabla "asistencia"
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id_asistencia"] . "</td>";
            echo "<td>" . $row["fk_cod_empleado"] . "</td>";
            echo "<td>" . obtenerNombreEmpleado($row["fk_cod_empleado"], $conn) . "</td>";
            echo "<td>" . $row["hora_entrada"] . "</td>";
            echo "<td>" . $row["hora_salida"] . "</td>";
            
            // Calcular las horas trabajadas
            if ($row["hora_salida"] == '00:00:00') {
                echo "<td>".$row["fecha"]."</td>";
                echo "<td>Trabajando</td>";
            } else {
                $horaEntrada = new DateTime($row["hora_entrada"]);
                $horaSalida = new DateTime($row["hora_salida"]);
                $diferencia = $horaEntrada->diff($horaSalida);
                $horasTrabajadas = $diferencia->h . " horas " . $diferencia->i . " minutos";
                echo "<td>" . $row["fecha"] . "</td>";
                echo "<td>" . $horasTrabajadas . "</td>";
            }
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No se encontraron resultados.</td></tr>";
    }
    ?>
</table>


    <?php
    // Cerrar la conexión
    $conn->close();
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
