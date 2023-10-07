<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Ejemplo</title>
    <!-- Agregar enlaces a Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Tabla de Ejemplo</h2>
        <form action="ejemplo.php" method="POST">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Correo Electrónico</th>
                    <th>Nombre de Usuario</th>
                    <th>Departamento</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input id="correo_electronico" name="correo_electronico" type="email" class="form-control" placeholder="Correo Electrónico"></td>
                    <td><input id="nombre_usuario" name="nombre_usuario" type="text" class="form-control" placeholder="Nombre de Usuario"></td>
                    <td><input id="fk_departmant" name="fk_departmant" type="text" class="form-control" placeholder="Nombre del Departamento"></td>
                </tr>
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Agregar Usuario</button>
        </form>
    </div>

    <!-- Agregar enlaces a Bootstrap JS y jQuery (necesarios para algunas funcionalidades de Bootstrap) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php

//Establece  la conexion  a la base de datos

$server = "localhost";
$user = "root";
$pass = "";
$db = "id21355203_nomina";

// Crear una conexión a la base de datos
$conn = new mysqli($server, $user, $pass, $db);

// Verificar la conexión
if ($conn->connect_error) {
    die("Coneccion fallida veridicar base de datos: " . $conn->connect_error);
}


// Verifica si la solicitud es de tipo POST
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //obten los datos del formulario
    $correo_electronico = $_POST["correo_electronico"];
    $nombre_usuario = $_POST["nombre_usuario"];
    $fk_departmant = $_POST["fk_departmant"];
    

    //Verifica que todos los campos esten llenos
    if(empty($correo_electronico) || empty($nombre_usuario) || empty($fk_departmant)){
        echo  'llenar los campos primero por favor';
    }else{
        //insertar los datos en la tabla departmant
        $sql_ejemplo = "INSERT INTO ejemplo (correo_electronico, nombre_usuario, fk_departmant) VALUES ('$correo_electronico', '$nombre_usuario','$fk_departmant');";

        if ($conn->query($sql_ejemplo) === TRUE) {
            echo '<script>alert("empleado agregado correctamente."); window.location.href = "http://localhost/proyectoanalisis/ejemplo.php";</script>';
        } else {
            echo '<script>alert("Error al subir a la DB"); window.location.href = "http://localhost/proyectoanalisis/ejemplo.php";</script>';
        }

    }

}

$conn->close();

?>
