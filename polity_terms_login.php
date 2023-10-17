<!DOCTYPE html>

<html>

<head>
    
  <meta charset="UTF-8">
  <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="./css/polity_terms_login.css" rel="stylesheet" />
  <title>Nomina PA</title>

</head>

<body>
  <header>

      <div class="logo">
          <img src="img/v42_4.png" alt="Logo">
      </div>
      
      <form action="polity_terms_login.php" method="POST">

        
        <div class="input-group">
          <input type="email" id="correo_electronico" name="correo_electronico" aria-label="First name" class="form-control" placeholder="Ingrese su contraseña">
          <input type="password" id="contrasena" name="contrasena" aria-label="Last name" class="form-control" placeholder="Ingrese su contraseña ">

          <button type="submit" class="btn btn-dark">Iniciar sesión</button>
          <button type="submit" class="btn btn-outline-secondary" formaction="register.php">Crear cuenta</button>
    

        </div>
        

      </form>

  
    </header>


    <nav class="nav1">

      <div class="nav10_123">
      </div>

    <span class="title">Términos y Condiciones del Servicio de Gestión de Nómina</span> <!--titulo de la web-->


    <span class="title_1">1. Introducción</span> <!--titulo de la web-->
    <span class="description_1">Estos términos y condiciones ("Términos") establecen las disposiciones para la prestación de servicios de gestión de nómina por parte de T Consulting, S.A. ("Nosotros", "Nuestro" o "La Empresa") a nuestros Clientes ubicados en Guatemala.</span> <!--Descripcion de la web-->


    <span class="title_2">2. Alcance del Servicio</span> <!--titulo de la web-->
    <span class="description_2">Nuestro servicio de gestión de nómina incluye el procesamiento y administración de datos relacionados con la nómina de los empleados de su empresa, cumpliendo con las leyes laborales y fiscales vigentes en Guatemala, y abarcando aspectos como salarios, impuestos, deducciones y otros elementos financieros y legales.</span> <!--Descripcion de la web-->



    <span class="title_3">3. Responsabilidades del Cliente</span> <!--titulo de la web-->
    <span class="description_3">El Cliente es responsable de proporcionar información precisa y completa para la gestión de la nómina. Cualquier inexactitud en la información proporcionada es responsabilidad exclusiva del Cliente.</span> <!--Descripcion de la web-->


    <span class="title_4">4. Privacidad y Cumplimiento Legal</span> <!--titulo de la web-->
    <span class="description_4">Respetamos la privacidad y nos comprometemos a cumplir con la legislación guatemalteca de protección de datos y privacidad. Consulte nuestra Política de Privacidad para obtener más detalles sobre cómo manejamos sus datos.</span> <!--Descripcion de la web-->


    <span class="title_5">5. Propiedad de los Datos</span> <!--titulo de la web-->
    <span class="description_5">El Cliente conserva la propiedad de todos los datos proporcionados a través del servicio de gestión de nómina. Nosotros no compartiremos, venderemos ni utilizaremos sus datos con fines no relacionados con la prestación de nuestros servicios, en conformidad con las leyes de privacidad aplicables en Guatemala.</span> <!--Descripcion de la web-->


    <span class="title_6">6. Modificaciones a los Términos y Condiciones</span> <!--titulo de la web-->
    <span class="description_6">Nos reservamos el derecho de modificar estos términos en cualquier momento. Las modificaciones entrarán en vigencia tras su publicación en nuestro sitio web. Es responsabilidad del Cliente revisar periódicamente estos términos.</span> <!--Descripcion de la web-->


    <span class="title_7">7. Responsabilidad y Ley Aplicable</span> <!--titulo de la web-->
    <span class="description_7">La responsabilidad de la Empresa se limita a lo establecido por las leyes guatemaltecas. Estos términos se regirán e interpretarán de acuerdo con las leyes de la República de Guatemala.</span> <!--Descripcion de la web-->


    <span class="title_8">8. Resolución de Conflictos</span> <!--titulo de la web-->
    <span class="description_8">Cualquier disputa que surja de o esté relacionada con estos términos y condiciones será sometida a la jurisdicción exclusiva de los tribunales competentes en Guatemala.</span> <!--Descripcion de la web-->


    <span class="title_21">Política de Privacidad y Protección de Datos</span> <!--titulo de la web-->


    <span class="title_2_1">1. Información que Recopilamos</span> <!--titulo de la web-->
    <span class="description_2_1">Recopilamos información personal que usted nos proporciona voluntariamente, incluyendo, pero no limitándose a: nombre, dirección de correo electrónico, número de teléfono y cualquier otra información necesaria para brindar nuestros servicios.</span> <!--Descripcion de la web-->


    <span class="title_2_2">2. Cookies y Tecnologías Similares</span> <!--titulo de la web-->
    <span class="description_2_2">Utilizamos cookies y tecnologías similares para mejorar su experiencia de usuario y recopilar información sobre su uso de nuestro sitio web. Puede gestionar su configuración de cookies en cualquier momento a través de su navegador.</span> <!--Descripcion de la web-->



    <span class="title_2_3">3. Sus Derechos</span> <!--titulo de la web-->
    <span class="description_2_3">Usted tiene derecho a acceder, corregir, eliminar o bloquear sus datos personales. Para ejercer estos derechos, por favor contáctenos a través de los datos de contacto proporcionados.</span> <!--Descripcion de la web-->

      </nav>


      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>

<?php
// Incluye el archivo de conexión
include('conexion.php');

if ($conn){

// Verifica si la solicitud es de tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo_electronico = $_POST["correo_electronico"];
    $contrasena = $_POST["contrasena"];

    //verificar si los campos estan vacios o no
    if (empty($correo_electronico) || empty($contrasena)) {
        echo '<script>alert("Por favor, complete todos los campos."); window.location.href = "polity_terms_login.php";</script>';
    }else{
        // Escapa caracteres especiales para prevenir SQL injection
        $correo_electronico = $conexion->real_escape_string($correo_electronico);
        $contrasena = $conexion->real_escape_string($contrasena);

        // Consulta preparada para prevenir SQL injection
        $stmt = $conexion->prepare("SELECT correo_electronico, rol FROM usuarios WHERE correo_electronico = ? AND contrasena = ?");
        $stmt->bind_param("ss", $correo_electronico, $contrasena);
        $stmt->execute();
        $stmt->store_result();

        // Verifica si se encontró un resultado
        if ($stmt->num_rows == 1) {
            // Las credenciales son válidas
            $stmt->bind_result($correo_electronico, $rol);
            $stmt->fetch();

            // Redirige según el rol
            if ($rol == "Admin") {
                echo '<script>window.location.href = "inicio.php";</script>';
            } elseif ($rol == "Trabajador") {
                echo '<script>window.location.href = "iniciotrabajador.php";</script>';
            } elseif ($rol == "Pendiente") {
                echo '<script>alert("Este usuario no está autorizado, espere un momento."); window.location.href = "polity_terms_login.php";</script>';
            } elseif ($rol == "Jefe"){
                echo '<script>window.location.href = "inicio.php";</script>';
            }
        } else {
            // Las credenciales son inválidas
            echo '<script>alert("Credenciales incorrectas. Intente nuevamente."); window.location.href = "index.php";</script>';
        }

        $stmt->close();

    }

}

}else{
    echo "No se pudo establecer conexión a la base de datos.";

}

?>
