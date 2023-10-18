<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Modificar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        body {
            background-color: #F6F2EB;
        }
    </style>

</head>

<body>
    <div class="container">
        <h1 class="mt-5">Modificar Producto</h1>
        <?php
       // Incluye el archivo de conexión
include('conexion.php');

if ($conn){

        // Inicializar variables
        $idProducto = "";
        $nombre = "";
        $precio = "";
        $cantidad = "";

        // Verificar si se proporcionó un ID de producto válido en la URL
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $idProducto = $_GET['id'];

            // Consulta SQL para obtener los datos del producto seleccionado
            $sql = "SELECT id_producto, nombre, precio, cantidad FROM producto WHERE id_producto = $idProducto";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $nombre = $row['nombre'];
                $precio = $row['precio'];
                $cantidad = $row['cantidad'];
            } else {
                echo '<div class="alert alert-danger" role="alert">El producto no existe.</div>';
                exit();
            }
        }

        // Procesar el formulario de actualización
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = $_POST['nombre'];
            $precio = $_POST['precio'];
            $cantidad = $_POST['cantidad'];

            // Consulta SQL para actualizar el producto
            $sql = "UPDATE producto SET nombre = '$nombre', precio = '$precio', cantidad = '$cantidad' WHERE id_producto = $idProducto";

            if ($conn->query($sql) === TRUE) {
                echo '<script>alert("Los datos se actualizaron correctamente."); window.location.href = "/proyectoanalisis/producto.php";</script>';

            } else {
                echo '<div class="alert alert-danger" role="alert">Error al actualizar el producto: ' . $conn->error . '</div>';
            }
        }

        
}else{
    echo "No se pudo establecer conexión a la base de datos.";

}
        ?>

        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $idProducto; ?>">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Producto:</label>
                <input type="text" class="form-control" name="nombre" value="<?php echo $nombre; ?>">
            </div>

            <div class="mb-3">
                <label for="precio" class="form-label">Precio:</label>
                <input type="text" class="form-control" name="precio" value="<?php echo $precio; ?>">
            </div>

            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad:</label>
                <input type="text" class="form-control" name="cantidad" value="<?php echo $cantidad; ?>">
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>

        <a href="http://localhost/proyectoanalisis/producto.php" class="btn btn-secondary">Cancelar</a>
        

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
