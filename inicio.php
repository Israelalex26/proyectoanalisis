<?php
$servername = "localhost";
$username = "id21355203_nomina";
$password = "NominaProyecto@#2";
$dbname = "id21355203_nomina";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta SQL para obtener los datos de la tabla "empleado"
$sql = "SELECT id_usuario, correo_electronico, rol, nombre_usuario FROM usuarios";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="./css/inicio.css" rel="stylesheet" />
    <title>Nomina PA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>
    <form action="php/inicio.php" method="POST">
        <header>
            <div class="logo">
                <img src="img/v42_4.png" alt="Logo">
            </div>
            <nav>
                <ul>
                    <li><a href="inicio.html">Inicio</a>
                    </li>
                    <li><a class="dropdown-item" href="empleado.html">Empleado</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Nomina</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Hora extra</a></li>
                            <li><a class="dropdown-item" href="#">Bono 14</a></li>
                            <li><a class="dropdown-item" href="#">Aguinaldo</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Tienda Solidarista</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="ventas.html">Ventas</a></li>
                            <li><a class="dropdown-item" href="producto.html">Producto</a></li>
                            <li><a class="dropdown-item" href="produccion.html">Producción</a></li>
                            <li><a class="dropdown-item" href="comision.html">Comisión</a></li>
                            <li><a class="dropdown-item" href="piezas.html">Piezas</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Ajustes</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="changepasswordlogin.html">Cambiar contraseña</a></li>
                            <li><a class="dropdown-item" href="#">Editar usuario</a></li>
                            <li><a class="dropdown-item" href="#">Politica y Privacidad</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <button type="submit" name="cerrar_sesion" class="btn btn-outline-secondary" onclick="return confirm('¿Está seguro de que desea cerrar sesión?')">Cerrar sesión</button>
        </header>
    </form>

    <table>
        <tr>
            <th>ID Usuario</th>
            <th>Correo Electrónico</th>
            <th>Rol</th>
            <th>Nombre Usuario</th>
            <th>Acciones</th>
        </tr>
        <?php
        // Mostrar los datos obtenidos de la tabla "empleado"
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id_usuario"] . "</td>";
                echo "<td>" . $row["correo_electronico"] . "</td>";
                echo "<td>" . $row["rol"] . "</td>";
                echo "<td>" . $row["nombre_usuario"] . "</td>";
                echo "<td>
                        <button onclick='editarEmpleado(\"" . $row["id_usuario"] . "\")'>Editar</button>
                        <button onclick='borrarEmpleado(\"" . $row["id_usuario"] . "\")'>Borrar</button>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No se encontraron resultados.</td></tr>";
        }
        ?>
    </table>

    <script>
      
      function editarEmpleado(codEmpleado) {
        // Obtener el elemento del cuerpo del documento
        var body = document.getElementsByTagName("body")[0];

        // Crear un contenedor para el formulario
        var formContainer = document.createElement("div");
        formContainer.className = "container my-4";

        // Crear un formulario
        var form = document.createElement("form");

        // Crear un dropdown para seleccionar el rol
        var rolDropdown = document.createElement("select");
        rolDropdown.className = "form-select mb-3";
        rolDropdown.name = "rol";
        rolDropdown.innerHTML = `
            <option selected>Selecciona un rol</option>
            <option value="trabajador">Trabajador</option>
            <option value="admin">Admin</option>
            <option value="jefe">Jefe</option>
            <option value="pendiente">Pendiente</option>
        `;

        // Crear input para modificar correo electrónico
        var correoInput = document.createElement("input");
        correoInput.className = "form-control mb-3";
        correoInput.type = "email";
        correoInput.name = "correo_electronico";
        correoInput.placeholder = "Nuevo correo electrónico";

        // Crear input para modificar nombre de usuario
        var usuarioInput = document.createElement("input");
        usuarioInput.className = "form-control mb-3";
        usuarioInput.type = "text";
        usuarioInput.name = "nombre_usuario";
        usuarioInput.placeholder = "Nuevo nombre de usuario";

        // Crear botón de guardar cambios
        var guardarButton = document.createElement("button");
        guardarButton.className = "btn btn-primary";
        guardarButton.type = "submit";
        guardarButton.textContent = "Guardar cambios";

        // Agregar elementos al formulario
        form.appendChild(rolDropdown);
        form.appendChild(correoInput);
        form.appendChild(usuarioInput);
        form.appendChild(guardarButton);

        // Agregar formulario al contenedor
        formContainer.appendChild(form);

        // Agregar contenedor al cuerpo del documento
        body.appendChild(formContainer);

        console.log("Editar empleado con código: " + codEmpleado);
    }


        function borrarEmpleado(codEmpleado) {
            // Implementa aquí la lógica para borrar un empleado
            // Puedes redirigir a otra página para confirmar el borrado o mostrar un modal, etc.
            console.log("Borrar empleado con código: " + codEmpleado);
        }

        
    </script>

    <?php
    // Cerrar la conexión
    $conn->close();
    ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


</body>

</html>