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
include('conexion.php');

if ($conn){

    
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nueva_contrasena = $_POST['contrasena'];
    $repetir_contrasena = $_POST['repit_password'];

    // Verificar que los campos no estén vacíos
    if (empty($nueva_contrasena) || empty($repetir_contrasena)) {
        echo '<script>alert("Por favor, llene todo los campos."); window.location.href = "changepassword.php?id_usuario=' . $id_usuario . '";</script>';
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

                //Para incriptar la contraseña
                $contrasena_encrip = password_hash($nueva_contrasena, PASSWORD_DEFAULT);


                // Actualizar la contraseña en la base de datos
                $sql = "UPDATE usuarios SET contrasena = '$contrasena_encrip' WHERE id_usuario = $id_usuario";

                if ($conn->query($sql) === TRUE) {
                    echo '<script>alert("Contraseña cambiada exitosamente."); window.location.href = "index.php";</script>';
                } else {
                    echo '<script>alert("Error al actualizar la contraseña."); window.location.href = "recoverpassword.php";</script>';

                }

                // Cierra la conexión a la base de datos
                $conn->close();
            } else {
                echo '<script>alert("ID de usuario no proporcionado en el formulario."); window.location.href = "recoverpassword.php";</script>';
            }
        } else {
            echo '<script>alert("Las contraseñas no coinciden."); window.location.href = "changepassword.php?id_usuario=' . $id_usuario . '";</script>';

        }
    }
}
}else{
    echo "No se pudo establecer conexión a la base de datos.";
  
  }
?>
