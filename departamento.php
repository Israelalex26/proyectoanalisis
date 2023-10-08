<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "id21355203_nomina";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Definir la variable de búsqueda
$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

// Consulta SQL para obtener los datos de la tabla "departamento" con filtro por nombre de departamento
$sql = "SELECT departamento, piso FROM departamento WHERE departamento LIKE '%$search%'";
$result = $conn->query($sql);
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
                    <li><a class="dropdown-item" href="empleado.php">Empleado</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Nomina</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Hora extra</a></li>
                            <li><a class="dropdown-item" href="#">Bono 14</a></li>
                            <li><a class="dropdown-item" href="#">Aguinaldo</a></li>
                            <li><a class="dropdown-item" href="departamento.php">Departamento</a></li>
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
            <button type="submit" name="cerrar_sesion" class="btn btn-outline-secondary" onclick="return confirm('¿Está seguro de que desea cerrar sesión?')">Cerrar sesión</button>
        </header>
    </form>

    <!-- Formulario de búsqueda -->
    <form action="" method="GET" class="my-3">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Buscar por nombre del departamento" name="search" aria-label="Buscar" aria-describedby="btnBuscar">
            <button class="btn btn-outline-secondary" type="submit" id="btnBuscar">Buscar</button>
        </div>
    </form>

    <table>
        <tr>
            <th>Nombre del Departamento</th>
            <th>Piso</th>
            <th>Acciones</th>
        </tr>
        <?php
        // Mostrar los datos obtenidos de la tabla "departamento"
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["departamento"] . "</td>";
                echo "<td>" . $row["piso"] . "</td>";
                echo "<td>
                        <button onclick='editarDepartamento(\"" . $row["departamento"] . "\")'>Editar</button>
                        <button onclick='borrarDepartamento(\"" . $row["departamento"] . "\")'>Borrar</button>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No se encontraron resultados.</td></tr>";
        }
        ?>
    </table>

    <script>
        function borrarDepartamento(nombreDepartamento) {
            if (confirm("¿Estás seguro que deseas eliminar este departamento?")) {
                window.location.href = "departamento/eliminar_departamento.php?nombre=" + nombreDepartamento;
            }
        }

        function editarDepartamento(nombreDepartamento) {
            window.location.href = "departamento/modificar_departamento.php?nombre=" + nombreDepartamento;
        }
    </script>

    <?php
    // Cerrar la conexión
    $conn->close();
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>