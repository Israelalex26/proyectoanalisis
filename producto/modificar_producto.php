<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Nomina solidarista</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="css/modificarproducto.css" rel="stylesheet">


</head>

<body>
    <div class="container">
        <?php
       // Incluye el archivo de conexión
include('conexion.php');

if ($conn){

    include('verificarloggin.php');


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
                echo '<script>alert("Los datos se actualizaron correctamente."); window.location.href = "http://nominasolidarista.wuaze.com/producto.php";</script>';

            } else {
                echo '<div class="alert alert-danger" role="alert">Error al actualizar el producto: ' . $conn->error . '</div>';
            }
        }

        
}else{
    echo "No se pudo establecer conexión a la base de datos.";

}
        ?>

          <header>
    <div class="logo">
      <img src="img/v42_4.png" alt="Logo">
    </div>
  </header>

        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $idProducto; ?>">
            <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                    <h4>Modificar Producto</h4></div>
                    <div class="card-body">
                        <form action="http://nominasolidarista.wuaze.com/producto/guardar_modificacion.php" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo $row['id_producto']; ?>">

                            <div class="form-group">
                                <label for="nombre">Nombre del Producto</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $row['nombre']; ?>">
                            </div>

                            <div class="form-group">
                                <label for="precio">Precio</label>
                                <input type="text" class="form-control" id="precio" name="precio" value="<?php echo $row['precio']; ?>">
                            </div>

                            <div class="form-group">
                                <label for="cantidad">Cantidad</label>
                                <input type="text" class="form-control" id="cantidad" name="cantidad" value="<?php echo $row['cantidad']; ?>">
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn guardar-button">Actualizar</button>
                            <a href="http://nominasolidarista.wuaze.com/producto.php" class="btn cancelar-button">Cancelar</a>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
        </form>

    
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
