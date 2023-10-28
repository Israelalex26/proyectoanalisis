<?php

// confirmar sesion
session_start();
    
if (!isset($_SESSION['loggedin'])) {
    //dirigiendo a la pestaña index que es el login
    header('Location: index.php');

    exit;
}

?>