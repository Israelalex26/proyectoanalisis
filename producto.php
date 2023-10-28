<?php
include('conexion.php');

if ($conn){

     //verifica si ha iniciado session o no
     include('verificarloggin.php');


// Definir la variable de búsqueda
$searchName = "";
if (isset($_GET['searchName'])) {
    $searchName = $_GET['searchName'];
}

// Consulta SQL para obtener los datos de la tabla "producto" con filtro por nombre
$sql = "SELECT id_producto, nombre, precio, cantidad FROM producto WHERE nombre LIKE '%$searchName%'";
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

    .editar-btn{
        background-color:#B26100;
        color:#ffffff;
    }
    .borrar-btn{
        background-color:#B20000;
        color:#ffffff;
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
    <!-- Formulario de búsqueda por nombre -->
    <form action="" method="GET" class="my-3">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Buscar por nombre del producto" name="searchName" aria-label="Buscar por nombre">
            <button class="btn btn-outline-secondary" type="submit" id="btnBuscar">Buscar</button>
        </div>
    </form>

    <!-- Botón para agregar producto con margen -->
    <form action="producto/agregar_producto.php" method="GET" style="margin-left: 30px;">
        <button class="btn btn-outline-secondary" type="submit" style="background-color: #D99C53; color: black;">
            &#9733; Agregar producto
        </button>
    </form>

    <table>
        <tr>
            <th>ID Producto</th>
            <th>Nombre del Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Acciones</th>
        </tr>
        <?php
        // Mostrar los datos obtenidos de la tabla "producto"
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id_producto"] . "</td>";
                echo "<td>" . $row["nombre"] . "</td>";
                echo "<td>" . $row["precio"] . "</td>";
                echo "<td>" . $row["cantidad"] . "</td>";
                echo "<td>
                        <button class='btn editar-btn' onclick='editarProducto(" . $row["id_producto"] . ")'>Editar</button>
                        <button class='btn borrar-btn' onclick='borrarProducto(" . $row["id_producto"] . ")'>Borrar</button>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No se encontraron resultados.</td></tr>";
        }
        ?>
    </table>

    <script>
        function borrarProducto(idProducto) {
            if (confirm("¿Estás seguro que deseas eliminar este producto?")) {
                window.location.href = "producto/eliminar_producto.php?id=" + idProducto;
            }
        }

        function editarProducto(idProducto) {
            window.location.href = "producto/modificar_producto.php?id=" + idProducto;
        }
    </script>

    <?php
    // Cerrar la conexión
    $conn->close();
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
