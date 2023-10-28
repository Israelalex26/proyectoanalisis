<?php
include('conexion.php');

if ($conn) {
    include('verificarloggin.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["historialsalarioId"])) {
        $historialsalarioId = $_POST["historialsalarioId"];
        $codEmpleado = $_POST["cod_empleado"];
        $nuevosalario = $_POST["salario_nuevo"];
        $salario_anterior = $_POST["salario_anterior"];

        if (empty($nuevosalario) || empty($salario_anterior) || empty($codEmpleado)) {
            echo "Por favor, complete todos los campos.";
            exit();
        } else {
            // Actualiza los datos en la base de datos
            $sql = "UPDATE historialsalario SET salario_nuevo='$nuevosalario', salario_anterior='$salario_anterior' WHERE id_historialsalario ='$historialsalarioId'";

            if ($conn->query($sql) === TRUE) {
                $sqlEmpleado = "UPDATE empleado SET salario='$nuevosalario' WHERE cod_empleado = '$codEmpleado'";

                if ($conn->query($sqlEmpleado) === TRUE) {
                    echo '<script>alert("Los datos se actualizaron correctamente."); window.location.href = "http://nominasolidarista.wuaze.com/historialsalario.php";</script>';
                } else {
                    echo '<div class="alert alert-danger" role="alert">Error al actualizar el salario del empleado: ' . $conn->error . '</div>';
                }
            } else {
                echo '<div class="alert alert-danger" role="alert">Error al actualizar el historial de salario: ' . $conn->error . '</div>';
            }
        }
    }
} else {
    echo "No se pudo establecer conexión a la base de datos.";
}
?>
