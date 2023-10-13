<?php

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "id21355203_nomina";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Conexión a la base de datos fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $cod_empleado = $_POST['cod_empleado'];
    $nombre_completo = $_POST['nombre_completo'];
    $correo_electronico = $_POST['correo_electronico'];
    $dpi = $_POST['dpi'];
    $salario = $_POST['salario'];
    $numero_telefono = $_POST['numero_telefono'];
    $conyuge = $_POST['conyuge'];
    $jornada = $_POST['jornada'];
    $activo = $_POST['activo'];
    $expediente_empleado = $_POST['expediente_empleado'];
    $foto_empleado = $_POST['foto_empleado'];
    $fk_departamento = $_POST['fk_departamento'];
    $fecha_contratacion = $_POST['fecha_contratacion'];
    $cartnet_irtra = $_POST['cartnet_irtra'];
    $carnet_igss = $_POST['carnet_igss'];

    if (!filter_var($correo_electronico, FILTER_VALIDATE_EMAIL)) {
        echo '<script>alert("El correo electrónico ingresado no es válido."); window.location.href = "http://localhost/proyectoanalisis/register.php";</script>';
        exit();
    }else{

        if (
            empty($cod_empleado) || empty($nombre_completo) || empty($correo_electronico) ||
            empty($dpi) || empty($salario) || empty($numero_telefono) || empty($conyuge) ||
            empty($jornada) || empty($activo) || empty($expediente_empleado) || empty($foto_empleado) ||
            empty($fk_departamento) || empty($fecha_contratacion) || empty($cartnet_irtra) 
        ) {
            echo "Por favor, complete todos los campos.";
        } else {
            echo "Todos los campos están completos. Guardando en la base de datos...";
        }

    }

}

$conn->close();
?>