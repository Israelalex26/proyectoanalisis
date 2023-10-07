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
                    <td><input type="text" class="form-control" placeholder="Ingrese el nombre del departamento"></td>
                    <td><input type="number" class="form-control" placeholder="Ingrese el número de piso"></td>
                </tr>
            </tbody>
        </table>
        <button class="btn btn-primary">Agregar Departamento</button>

        </form>
       
    </div>

    <!-- Agregar enlaces a Bootstrap JS y jQuery (necesarios para algunas funcionalidades de Bootstrap) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>



