<?php
// Conexión a la base de datos
$server = "localhost";
$user = "root";
$pass = "";
$db = "nomina";

$conexion = new mysqli($server, $user, $pass, $db);

if ($conexion->connect_errno){
    die("Conexion Fallida". $conexion->connect_errno);
}

if (isset($_POST['token']) && isset($_POST['contrasena'])) {
    $token = $_POST['token'];
    $contrasena = $_POST['contrasena'];

    // Verificar si el token es válido (existe en la base de datos)
    $consulta_token = "SELECT * FROM tokens WHERE token = '$token'";
    $resultado_token = $conexion->query($consulta_token);

    if ($resultado_token->num_rows > 0) {
        $fila_token = $resultado_token->fetch_assoc();
        $usuario_id = $fila_token['usuario_id'];

        // Actualizar la contraseña del usuario
        $actualizar_contrasena = "UPDATE users SET contrasena = '$contrasena' WHERE id = '$usuario_id'";
        if ($conexion->query($actualizar_contrasena)) {
            // Eliminar el token después de usarlo
            $eliminar_token = "DELETE FROM tokens WHERE token = '$token'";
            $conexion->query($eliminar_token);

            // Redirecciona al usuario a una página de éxito o inicio de sesión
            header("Location: index.html");
            exit();
        } else {
            echo "Error al actualizar la contraseña.";
        }
    } else {
        // Token no válido
        echo "Token no válido.";
    }
}
?>
