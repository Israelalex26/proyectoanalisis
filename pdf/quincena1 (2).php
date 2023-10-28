<?php

include ('fpdf.php');

class PDF extends FPDF
{

   // Cabecera de página
   function Header()
   {
     include('conexion.php');
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
   $Idq = $_GET["id"];
 

$consulta_reporte_quincena = $conn->query("SELECT * FROM quincena1 WHERE id_quincena1 = $Idq");
while ($datos_reporte = $consulta_reporte_quincena->fetch_object()) {
      $this->Image('v42_4.png', 270, 5, 20); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
      $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(95); // Movernos a la derecha
      $this->SetTextColor(0, 0, 0); //color
      //creamos una celda o fila
      $this->Cell(110, 15, utf8_decode('Primera Quincena'), 1, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
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
      $this->Cell(100, 10, utf8_decode("Nomina primera quincena $datos_reporte->mes de $datos_reporte->ano"), 0, 1, 'C', 0);
      $this->Ln(7);
}
}
      /* CAMPOS DE LA TABLA */
      //color
      $this->SetFillColor(252, 166, 55); //colorFondo
      $this->SetTextColor(255, 255, 255); //colorTexto
      $this->SetDrawColor(163, 163, 163); //colorBorde
      $this->SetFont('Arial', 'B', 11);
      $this->Cell(10, 10, utf8_decode('ID'), 1, 0, 'C', 1);
      $this->Cell(70, 10, utf8_decode('Nombre'), 1, 0, 'C', 1);
      $this->Cell(30, 10, utf8_decode('Salario Base'), 1, 0, 'C', 1);
      $this->Cell(25, 10, utf8_decode('45% Salario'), 1, 0, 'C', 1);
      $this->Cell(25, 10, utf8_decode('Comisiones'), 1, 0, 'C', 1);
      $this->Cell(20, 10, utf8_decode('IGSS'), 1, 0, 'C', 1);
     $this->Cell(20, 10, utf8_decode('Irtra'), 1, 0, 'C', 1);
      $this->Cell(15, 10, utf8_decode('ISR'), 1, 0, 'C', 1);
      $this->Cell(20, 10, utf8_decode('Bono 14'), 1, 0, 'C', 1);
       $this->Cell(20, 10, utf8_decode('Aguinaldo'), 1, 0, 'C', 1);
      $this->Cell(25, 10, utf8_decode('Total'), 1, 1, 'C', 1);
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
 

$consulta_reporte_quincena = $conn->query("SELECT * FROM quincena1 WHERE id_quincena1 = $Idq");

while ($datos_reporte = $consulta_reporte_quincena->fetch_object()) {
   $pdf->Cell(10, 10, utf8_decode($datos_reporte->id_quincena1 ), 1, 0, 'C', 0);
   $pdf->Cell(70, 10, utf8_decode($datos_reporte->empleado ), 1, 0, 'C', 0); 
$pdf->Cell(30, 10, utf8_decode($datos_reporte->salario ), 1, 0, 'C', 0);
  $pdf->Cell(25, 10, utf8_decode($datos_reporte->anticipo ), 1, 0, 'C', 0);
   $pdf->Cell(25, 10, utf8_decode($datos_reporte->comisiones ), 1, 0, 'C', 0); 
$pdf->Cell(20, 10, utf8_decode($datos_reporte->igss ), 1, 0, 'C', 0);
  $pdf->Cell(20, 10, utf8_decode($datos_reporte->irtra ), 1, 0, 'C', 0);
   $pdf->Cell(15, 10, utf8_decode($datos_reporte->isr ), 1, 0, 'C', 0);
   $pdf->Cell(20, 10, utf8_decode($datos_reporte->bono14 ), 1, 0, 'C', 0);
   $pdf->Cell(20, 10, utf8_decode($datos_reporte->aguinaldo ), 1, 0, 'C', 0); 
$pdf->Cell(25, 10, utf8_decode($datos_reporte->Total ), 1, 1, 'C', 0);

$pdf->Output("Primera Quincena $datos_reporte->empleado".'.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)
   }
   

}
?>




