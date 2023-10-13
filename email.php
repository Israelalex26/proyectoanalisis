<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    
    <title>Enviar Email</title>
</head>

<body>
    <form class="" action="email.php" method="post">
     Email <input type="email" name="email" value=""> <br>
     Subject <input type="text" name="subject" value=""> <br>
     Message <input type="text" name="message" value=""> <br>
     <button type="submit" name="enviar">enviar</button>

</form>
</body>
</html>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if(isset($_POST["enviar"])){
$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username ='nominaproyecto8@gmail.com';//Nuestro Gmail yo coloque este mi correo para prueba luego lo voy a hacer con el del proyecto
$mail->Password ='eacnroghrhztckjf';//Nuestra contraseña de aplicacion
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;

$mail->setFrom('nominaproyecto8@gmail.com');//Nuestro Gmail

$mail->addAddress($_POST["email"]);

$mail->isHTML(true);

$mail->Subject = "[Nomina Solidarista] Se cambio tu contraseña"; 
$mail->Body = "Hola nombre_usuario!<br><br>Su contraseña se estableció correctamente.<br><br>Nueva contraseña:" .$_POST["message"]. "<br><br>Si no intentó iniciar sesión en su cuenta, su contraseña puede estar comprometida.<br><br>Visite: <a href='http://localhost/proyectoanalisis/recoverpassword.php'>http://localhost/proyectoanalisis/recoverpassword.php</a> para crear una contraseña nueva y segura para su cuenta de Nomina Solidarista.<br><br>Gracias,<br>El equipo de Nomina Solidarista";

try {
    // ...
    $mail->send();
    echo "Correo enviado correctamente desde el dispositivo:";

} catch (Exception $e) {
    echo "Error al enviar el correo: {$mail->ErrorInfo}";
}

}
?>
