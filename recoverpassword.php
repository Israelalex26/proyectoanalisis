<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet" />
    <link href="./css/recoverpassword.css" rel="stylesheet" />
    <title>Nomina PA</title>
   
</head>
<body>

    <img class="logo_pa" src="img/v42_4.png">

    <nav class="nav1_recoverpassword">
    
        <div class="nav10_123">
        </div>
    
        <span class="title">Recuperar contraseña</span>
    
        <span class="description">Debes de ingresar tu correo electrónico que registraste con nosotros.</span>
    
        <form  action="recoverpassword.php" method="POST">
    
            <div class="div_correo">
              <label for="correo_electronico" class="label_correo">Correo electrónico</label>
              <input type="text" id="correo_electronico" name="correo_electronico" class="input_correo" placeholder="Ingrese su correo electrónico">
            </div>
       
            <button class="v150_40">
              <span class="v150_41">Recuperar contraseña</span>
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

if ($conn) {
// Habilitar la visualización de errores de PHP

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $correo_electronico = $_POST['correo_electronico'];

        $sql = "SELECT id_usuario, correo_electronico FROM usuarios WHERE correo_electronico = '$correo_electronico'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id_usuario = $row["id_usuario"];
            $correo = $row["correo_electronico"];

            // Generar un token único para el enlace de restablecimiento (puedes usar una biblioteca para generar un token seguro)
            $token = bin2hex(random_bytes(16));

            // Almacenar el token en la base de datos asociado al usuario para validación

            // Enviar correo electrónico con el enlace para restablecer la contraseña
            $resetLink = "http://nominasolidarista.wuaze.com/changepassword.php?id_usuario=$id_usuario&token=$token";
            enviar($correo, $resetLink); 
          
            
        } else {
           
            echo '<script>alert("El correo electrónico ingresado no está registrado."); window.location.href = "recoverpassword.php";</script>';
        }
       
    }

} else {
    echo "No se pudo establecer conexión a la base de datos.";}

    use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
       
    function enviar($correo, $link){
 
        require 'phpmailer/src/Exception.php';
        require 'phpmailer/src/PHPMailer.php';
        require 'phpmailer/src/SMTP.php';
                 $mail = new PHPMailer(true);
       
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'nominaproyecto8@gmail.com';
                $mail->Password = 'eacnroghrhztckjf';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;
       
                $mail->setFrom('nominaproyecto8@gmail.com');
                $mail->addAddress($correo);
       
                $mail->isHTML(true);
       
                $mail->CharSet = 'UTF-8';
                $subject = "[Nomina Solidarista] Restablece tu contraseña";
                $body = "<div style='text-align: center;'>
                    <p style='font-weight: bold;'>Restablece tu contraseña de Nomina Solidarista</p>
                    <div style='border: 1px solid #C1C1C1; padding: 20px; border-radius: 5px; display: inline-block;'>
                        <p>Para recuperar tu contraseña, haz clic en el siguiente enlace:</p>
                        <a style='background-color: #1877f2; color: #000000; padding: 10px 20px; text-decoration: none; border-radius: 5px;' href='$link'>Recuperar Contraseña</a>
                        <p>Si no intentaste restablecer tu contraseña, puedes ignorar este correo. <br> Para obtener un nuevo enlace para restablecer la contraseña, visita: <a href='http://nominasolidarista.wuaze.com/recoverpassword.php</a></p>
                        <p>Gracias,<br>El equipo de Nomina Solidarista</p>
                    </div>
                </div>";
                $mail->Subject = $subject;
                $mail->Body = $body;
       
                try {
                    $mail->send();
                    echo '<script>alert("Correo enviado correctamente. Por favor, revisa tu correo para restablecer tu contraseña."); window.location.href = "index.php";</script>';
                } catch (Exception $e) {
                    echo "Error al enviar el correo: {$mail->ErrorInfo}";
                }
            }   
?>
