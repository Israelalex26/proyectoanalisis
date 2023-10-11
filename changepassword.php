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
        <div class="nav10_123">
        </div>
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
            <input type="hidden" name="id_usuario" value="1">
         
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el ID de usuario desde el formulario
    $id_usuario = $_POST['id_usuario'];

    // Obtener las contraseñas enviadas por el formulario
    $contrasena = $_POST['contrasena'];
    $repit_password = $_POST['repit_password'];

    // Verificar que ambos campos de contraseña estén llenos y coincidan
    if (!empty($contrasena) && !empty($repit_password) && $contrasena === $repit_password) {
        // Verificar la longitud de la contraseña
        if (strlen($contrasena) >= 8 && strlen($contrasena) <= 16) {
            // Conexión a la base de datos (sustituye 'tu_host', 'tu_usuario', 'tu_contraseña' y 'tu_base_de_datos' con los valores reales)
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "id21355203_nomina";

            // Crear conexión
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Verificar la conexión
            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            //Para incriptar la contraseña
            $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

            // Actualizar la contraseña en la base de datos
            $sql = "UPDATE usuarios SET contrasena='$hashed_password' WHERE id_usuario=$id_usuario";

            if ($conn->query($sql) === TRUE) {
                echo '<script>alert("Contraseña cambiada exitosamente."); window.location.href = "http://localhost/proyectoanalisis/index.php";</script>';
            } else {
                echo "Error al ejecutar la consulta: " . $conn->error;
            }

            $conn->close();
        } else {
            echo '<script>alert("La contraseña debe tener entre 8 y 16 caracteres."); window.location.href = "http://localhost/proyectoanalisis/changepassword.php";</script>';
        }
    } else {
        echo '<script>alert("Las contraseñas no coinciden o están vacías."); window.location.href = "http://localhost/proyectoanalisis/changepassword.php";</script>';
    }
}
?>