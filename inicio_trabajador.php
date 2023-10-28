<?php
if(isset($_SERVER['HTTP_REFERER']) && !strstr($_SERVER['HTTP_REFERER'], "index.php")) {
    header("Location: index.php");
    exit();
}
?>

<?php
include('conexion.php');

if ($conn){
    // Verifica si ha iniciado sesión o no
    include('verificarloggin.php');

    // Definir las variables de búsqueda
    $searchName = "";
    $searchDate = date("Y-m-d"); // Por defecto, muestra asistencias del día actual

    if (isset($_GET['searchName'])) {
        $searchName = $_GET['searchName'];
    }

    if (isset($_GET['searchDate'])) {
        $searchDate = $_GET['searchDate'];
    }

    // Consulta SQL para obtener los datos de la tabla "asistencia" con filtro por código de empleado y fecha
    $sql = "SELECT id_asistencia, hora_entrada, hora_salida, fecha, fk_cod_empleado FROM asistencia WHERE fk_cod_empleado LIKE '%$searchName%' AND fecha = '$searchDate'";
    $result = $conn->query($sql);
} else {
    echo "No se pudo establecer conexión a la base de datos.";
}

// Agregar esta parte del código después de la consulta original para obtener los expedientes
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="./css/inicio.css" rel="stylesheet" />
    <title>Nomina PA</title>

    <style>
        .navbar {
            background-color: #E9D5B3;
        }

        body {
            background-color: #F6F2EB;
        }
        .horasaldia-btn{
            background-color:#B26100;
            color:#FFFFFF;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="img/v42_4.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
            </a>

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="producto_trabajador.php">Producto</a>
                </li>
            </ul>

            <form action="" method="POST">
                <button type="submit" name="cerrar_sesion" class="btn btn-warning"
                    onclick="return confirm('¿Está seguro de que desea cerrar sesión?')">Cerrar sesión</button>
            </form>

        </div>
    </nav>

    <!-- Formulario de búsqueda por código de empleado y fecha -->
    <form action="" method="GET" class="my-3">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Buscar por código de empleado" name="searchName"
                aria-label="Buscar por código">
            <!--<input type="date" class="form-control" name="searchDate" aria-label="Buscar por fecha">-->
            <button class="btn btn-outline-secondary" type="submit" id="btnBuscar">Buscar</button>
        </div>
    </form>

    <button class="btn btn-outline-secondary" type="submit" onclick="mostrarCuadroDeDialogo()"
        style="background-color: #D99C53; color: black;">&#9733; Agregar asistencia</button>

    <table>
        <tr>
            <th>ID asistencia:</th>
            <th>Código empleado:</th>
            <th>Nombre:</th>
            <th>Hora entrada:</th>
            <th>Hora salida:</th>
            <th>Fecha:</th>
            <th>Horas trabajadas:</th>
            <th>Acciones</th>
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
                echo "<td>" . $row["hora_salida"] . "</td";

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

                echo "<td>
                    <button class='btn horasaldia-btn' onclick='salida(" . $row["id_asistencia"] . ")'>Hora salida</button>
                  </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No se encontraron resultados.</td></tr>";
        }
        ?>
    </table>

    <script>
        function salida(id_asistencia) {
            // Obtén la fecha y hora actual del servidor
            const fechaHoraActual = new Date();
            const horaSalida = fechaHoraActual.toLocaleTimeString();

            // Realiza una solicitud AJAX para actualizar la hora de salida
            const data = new FormData();
            data.append("id_asistencia", id_asistencia);
            data.append("hora_salida", horaSalida);

            fetch("iniciotrabajador/hora_salida.php", {
                method: "POST",
                body: data,
            })
                .then((response) => response.text())
                .then((result) => {
                    alert(result); // Muestra una alerta con la respuesta del servidor
                })
                .catch((error) => {
                    console.error("Error al procesar la solicitud: " + error);
                });
        }

        function mostrarCuadroDeDialogo() {
            const cod_empleado = prompt("Por favor, ingrese su código de empleado:");

            if (cod_empleado !== null && cod_empleado !== "") {
                // Obtiene la hora actual
                const hora_entrada = new Date().toLocaleTimeString();
                // Obtiene la fecha actual y la formatea como "YYYY-MM-DD"
                const fecha = new Date().toISOString().slice(0, 10);

                // Realiza una solicitud AJAX para guardar la asistencia
                const data = new FormData();
                data.append("cod_empleado", cod_empleado);
                data.append("hora_entrada", hora_entrada);
                data.append("fecha", fecha);

                fetch("iniciotrabajador/asistencia.php", {
                    method: "POST",
                    body: data,
                })
                    .then((response) => response.text())
                    .then((result) => {
                        alert(result); // Muestra una alerta con la respuesta del servidor
                    })
                    .catch((error) => {
                        console.error("Error al procesar la solicitud: " + error);
                    });
            }
        }
    </script>

   <?php
    // Cerrar la conexión

    if (isset($_POST['cerrar_sesion'])) {

        include("signout.php");
    
    }


    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>
