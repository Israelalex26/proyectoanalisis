<?php

// confirmar sesion
session_start();
    
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit;
}

?>