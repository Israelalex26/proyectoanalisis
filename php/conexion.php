<?php
// Datos de conexión a la base de datos
$db_user = "eacunap";
$db_password = "Holaque2";
$db_service = "orcl"; // Puede ser el nombre del servicio o la cadena de conexión TNS

// Intentar conectar a la base de datos Oracle
$conn = oci_connect($db_user, $db_password, $db_service);

if (!$conn) {
    $e = oci_error();
    echo "Error de conexión: " . htmlentities($e['message'], ENT_QUOTES);
} else {
    echo "Conexión exitosa";
    // Realiza consultas y operaciones en la base de datos aquí
    // Puedes agregar tu código para interactuar con la base de datos en este bloque
    oci_close($conn); // Cerrar la conexión cuando hayas terminado de usarla
}
?>


