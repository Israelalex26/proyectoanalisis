<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "id21355203_nomina";

$conn = new mysqli($server, $user, $pass, $db);

if ($conn->connect_error) {
  die("Conexion Fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
  $userId = $_GET["id"];

  // Generar una contraseña aleatoria
  $nuevaContrasena = generarContrasenaAleatoria();

  // Actualizar la contraseña en la base de datos
  $sql = "UPDATE usuarios SET contrasena='$nuevaContrasena' WHERE id_usuario='$userId'";

  if ($conn->query($sql) === TRUE) {
    // Enviar la nueva contraseña por correo electrónico
    enviarCorreoContrasena($userId, $nuevaContrasena);
    echo "Se ha restablecido la contraseña y enviado por correo electrónico.";
  } else {
    echo "Error al restablecer la contraseña: " . $conn->error;
  }
}

$conn->close();

function generarContrasenaAleatoria($length = 8) {
    // Caracteres que se van a incluir en la contraseña
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $contrasena = '';

    // Genera una contraseña aleatoria
    for ($i = 0; $i < $length; $i++) {
        $contrasena .= $characters[rand(0, $charactersLength - 1)];
    }

    return $contrasena;
}


function enviarCorreoContrasena($to, $contrasena) {
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'nominaproyecto8@gmail.com';
    $mail->Password = 'NominaProyecto@#2';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('nominaproyecto8@gmail.com', 'Tienda Solidarista');
    $mail->addAddress($to);
    $mail->isHTML(true);

    $mail->Subject = 'Nueva Contraseña';
    $mail->Body = 'Estimado usuario, tu nueva contraseña es: ' . $contrasena;

    if($mail->send()) {
        echo 'Correo enviado con la nueva contraseña.';
    } else {
        echo 'Error al enviar el correo: ' . $mail->ErrorInfo;
    }
}

// Llama a la función para enviar el correo con la nueva contraseña
enviarCorreoContrasena('acunaelian3639@gmail.com', $nuevaContrasena);


?>
