<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet" />
    <link href="./css/changepassword.css" rel="stylesheet" />
    <title>Nomina PA</title>
</head>
<body>
    <img class="logo_pa" src="img/v42_4.png">
    <nav class="nav1_recoverpassword">
        <div class="nav10_123"></div>
        <span class="title">Crear una contraseña</span>
        <span class="description">Debes crear una contraseña que no tengas registrada en otra plataforma para mayor seguridad.</span>
        <form action="changepassword.php" method="POST">
            <div class="div_password">
                <label for="contrasena" class="label_password">Nueva contraseña</label>
                <input type="password" id="contrasena" name="contrasena" class="input_password" placeholder="Ingresa tu nueva contraseña">
            </div>
            <div class="div_repit">
                <label for="repit_password" class="label_repit">Repetir nueva contraseña</label>
                <input type="password" id="repit_password" name="repit_password" class="input_repit" placeholder="Confirma tu nueva contraseña">
            </div>
            <!-- Campo oculto para capturar el ID de usuario -->
            <input type="hidden" name="id_usuario" value="<?php echo $_GET['id_usuario']; ?>">
            <button class="v150_40">
                <span class="v150_41">Cambiar contraseña</span>
            </button>
        </form>
        <button class="v150_35">
            <span class="v150_36">Cancelar</span>
        </button>
    </nav>
</body>
</html>

<?php
// Definir las variables de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "id21355203_nomina";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nueva_contrasena = $_POST['contrasena'];
    $repetir_contrasena = $_POST['repit_password'];

    // Verificar que los campos no estén vacíos
    if (empty($nueva_contrasena) || empty($repetir_contrasena)) {
        echo '<script>alert("Los campos de contraseña no pueden estar vacíos.");</script>';
    } else {
        // Verificar que las contraseñas coincidan
        if ($nueva_contrasena === $repetir_contrasena) {
            if (isset($_POST['id_usuario'])) {
                $id_usuario = $_POST['id_usuario'];

                // Conexión a la base de datos
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Verificar la conexión
                if ($conn->connect_error) {
                    die("Conexión fallida: " . $conn->connect_error);
                }

                // Hashear la nueva contraseña
                $hashed_password = password_hash($nueva_contrasena, PASSWORD_DEFAULT);

                // Actualizar la contraseña en la base de datos
                $sql = "UPDATE usuarios SET contrasena = '$hashed_password' WHERE id_usuario = $id_usuario";

                if ($conn->query($sql) === TRUE) {
                    echo '<script>alert("Contraseña cambiada exitosamente."); window.location.href = "http://localhost/proyectoanalisis/index.php";</script>';
                } else {
                    echo "Error al actualizar la contraseña: " . $conn->error;
                }

                // Cierra la conexión a la base de datos
                $conn->close();
            } else {
                echo "ID de usuario no proporcionado en el formulario.";
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">Las contraseñas no coinciden</div>';
        }
    }
}
?>
