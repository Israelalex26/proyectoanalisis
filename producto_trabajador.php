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

        </header>

    <!-- Formulario de búsqueda por nombre -->
    <form action="" method="GET" class="my-3">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Buscar por nombre del producto" name="searchName" aria-label="Buscar por nombre">
            <button class="btn btn-outline-secondary" type="submit" id="btnBuscar">Buscar</button>
        </div>
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
                        <button class='btn borrar-btn' onclick='vender(" . $row["id_producto"] . ")'>Vender</button>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No se encontraron resultados.</td></tr>";
        }
        ?>
    </table>

    <script>
        function vender(idProducto) {
            window.location.href = "vender/venderproducto.php?id=" + idProducto;
        }
    </script>

    <?php
    // Cerrar la conexión
     include('signout.php');
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
