<?php

include('conexion.php');

if ($conn) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $productoId = $_POST['producto_id'];
        $nombreProducto = $_POST['nombre'];
        $precio = $_POST['precio'];
        $cantidadCompra = $_POST['cantidad_compra'];
        $montoTotal = $_POST['monto_compra'];
        $descripcion = $_POST['descripcion'];
        $fecha = $_POST['date'];
        $codigoEmpleado = $_POST['fk_cod_empleado'];

        // Verifica que los campos no estén vacíos
        if (!empty($nombreProducto) && !empty($precio) && !empty($cantidadCompra) && !empty($montoTotal) && !empty($fecha) && !empty($codigoEmpleado) && !empty($descripcion)) {

            // Asegura que la cantidad de producto no sea menor que cero
            if ($cantidadCompra <= 0) {
                echo "La cantidad de compra no puede ser cero o negativa.";
            } else {
                // Calcular la comisión según las leyes de Guatemala (por ejemplo, el 1% del monto de compra)
                $comision = $montoTotal * 0.01; // Ajusta el factor según tus necesidades

                // Prepara la consulta SQL para insertar los datos en la tabla "compratiendasolidarista"
                $alterCompraSolidarista = "ALTER TABLE compratiendasolidarista MODIFY COLUMN id_compratiendasolidarista INT AUTO_INCREMENT";

                if ($conn->query($alterCompraSolidarista) !== TRUE) {
                    echo "Error al modificar la tabla compratiendasolidarista: " . $conn->error;
                }

                $sqlCompra = "INSERT INTO compratiendasolidarista (fecha, cantidad_compra, monto_compra, fk_cod_empleado, fk_id_producto) 
                    VALUES ('$fecha', $cantidadCompra, $montoTotal, $codigoEmpleado, $productoId)";

                if ($conn->query($sqlCompra) === TRUE) {
                    echo '<script>alert("La información se guardó correctamente."); window.location.href = "http://nominasolidarista.wuaze.com/inicio_trabajador.php";</script>';
                } else {
                    echo "Error al registrar la venta en la tabla 'compratiendasolidarista': " . $conn->error;
                }

                // Prepara la consulta SQL para insertar los datos en la tabla "ventas"
                $fecha_de_venta = date("Y-m-d H:i:s"); // Puedes ajustar esto según tus necesidades

                $alterVentas = "ALTER TABLE ventas MODIFY COLUMN id_ventas INT AUTO_INCREMENT";

                if ($conn->query($alterVentas) !== TRUE) {
                    echo "Error al modificar la tabla ventas: " . $conn->error;
                }

                $sqlVentas = "INSERT INTO ventas (comision, monto, descripcion, fecha_de_venta, fk_cod_empleado) 
                    VALUES ($comision, $montoTotal, '$descripcion', '$fecha_de_venta', $codigoEmpleado)";

                if ($conn->query($sqlVentas) === TRUE) {
                    echo '<script>alert("La información se guardó correctamente."); window.location.href = "http://nominasolidarista.wuaze.com/inicio_trabajador.php";</script>';

                } else {
                    echo "Error al registrar la venta en la tabla 'ventas': " . $conn->error;
                }
            }

        } else {
            echo "Por favor, complete todos los campos.";
        }
    }
} else {
    echo "No se pudo establecer conexión a la base de datos.";
}


?>