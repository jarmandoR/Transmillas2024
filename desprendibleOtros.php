<?php
// include class

// require("login_autentica.php");
// include("cabezote3.php"); 
$nombre=$_GET["nombre"];
$cedula=$_GET["cedula"];
$valor=$_GET["valor"];
$deudas=$_GET["deudas"];
$fechaini=$_GET["fechaini"];
$fechafin=$_GET["fechafin"];
$recogidas=$_GET["recogidas"];
$valorRecogidas=$_GET["valorRecogidas"];
$otrosdeve=$_GET["otrosdeve"];
$valorHoras=$_GET["valorHoras"];
$confirmado=$_GET["confirmado"];
$reteGarantiaLleva=$_GET["reteGarantiaLleva"];
$reteGarantiaDesc=$_GET["reteGarantiaDesc"];
$firma=$_GET["firma"];

$llevaRetegarantia=$_GET["llevaRetegarantia"];

$diassancion=$_GET["diassancion"];
$valorSancion=$_GET["valorSancion"];
$descriprestamos=$_GET["descriprestamos"];

$valorAjusteO=$_GET["valorAjuste"];
$tipoAjusteO=$_GET["tipoAjuste"];
$descripcionAjusteO=$_GET["descripcionAjuste"];

// $ajustessumO=0;
// $ajustesresO=0;
if ($tipoAjusteO=="suma") {
    $ajustessumO=$valorAjusteO;
    $ajustesresO=0;
}else if($tipoAjusteO=="descuento"){
    $ajustessumO=0;
    $ajustesresO=$valorAjusteO;
}
// $asc="ASC";


$fechaini = strtotime($fechaini);
$fechafin = strtotime($fechafin);

$fechainidia=date("d",$fechaini);
$fechainimes=date("m",$fechaini);
$fechainiaño=date("Y",$fechaini);      


$fechafindia=date("d",$fechafin);
$fechafinmes=date("m",$fechafin);
$fechafinaño=date("Y",$fechafin);   
//             $fechadelregidia = date("d",$fechadelregi);

// // error_reporting(0);
require('fpdf/fpdf.php');



