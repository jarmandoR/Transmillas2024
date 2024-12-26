<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('fpdf/fpdf.php');
require_once('FPDI/src/autoload.php');

// use \setasign\Fpdi\Tfpdf\Fpdi;
use \setasign\Fpdi\Fpdi;

// $pdf = new Fpdi();
$firma=$_GET["dato"];
$namepdf=$_GET["pdf"];
// $ruta = "img_manifiestos/manifiestos/".$namepdf;
// $ruta_imagen2 = "img_manifiestos/empresa/sello.png";


$pdf = new Fpdi();



$ruta_pdf_original = 'img_manifiestos/manifiestos/'.$namepdf;
$ruta_firma='img_manifiestos/conductores/'.$firma;

// $paginaId = $pdf->setSourceFile('img_manifiestos/manifiestos/2024-04-23-19-35-39Manifiesto 1274 LUIS CUESTA.pdf'); // Reemplaza 'ruta/a/pdf_existente.pdf' con la ruta real al PDF existente
// $plantilla = $pdf->importPage(1); // Importa la primera página del PDF existente


$pdf->addPage();
// $pdf->useTemplate($plantilla);


$paginaId1 = $pdf->setSourceFile($ruta_pdf_original);
$plantilla1 = $pdf->importPage(1);
$pdf->useTemplate($plantilla1);


$pdf->Image('img_manifiestos/empresa/sello.png', 40, 220, 50, 0); // Reemplaza 'ruta/a/imagen1.jpg' con la ruta real a la primera imagen
$pdf->Image($ruta_firma, 120, 220, 60, 34); // Reemplaza 'ruta/a/imagen2.jpg' con la ruta real a la segunda imagen

// Agregar una nueva página si el PDF original tiene más de una página
if ($pdf->setSourceFile($ruta_pdf_original) > 1) {
    $pdf->AddPage();
    // Importar la segunda página del PDF original
    $paginaId2 = $pdf->setSourceFile($ruta_pdf_original);
    $plantilla2 = $pdf->importPage(2);
    $pdf->useTemplate($plantilla2);
}


$pdf->Output(); // 'D' indica que el PDF se descargará directamente, reemplaza 'nuevo_pdf.pdf' con el nombre deseado para el nuevo PDF










?>