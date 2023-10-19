<?php
// Incluye el archivo de conexión
include('conexion.php');

if ($conn){

    include('verificarloggin.php');


    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
        $userId = $_GET["id"];
      
        // Elimina el producto con el ID especificado
        $sql = "DELETE FROM producto WHERE id_producto = $userId";

if ($conn->query($sql) === TRUE) {
    echo '<script>alert("Producto eliminado con éxito."); window.location.href = "http://nominasolidarista.wuaze.com/producto.php";</script>';

} else {
    echo '<script>alert("Error al eliminar el producto."); window.location.href = "http://nominasolidarista.wuaze.com/producto.php";</script>';

}
}

}else{
    echo "No se pudo establecer conexión a la base de datos.";

}
?>
