<?php
// Incluye el archivo de conexión
include('conexion.php');

if ($conn){

  include('verificarloggin.php');


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
  $userId = $_GET["id"];

  // Generar una contraseña aleatoria
  $nuevaContrasena = generarContrasenaAleatoria();

  // Para incriptar la contraseña
  $hashed_password = password_hash($nuevaContrasena, PASSWORD_DEFAULT);

  // Obtener la dirección de correo electrónico y nombre del usuario
  $result = $conn->query("SELECT correo_electronico, nombre_usuario FROM usuarios WHERE id_usuario='$userId'");

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $correoUsuario = $row["correo_electronico"];
    $nombreUsuario = $row["nombre_usuario"];

     //Para incriptar la contraseña
     $contrasena_encrip = password_hash($nuevaContrasena, PASSWORD_DEFAULT);


    // Actualizar la contraseña en la base de datos
    $sql = "UPDATE usuarios SET contrasena='$contrasena_encrip' WHERE id_usuario='$userId'";

    if ($conn->query($sql) === TRUE) {
      // Enviar la nueva contraseña por correo electrónico al usuario
      enviarCorreoContrasena($correoUsuario, $nuevaContrasena, $nombreUsuario);
      echo '<script>alert("Se ha restablecido la contraseña y enviado por correo electrónico."); window.location.href = "/proyectoanalisis/inicio.php";</script>';
    } else {
      echo '<script>alert("Error al restablecer la contraseña."); window.location.href = "/proyectoanalisis/inicio.php";</script>';

    }
  } else {
    echo '<script>alert("Error al restablecer la contraseña."); window.location.href = "/proyectoanalisis/inicio.php";</script>';
  }
}
}else{
  echo "No se pudo establecer conexión a la base de datos.";

}



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

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function enviarCorreoContrasena($to, $contrasena, $nombreUsuario) {
    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username ='nominaproyecto8@gmail.com';
    $mail->Password ='eacnroghrhztckjf';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('nominaproyecto8@gmail.com');
    $mail->addAddress($to);

    $mail->isHTML(true);

    $mail->CharSet = 'UTF-8'; 
    $mail->Subject = "[Nomina Solidarista] Se cambió tu contraseña";
    $mail->Body = "Hola " . $nombreUsuario . "<br><br>Su contraseña se estableció correctamente.<br><br>Nueva contraseña: " . $contrasena . "<br><br>Si no intentó iniciar sesión en su cuenta, su contraseña puede estar comprometida.<br><br>Visite: <a href='http://localhost/proyectoanalisis/recoverpassword.php'>http://localhost/proyectoanalisis/recoverpassword.php</a> para crear una contraseña nueva y segura para su cuenta de Nomina Solidarista.<br><br>Gracias,<br>El equipo de Nomina Solidarista";

    try {
        $mail->send();
        echo '<script>alert("Se ha restablecido la contraseña y enviado por correo electrónico."); window.location.href = "/proyectoanalisis/inicio.php";</script>';
    } catch (Exception $e) {
    echo '<script>alert("Error al enviar el correo."); window.location.href = "/proyectoanalisis/inicio.php";</script>';

        
    }
}

?>
