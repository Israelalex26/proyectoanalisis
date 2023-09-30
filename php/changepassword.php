<?php
// Conexión a la base de datos
$server = "localhost";
$user = "root";
$pass = "";
$db = "prueba";

// Establece la conexión a la base de datos
$conexion = new mysqli($server, $user, $pass, $db);

// Verifica si hay errores en la conexión
if ($conexion->connect_errno){
    die("Conexion Fallida". $conexion->connect_errno);
}

// Verifica si se han recibido los datos del formulario a través de POST
if (isset($_POST['token']) && isset($_POST['contrasena'])) {
    $token = $_POST['token'];
    $contrasena = $_POST['contrasena'];

    // Verificar si el token es válido (existe en la base de datos)
    $consulta_token = "SELECT * FROM tokens WHERE token = '$token'";
    $resultado_token = $conexion->query($consulta_token);

    // Verifica si se encontró un resultado y si hay al menos un token válido
    if ($resultado_token !== false && $resultado_token->num_rows > 0) {
        // Obtiene el ID de usuario asociado al token
        $fila_token = $resultado_token->fetch_assoc();
        $usuario_id = $fila_token['usuario_id'];

        // Actualizar la contraseña del usuario
        $actualizar_contrasena = "UPDATE users SET contrasena = '$contrasena' WHERE id = '$usuario_id'";

        // Verifica si la actualización de la contraseña se realizó con éxito
        if ($conexion->query($actualizar_contrasena)) {
            // Eliminar el token después de usarlo
            $eliminar_token = "DELETE FROM tokens WHERE token = '$token'";
            $conexion->query($eliminar_token);

            // Muestra un mensaje de éxito y redirige a una página específica
            echo '<script>alert("Se modifico la contraseña"); window.location.href = "http://localhost/recuperarcontrasena/index.html";</script>';

            // Sale del script
            exit();
        } else {
            // Si hay un error en la actualización de la contraseña
            echo "Error al actualizar la contraseña.";
        }
    } else {
        // Si el token no es válido o no existe en la base de datos
        echo "Token no válido.";
    }
}
?>