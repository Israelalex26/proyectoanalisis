<?php
// Incluye el archivo de conexión
include('conexion.php');

if ($conn) {

  include('verificarloggin.php');

  $row = null; // Inicializa $row como nulo

  if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $productoId = $_GET["id"];

    $sql = "SELECT * FROM producto WHERE id_producto = $productoId";
    $result = $conn->query($sql);

    if (!$result) {
      die("Error en la consulta: " . $conn->error);
    }

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc(); // Asigna los datos del usuario a $row
    } else {
      echo "No se encontró un usuario con ese ID.";
    }
  }
} else {
  echo "No se pudo establecer conexión a la base de datos.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Nomina Solidarista</title>
    <link href="./css/venderproducto.css" rel="stylesheet" />
</head>

<body>
    <header>
        <div class="logo">
            <img src="img/v42_4.png" alt="Logo">
        </div>
    </header>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Venta Solidarista</h4>
                    </div>
                    <div class="card-body">
                        <form action="confirmarventa.php" method="POST">
                            <input type="hidden" name="producto_id" value="<?php echo $row['id_producto']; ?>">

                            <div class="form-group">
                                <label for="correo">Nombre producto:</label>
                                <input type="text" class="form-control" name="nombre" value="<?php echo $row['nombre']; ?>">
                            </div>

                            <div class="form-group">
                                <label for="correo">Precio:</label>
                                <input type="number" class="form-control" name="precio" id="precio" oninput="calcularMontoTotal()" value="<?php echo $row['precio']; ?>">
                            </div>

                            <div class="form-group">
                                <label for="correo">Cantidad de la compra</label>
                                <input type="number" class="form-control" name="cantidad_compra" id="cantidad_compra" oninput="calcularMontoTotal()">
                            </div>

                            <div class="form-group">
                                <label for="monto_total">Monto total:</label>
                                <input type="number" class="form-control" name="monto_compra" id="monto_total" readonly>
                            </div>

                            <div class="form-group">
                                <label for="correo">Fecha</label>
                                <input type="date" class="form-control" name="date">
                            </div>

                            <div class="form-group">
                                <label for="correo">Descripcion</label>
                                <input type="text" class="form-control" name="descripcion">
                            </div>

                            <div class="form-group">
                                <label for="correo">Codigo del empleado:</label>
                                <input type="number" class="form-control" name="fk_cod_empleado">
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn guardar-button">Actualizar</button>
                        </form>
                    
                        <a href="http://nominasolidarista.wuaze.com/inicio_trabajador.php" class="btn cancelar-button me-2">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function calcularMontoTotal() {
            const precio = parseFloat(document.getElementById("precio").value);
            const cantidadCompra = parseFloat(document.getElementById("cantidad_compra").value);

            if (!isNaN(precio) && !isNaN(cantidadCompra)) {
                const montoTotal = precio * cantidadCompra;
                document.getElementById("monto_total").value = montoTotal.toFixed(2);
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
