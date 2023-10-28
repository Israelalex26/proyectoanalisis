<!DOCTYPE html>
<html>
<head>
    <title>Nomina PA</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="./css/inicio.css" rel="stylesheet" />

</head>
<body>

    <form action="index.php" method="POST">
        <header>
            <div class="logo">
                <img src="img/v42_4.png" alt="Logo">
            </div>
            <nav>
                <ul>
                    <li><a href="inicio.php">Inicio</a>
                    </li>

                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Empleado</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="empleado.php">Empleado</a></li>
                        <li><a class="dropdown-item" href="expediente.php">expediente</a></li>
                        <li><a class="dropdown-item" href="asistenciaestadistica.php">Estadistica asistencia</a></li>
                    </ul>
                </li>

                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Planilla</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="planilla.php">IGSS</a></li>
                    </ul>
                </li>
                
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Nomina</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="extra.php">Hora extra</a></li>
                            <li><a class="dropdown-item" href="historialsalario.php">Historial Salario</a></li>
                            <li><a class="dropdown-item" href="quincena1.php">Primera  Quincena</a></li>
                            <li><a class="dropdown-item" href="quincena2.php">Segunda Quincena</a></li>
                             <li><a class="dropdown-item" href="liquidacion.php">Liquidacion</a></li>
                    
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Tienda Solidarista</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="ventas.php">Ventas</a></li>
                            <li><a class="dropdown-item" href="producto.php">Producto</a></li>
                            <li><a class="dropdown-item" href="comprasolidarista.php">Compra tienda Solidarista</a></li>
                            <li><a class="dropdown-item" href="asistencia.php">Asistencia</a></li>
                             <li><a class="dropdown-item" href="departamento.php">Departamento</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Ajustes</a>
                        <ul class="dropdown-menu"> 
                            <li><a class="dropdown-item" href="cambiar_contrasena.php">Cambiar contraseña</a></li>
                            <li><a class="dropdown-item" href="polity_terms.php">Politica y Privacidad</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>
    </form>


    <div class="container">
        <label>Estadísticas de Ventas por Mes</label>

        <!-- diseño de la grafica por mes -->
        <div class="row">
            <div class="col-md-6">
                <canvas id="ventasPorMesChart" width="800" height="800"></canvas>
            </div>
        </div>
    </div>

    <?php
    include('conexion.php');

    if ($conn) {

        // obtener las ventas por mes
        function obtenerVentasPorMes() {
            global $conn;
            $queryVentasPorMes = "SELECT MONTH(fecha_de_venta) AS Mes, SUM(monto) AS TotalVentas FROM ventas GROUP BY Mes";
            $resultVentasPorMes = $conn->query($queryVentasPorMes);
            $ventasPorMes = array();

            while ($row = $resultVentasPorMes->fetch_assoc()) {
                $ventasPorMes[$row["Mes"]] = $row["TotalVentas"];
            }

            return $ventasPorMes;
        }
    }
    ?>

    <script>
        // Función para mostrar la gráfica de ventas por mes
        function mostrarGrafica() {
            var data = <?php echo json_encode(obtenerVentasPorMes()); ?>;
            var labels = [];
            var values = [];

            for (var mes in data) {
                labels.push(mes);
                values.push(data[mes]);
            }

            // Datos para el gráfico de Ventas por Mes
            var ventasPorMesData = {
                labels: labels,
                datasets: [{
                    label: "Ventas por Mes",
                    data: values,
                    backgroundColor: "#D99C53",
                }],
            };

            // Crear y mostrar la gráfica de ventas por mes
            var ventasPorMesChart = new Chart(document.getElementById("ventasPorMesChart"), {
                type: 'bar',
                data: ventasPorMesData,
                options: {
                    responsive: true,
                }
            });
        }

        // Mostrar la gráfica inicialmente al cargar la página
        mostrarGrafica();
    </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