class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    // $this->Image('assets/cabecerapagina.jpg',10,8,0);
    // Times bold 15
    $this->SetFont('Times','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    // $this->Cell(30,10,'Title',1,0,'C');
    // Salto de línea
    $this->Ln(20);

   
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Times italic 8
    $this->SetFont('Times','I',8);
    // $this->Image('assets/piedepaginaberm.jpg',0,260,0);
    // Número de página
    // $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
// for($i=1;$i<=40;$i++)
//     $pdf->Cell(0,10,'Imprimiendo línea número '.$i,0,1);


$pdf->SetFont('Times', '', 12);
$pdf->SetLeftMargin(25);
$pdf->SetRightMargin(25);
$pdf->Ln(5);
$pdf->Cell(0, 10, 'BOGOTA', 0, 1,'C');
$pdf->Cell(0, 10, 'CUENTA DE COBRO', 0, 1,'C');
$pdf->Cell(0, 10, 'No__', 0, 1,'C');
$pdf->Cell(0, 10, 'TRANSMILLAS LOGISTICA Y TRANSPORTE SAS', 0, 1,'C');
$pdf->Cell(0, 10, 'NIT 901.089.478-8', 0, 1,'C');
$pdf->Cell(0, 10, 'DEBE A:', 0, 1,'C');
$pdf->Cell(0, 10, ''.$nombre.'', 0, 1,'C');
$pdf->Cell(0, 10, ''.$cedula.'', 0, 1,'C');

$valor=$valor+$valorHoras;
if ($recogidas!=0) {
    
   
    
    $valor=$valor+$valorRecogidas;
}
if ($otrosdeve!=0) {
    
   
    
    $valor=$valor+$otrosdeve;
}

$devolretegarantia=$_GET["devolretegarantia"];

if ($devolretegarantia!="" or $devolretegarantia!=0) {
    $valor=$valor+$devolretegarantia;
}else{



}

$totalOtrosAPagar=($valor+$ajustessumO)-($deudas+$reteGarantiaDesc+$ajustesresO+$valorSancion);

$totalOtrosAPagar_formateado = number_format($totalOtrosAPagar, 0, ',', '.');

$pdf->MultiCell(0, 5, utf8_decode('LA SUMA DE:'), 0,'C');
$valor_formateado = number_format($valor, 0, ',', '.');
$pdf->MultiCell(0, 5, utf8_decode(''.$totalOtrosAPagar_formateado.''), 0,'C');

$locale = 'es_CO'; // Define el locale para el idioma y formato de moneda colombiano
$fmt = new NumberFormatter($locale, NumberFormatter::SPELLOUT); // Crea una instancia de NumberFormatter

$valorEnLetras = $fmt->formatCurrency($totalOtrosAPagar, 'COP');


// Elimina la palabra "coma" y lo que le sigue
$valorEnLetras = preg_replace('/\bcoma\b.*$/i', '', $valorEnLetras);

$valorEnLetras_en_mayusculas = strtoupper($valorEnLetras);
$pdf->MultiCell(0, 5, utf8_decode(''.$valorEnLetras_en_mayusculas.' PESOS'), 0,'C');


$pdf->Ln(10);

$formatofin=$formato;

// if ($formatofin==1){
// 	    $pdf->MultiCell(0, 6, utf8_decode('Que '.$nombre.', identificada con la cédula de ciudadanía N.º '.$cedula.' de Bogotá, laboró en nuestra empresa desde el '.date("d",$fechadelregi).' de '.date("m",$fechadelregi).' del '.date("Y",$fechadelregi).' con un CONTRATO A TERMINO INDEFINIDO, desempeñando el cargo de '.$cargo.'.'), 0,'J');
// }else if($formatofin==2){

$pdf->MultiCell(0, 5, utf8_decode('Concepto 1 : Prestacion de servicios desde  el '.$fechainidia.' al '.$fechafindia.' del '.$fechainimes.' del '.$fechainiaño.''), 0,'J');


// }
$pdf->Ln(10);
if ($tipoAjusteO=="suma") {
    $pdf->SetTextColor(0, 128, 0); // Establece el color de texto a rojo
    $pdf->Cell(0, 5, ''.$descripcionAjusteO.'', 0, 1);
    $pdf->Cell(0, 5, '$'.$ajustessumO.'', 0, 1);
}

  
$pdf->SetTextColor(0, 0, 0); // Establece el color de texto a rojo

if ($recogidas!=0) {
    $pdf->Cell(0, 5, ''.$recogidas.' Recogidas en la quincena', 0, 1);
    $valorRecogidas_formateado = number_format($valorRecogidas, 0, ',', '.');
    $pdf->Cell(0, 5, '$'.$valorRecogidas_formateado.'', 0, 1);
   
}
if ($otrosdeve!=0) {
    $pdf->Cell(0, 5, 'Otros devengos', 0, 1);
    $otrosdeve_formateado = number_format($otrosdeve, 0, ',', '.');
    $pdf->Cell(0, 5, '$'.$otrosdeve_formateado.'', 0, 1);
   
}


if ($devolretegarantia!="" or $devolretegarantia!=0) {
    $devolretegarantia_formateado = number_format($devolretegarantia, 0, ',', '.');
    $pdf->Cell(0, 5, 'Se devuelve retegarantia', 0, 1);
    $pdf->Cell(0, 5, '$'.$devolretegarantia_formateado.'', 0, 1);
}else{

    if ($llevaRetegarantia!="") {

        $llevaRetegarantia_formateado = number_format($llevaRetegarantia, 0, ',', '.');
        $reteGarantiaDesc_formateado = number_format($reteGarantiaDesc, 0, ',', '.');
        $pdf->Cell(0, 5, 'Acumulado retegarantia', 0, 1);
        $pdf->Cell(0, 5, '$'.$llevaRetegarantia_formateado.'', 0, 1);
        if ($reteGarantiaDesc!=0) {
            $pdf->Cell(0, 5, 'Descuento por retegarantia', 0, 1);
            $pdf->Cell(0, 5, '$'.$reteGarantiaDesc_formateado.'', 0, 1);
        }

    }

}

if($tipoAjusteO=="descuento"){
    $pdf->SetTextColor(255, 0, 0); // Establece el color de texto a rojo
    $pdf->Cell(0, 5, ''.$descripcionAjusteO.'', 0, 1);
    $pdf->Cell(0, 5, '$'.$ajustesresO.'', 0, 1);
}


if ($valorSancion!=0) {
    $valorSancion_formateado = number_format($valorSancion, 0, ',', '.');
$pdf->SetTextColor(255, 0, 0); // Establece el color de texto a rojo
$pdf->MultiCell(0, 5, 'DESCUENTO POR INACISTENCIA DE '.$diassancion.' DIAS', 0, 1);
$pdf->Cell(0, 5, '$'.$valorSancion_formateado.'', 0, 1);
}



$pdf->SetTextColor(255, 0, 0); // Establece el color de texto a rojo
$pdf->Cell(0, 5, 'Deudas', 0, 1);
$pdf->MultiCell(0, 5, '$'.$deudas.''.$descriprestamos.'', 0, 1);






$pdf->Ln(20);
$pdf->SetTextColor(0, 0, 0); // Establece el color de texto a rojo
$pdf->Cell(0, 5, 'Total, a pagar,', 0, 1);
$pdf->Cell(0, 5, '$'.$totalOtrosAPagar_formateado.'', 0, 1);

$pdf->SetY($pdf->GetY() +30);

if ($confirmado!="") {

$pdf->SetFont('Times', '', 10);
$pdf->SetY(+240);
$pdf->Cell(0, 5, ''.$confirmado.'', 0, 1);




$pdf->SetFont('Times', 'I', 12);
$pdf->Cell(0, 5, '______________________________ ', 0, 1);
$ruta_imagen="imgHojasDeVida/".$firma."";
if (file_exists($ruta_imagen)) {
    // Mostrar la imagen si existe
    $pdf->Image('imgHojasDeVida/'.$firma.'', $pdf->GetX(), $pdf->GetY() - 30, 40, 14);
} else {
    // Mostrar un mensaje si la imagen no existe
    $pdf->Cell(0, 5, 'si no se ve la firma revisar foto y volver a cargar ', 0, 1);
}

$pdf->Cell(0, 5, ''.$nombre.'', 0, 1);

$pdf->Cell(0, 5, ''.$cedula.'', 0, 1);
}




$pdf->Ln(10);
// $pdf->MultiCell(0, 6, 'Puede certificarla veracidad de este certificado en los correos: castiblanco@bermudas.com.co y/o recursosh@bermudas.com.co 
// ', 0,'C');

$pdf->Output();
?>