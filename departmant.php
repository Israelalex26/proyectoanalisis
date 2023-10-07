<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Departamentos</title>
    <!-- Agregar enlaces a Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
        <h2>Tabla de Departamentos</h2>

        <form action="departmant.php" method="POST">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Departamento</th>
                    <th>Piso</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input id="departmant" name="departmant" type="text" class="form-control" placeholder="Ingrese el nombre del departamento"></td>
                    <td><input type="number" id="piso" name="piso" class="form-control" placeholder="Ingrese el número de piso"></td>
                </tr>
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Agregar Departamento</button>

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
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}


// Verifica si la solicitud es de tipo POST
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //obten los datos del formulario
    $departmant = $_POST["departmant"];
    $piso = $_POST["piso"];

    //Verifica que todos los campos esten llenos
    if(empty($departmant) || empty($piso)){
        echo  'llenar los campos';
    }else{
        //insertar los datos en la tabla departmant
        $sql_departmant = "INSERT INTO departmant (departmant, piso) VALUES ('$departmant', '$piso');";

        if ($conn->query($sql_departmant) === TRUE) {
            echo '<script>alert("Departamento agregado correctamente."); window.location.href = "http://localhost/proyectoanalisis/ejemplo.php";</script>';
        } else {
            echo '<script>alert("Error al subir a la DB"); window.location.href = "http://localhost/proyectoanalisis/departmant.php";</script>';
        }

    }

}

$conn->close();

?>
