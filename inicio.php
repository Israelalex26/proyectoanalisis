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

// Consulta SQL para obtener los datos de la tabla "usuarios" con filtro por correo electrónico o nombre de usuario
$sql = "SELECT id_usuario, correo_electronico, rol, nombre_usuario FROM usuarios WHERE correo_electronico LIKE '%$search%' OR nombre_usuario LIKE '%$search%'";
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
                            <li><a class="dropdown-item" href="polity_terms.php">Politica y Privacidad</a></li>
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
            <input type="text" class="form-control" placeholder="Buscar por usuario o correo electrónico" name="search" aria-label="Buscar" aria-describedby="btnBuscar">
            <button class="btn btn-outline-secondary" type="submit" id="btnBuscar">Buscar</button>
        </div>
    </form>

    <table>
        <tr>
            <th>ID Usuario</th>
            <th>Correo Electrónico</th>
            <th>Rol</th>
            <th>Nombre Usuario</th>
            <th>Acciones</th>
        </tr>
        <?php
        // Mostrar los datos obtenidos de la tabla "usuarios"
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id_usuario"] . "</td>";
                echo "<td>" . $row["correo_electronico"] . "</td>";
                echo "<td>" . $row["rol"] . "</td>";
                echo "<td>" . $row["nombre_usuario"] . "</td>";
                echo "<td>
                        <button onclick='editarEmpleado(\"" . $row["id_usuario"] . "\")'>Editar</button>
                        <button onclick='borrarEmpleado(\"" . $row["id_usuario"] . "\")'>Borrar</button>
                        <button onclick='restablerContrasena(\"" . $row["id_usuario"] . "\")'>Restablecer contraseña</button>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No se encontraron resultados.</td></tr>";
        }
        ?>
    </table>

    <script>
        function borrarEmpleado(userId) {
            if (confirm("¿Estás seguro que deseas eliminar este usuario?")) {
                window.location.href = "usuario/eliminar_usuario.php?id=" + userId;
            }
        }

        function editarEmpleado(codEmpleado) {
            window.location.href = "usuario/modificar_usuario.php?id=" + codEmpleado;
        }

        function restablerContrasena(codEmpleado) {
            window.location.href = "usuario/restablecercontrasena.php?id=" + codEmpleado;
        }
    </script>

    <?php
    // Cerrar la conexión
    $conn->close();
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
