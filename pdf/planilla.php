<?php

include ('fpdf.php');

class PDF extends FPDF
{

   // Cabecera de página
   function Header()
   {

      $this->Image('v42_4.png', 270, 5, 20); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
      $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(95); // Movernos a la derecha
      $this->SetTextColor(0, 0, 0); //color
      //creamos una celda o fila
      $this->Cell(110, 15, utf8_decode('PLANILLA IGSS'), 1, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      $this->Ln(3); // Salto de línea
      $this->SetTextColor(103); //color

      /* UBICACION */
      $this->Cell(180);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(96, 10, utf8_decode("Empresa : T Consulting, S.A. "), 0, 0, '', 0);
      $this->Ln(5);

      /* TELEFONO */
      $this->Cell(180);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(59, 10, utf8_decode("Teléfonos : 3654-6078 / 4707-3943 "), 0, 0, '', 0);
      $this->Ln(5);

      /* COREEO */
      $this->Cell(180);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(85, 10, utf8_decode("Email :nominaproyecto8@gmail.com "), 0, 0, '', 0);
      $this->Ln(10);

      
      /* TITULO DE LA TABLA */
      //color
      $this->SetTextColor(228, 100, 0);
      $this->Cell(100); // mover a la derecha
      $this->SetFont('Arial', 'B', 15);
      $this->Cell(100, 10, utf8_decode("Planilla del IGSS "), 0, 1, 'C', 0);
      $this->Ln(7);


      /* CAMPOS DE LA TABLA */
      //color
      $this->SetFillColor(252, 166, 55); //colorFondo
      $this->SetTextColor(255, 255, 255); //colorTexto
      $this->SetDrawColor(163, 163, 163); //colorBorde
      $this->SetFont('Arial', 'B', 11);
      $this->Cell(10, 10, utf8_decode('ID'), 1, 0, 'C', 1);
      $this->Cell(70, 10, utf8_decode('Nombre'), 1, 0, 'C', 1);
      $this->Cell(29, 10, utf8_decode('Dpi'), 1, 0, 'C', 1);
       $this->Cell(29, 10, utf8_decode('Afiliacion'), 1, 0, 'C', 1);
      $this->Cell(40, 10, utf8_decode('Departamento'), 1, 0, 'C', 1);
      $this->Cell(30, 10, utf8_decode('Sueldo'), 1, 0, 'C', 1);
      $this->Cell(25, 10, utf8_decode('Pago igss'), 1, 0, 'C', 1);
       $this->Cell(25, 10, utf8_decode('Patrono igss'), 1, 0, 'C', 1);
      $this->Cell(25, 10, utf8_decode('Fecha'), 1, 1, 'C', 1);
   }

   // Pie de página
   function Footer()
   {
      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
      $hoy = date('d/m/Y');
      $this->Cell(540, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
   }
}

include('conexion.php');

$pdf = new PDF();
$pdf->AddPage("landscape"); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas

$i = 0;
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163); //colorBorde
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
   $Idq = $_GET["id"];
 

$consulta_reporte_planilla = $conn->query("SELECT * FROM planilla WHERE id_planilla = $Idq");

while ($datos_reporte = $consulta_reporte_planilla->fetch_object()) {
   $pdf->Cell(10, 10, utf8_decode($datos_reporte->id_planilla ), 1, 0, 'C', 0);
   $pdf->Cell(70, 10, utf8_decode($datos_reporte->nombre_empleado ), 1, 0, 'C', 0); 
$pdf->Cell(29, 10, utf8_decode($datos_reporte->dpi ), 1, 0, 'C', 0);
  $pdf->Cell(29, 10, utf8_decode($datos_reporte->afiliacion ), 1, 0, 'C', 0);
   $pdf->Cell(40, 10, utf8_decode($datos_reporte->departamento ), 1, 0, 'C', 0); 
$pdf->Cell(30, 10, utf8_decode($datos_reporte->sueldo_base ), 1, 0, 'C', 0);
  $pdf->Cell(25, 10, utf8_decode($datos_reporte->igss ), 1, 0, 'C', 0);
      $pdf->Cell(25, 10, utf8_decode($datos_reporte->igss_patrono), 1, 0, 'C', 0);
   $pdf->Cell(25, 10, utf8_decode($datos_reporte->fecha ), 1, 1, 'C', 0); 

$pdf->Output("planilla del igss".'.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)
   }
   

}
?>