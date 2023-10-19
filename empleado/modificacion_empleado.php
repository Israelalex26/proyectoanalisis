<?php
include('conexion.php');

if ($conn){

include('verificarloggin.php');


    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["empleado_id"])) {
        $empleadoId = $_POST["empleado_id"];
        $nombre_completo = $_POST["nombre_completo"];
        $correo_electronico = $_POST["correo_electronico"];
        $dpi = $_POST["dpi"];
        $salario = $_POST["salario"];
        $numero_telefono = $_POST["numero_telefono"];
        $conyuge = $_POST["conyuge"];
        $jornada = $_POST["jornada"];
        $activo = $_POST["activo"];
        $fk_departamento = $_POST["fk_departamento"];
        $fecha_contratacion = $_POST["fecha_contratacion"];
        $cartnet_irtra = $_POST["cartnet_irtra"];
        $carnet_igss = $_POST["carnet_igss"];
        $foto_empleado = $_POST['foto_empleado'];
    
    
        // Verificar si todos los campos están vacíos
        if (empty($nombre_completo) || empty($correo_electronico) || empty($dpi) || empty($salario) || empty($numero_telefono) ||
            empty($conyuge) || empty($jornada) || empty($activo) || empty($fk_departamento) || empty($fecha_contratacion) || empty($cartnet_irtra) || empty($carnet_igss)) 
        {
            echo "Debe llenar todos los campos.";
        } else {
            // Verificar si el correo electrónico es válido
            if (!filter_var($correo_electronico, FILTER_VALIDATE_EMAIL)) {
                echo "El correo electrónico no es válido.";
            } else {
    
                $sql_empleado = "UPDATE empleado SET nombre_completo='$nombre_completo', correo_electronico='$correo_electronico', dpi='$dpi', salario='$salario', numero_telefono='$numero_telefono', conyuge='$conyuge', 
                    jornada='$jornada',foto_empleado='$foto_empleado' ,activo='$activo', fk_departamento='$fk_departamento', fecha_contratacion='$fecha_contratacion', cartnet_irtra='$cartnet_irtra', carnet_igss='$carnet_igss' 
                WHERE cod_empleado='$empleadoId'";
    
                if ($conn->query($sql_empleado) === TRUE) {
                    echo '<script>alert("El empleado se actualizó correctamente."); window.location.href = "/proyectoanalisis/empleado.php";</script>';
                } else {
                    echo '<div class="alert alert-danger" role="alert">Error al actualizar el empleado: ' . $conn->error . '</div>';
                }
            }
        }
    }
}

?>