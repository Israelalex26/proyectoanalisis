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
$sql = "SELECT id_quincena1,empleado,salario,anticipo,comisiones,igss,irtra,isr,mes,ano,Total,bono14,aguinaldo FROM quincena1 WHERE empleado LIKE '%$search%'";

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
                    <li><a href="inicio.php">Inicio</a></li>
                    
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
            <input type="text" class="form-control" placeholder="Buscar por nombre del empleado" name="search" aria-label="Buscar" aria-describedby="btnBuscar">
            <button class="btn btn-outline-secondary" type="submit" id="btnBuscar">Buscar</button>
        </div>
    </form>

    <!-- Botón para agregar departamento con margen -->
<form action="quincena1/quincena1.php" method="GET" style="margin-left: 30px;">
    <button class="btn btn-outline-secondary" type="submit" style="background-color: #D99C53; color: black;">
        &#9733; Agregar primera quincena
    </button>
</form>



    <table>
        <tr>
            <th>Id quincena</th>
            <th>Nombre</th>
            <th>Salario</th>
            <th>Anticipo</th>
            <th>Comisiones</th>
            <th>Igss</th>
            <th>Irtra</th>
            <th>Isr</th>
            <th>Pago</th>
            <th>Mes</th>
            <th>Año</th>
            <th>Bono 14</th>
            <th>Aguinaldo</th>
            <th>Descargar</th>  
        </tr>
        <?php
        // Mostrar los datos obtenidos de la tabla "departamento"
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id_quincena1"] . "</td>";
                echo "<td>" . $row["empleado"] . "</td>";
                echo "<td>" . $row["salario"] . "</td>";
                echo "<td>" . $row["anticipo"] . "</td>";
                echo "<td>" . $row["comisiones"] . "</td>";
                echo "<td>" . $row["igss"] . "</td>";
                echo "<td>" . $row["irtra"] . "</td>";
                echo "<td>" . $row["isr"] . "</td>";
                echo "<td>" . $row["Total"] . "</td>";
                echo "<td>" . $row["mes"] . "</td>";
                echo "<td>" . $row["ano"] . "</td>";
                echo "<td>" . $row["bono14"] . "</td>";
                echo "<td>" . $row["aguinaldo"] . "</td>";
 
                 echo "<td>
                        <a href='pdf/quincena1.php?id=" . $row["id_quincena1"] . "' target='_blank' class='btn btn-primary'>PDF</a>
                      </td>";
               
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No se encontraron resultados.</td></tr>";
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
