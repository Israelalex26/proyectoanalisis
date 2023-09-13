<?php
// Datos de conexión a la base de datos
$db_user = "eacunap";
$db_password = "Holaque2";
$db_service = "orcl"; // Puede ser el nombre del servicio o la cadena de conexión TNS

// Obtener los valores del formulario de inicio de sesión
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

// Intentar conectar a la base de datos Oracle
$conn = oci_connect($db_user, $db_password, $db_service);

if (!$conn) {
    $e = oci_error();
    echo "Error de conexión: " . htmlentities($e['message'], ENT_QUOTES);
} else {
    // Consulta SQL para buscar el usuario en la base de datos
    $query = "SELECT rol FROM Users WHERE correo_electronico = :correo";
    $stmt = oci_parse($conn, $query);
    oci_bind_by_name($stmt, ':correo', $correo);
    oci_execute($stmt);

    // Verificar si se encontró un usuario
    if ($row = oci_fetch_assoc($stmt)) {
        $rol = $row['ROL'];

        // Verificar el rol y redirigir según el rol
        if ($contrasena == 'contrasena1' || $contrasena == 'contrasena2') {
            
            if ($rol == "admin" || $rol == "jefe" || $rol == "recursos_humanos") {
                header("Location: home.php");
                exit();
            } else {
                echo "No tienes acceso a esta área.";
            }

        } else {
            echo "La contraseña es incorrecta.";
        }
    } else {
        echo "El correo electrónico no existe en la base de datos.";
    }

    // Cerrar la conexión
    oci_free_statement($stmt);
    oci_close($conn);
}
?>
