<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Email</title>
</head>

<body>
    <form action="email.php" method="post">
        <input type="text" placeholder="name" name="name">
        <input type="email" placeholder="email" name="email">
        <input type="text" placeholder="asunto" name="asunto">
        <textarea placeholder="mensaje" name="msg"></textarea>
        <button type="submit" name="send">Send</button>

    </form>

    
</body>

</html>

<?php

if(isset($_POST['send'])){
    if(!empty($_POST['name']) && !empty($_POST['asunto']) && !empty($_POST['msg']) && !empty($_POST['email']) ){
        $name = $_POST['name'];
        $asunto = $_POST['asunto'];
        $msg = $_POST['msg'];
        $email = $_POST['email'];

        $header = "From: noreply@example.com". "\r\n";
        $header.= "Reply-To: noreply@example.com" . "\r\n";
        $header.= "X-Mailer: PHP/". phpversion();
        $mail = @mail($email, $asunto, $msg, $header);

        if($mail){
            echo "<h4>!MAil enviado exitosamente</h4>";
        }

    }
}

?>
